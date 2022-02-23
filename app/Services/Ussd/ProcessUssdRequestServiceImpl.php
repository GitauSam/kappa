<?php

namespace App\Services;

use App\Models\AppUssdMenu;
use App\Models\UssdMenu;
use App\Models\UssdRequest;
use App\Models\UssdSession;
use App\Services\Ussd\Utils\ProcessUssdRequestUtilsImpl;

class ProcessUssdRequestServiceImpl implements ProcessUssdRequestService 
{
    public function execute($data): string
    {
        try 
        {
            $ussdSession = UssdSession::where('ussd_code', $data['ussd_code'])
                                        ->where('user_msisdn', $data['user_msisdn'])
                                        ->where('status', 1)
                                        ->latest();

            if ($ussdSession != null && !ProcessUssdRequestUtilsImpl::checkIfSessionIsExpired($ussdSession->updated_at, 5)) 
            {
                $nextUssdMenu = UssdMenu::where('menu_key', $ussdSession->next_ussd_menu_key)
                                            ->get();

                if ($nextUssdMenu != null)
                {
                    $ussdSession->previous_ussd_menu_key = $ussdSession->current_ussd_menu_key;
                    $ussdSession->current_ussd_menu_key = $nextUssdMenu->menu_key;
                    $ussdSession->next_ussd_menu_key = $nextUssdMenu->next_menu_key;

                    
                } else 
                {

                }

                return "";
            } else 
            {
                $ussdSession = new UssdSession();
                $ussdSession->ussd_code = $data['ussd_code'];
                $ussdSession->user_msisdn = $data['user_msisdn'];
                $ussdSession->response_message = "Initiated new USSD session for msisdn {"
                    . $data['user_msisdn'] ."}.";
                $ussdSession->status = 1;
                $ussdSession->save();

                $appUssdMenu = AppUssdMenu::where('ussd_code', $data['ussd_code'])
                                            ->get();

                if ($appUssdMenu != null)
                {
                    $ussdMenu = UssdMenu::where('menu_key', $appUssdMenu->root_menu_key)
                                        ->where('status', 1)
                                        ->get();

                    $ussdRequest = new UssdRequest();
                    $ussdRequest->user_input = $data['user_input'];
                    $ussdRequest->ussd_session_id = $ussdSession->id;

                    if ($ussdMenu != null)
                    {
                        $ussdRequest->ussd_menu_text = $ussdMenu->menu_text;
                        $ussdRequest->response_message = "Serving menu: {" . $ussdMenu->menu_text . "}.";
                        $ussdRequest->status = 1;
                        $ussdRequest->save();

                        $ussdSession->response_message .= "Serving menu: {" . $ussdMenu->menu_text . "}.";
                        $ussdSession->current_ussd_menu_key = $ussdMenu->menu_key;
                        $ussdSession->save();

                        return $ussdMenu->menu_text;
                    } else 
                    {
                        
                        ProcessUssdRequestUtilsImpl::saveProcessUssdErrorSessionAndRequest(
                            "Could not find initial menu for ussd code.",
                            $ussdSession,
                            $ussdRequest
                        );

                        throw new \Exception("Could not find initial menu for ussd code");
                    }

                } else 
                {
                    ProcessUssdRequestUtilsImpl::saveProcessUssdErrorSession(
                        "No menus associated with that ussd code exist.",
                        $ussdSession
                    );

                    throw new \Exception("Invalid ussd code");
                }
            }
        } catch (\Throwable $th) 
        {
            return "";
        }
    }
}