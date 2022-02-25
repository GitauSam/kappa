<?php

namespace App\Services;

use App\Models\AppUssdMenu;
use App\Models\UssdMenu;
use App\Models\UssdRequest;
use App\Models\UssdSession;
use App\Services\Ussd\Utils\ProcessUssdRequestUtils;
use App\Services\Ussd\Utils\ProcessUssdRequestUtilsImpl;

class ProcessUssdRequestServiceImpl implements ProcessUssdRequestService 
{
    public function execute($data): string
    {
        try 
        {
            // Get latest valid user USSD session
            $ussdSession = UssdSession::where('ussd_code', $data['ussd_code'])
                                        ->where('user_msisdn', $data['user_msisdn'])
                                        ->where('status', 1)
                                        ->latest();

            // Confirm USSD session exists and has not expired
            if ($ussdSession != null && !ProcessUssdRequestUtilsImpl::checkIfSessionIsExpired($ussdSession->updated_at, 5)) 
            {
                // Get next menu
                $nextUssdMenu = UssdMenu::where('menu_key', $ussdSession->next_ussd_menu_key)
                                            ->get();

                // Create new USSD request
                $ussdRequest = new UssdRequest();
                $ussdRequest->user_input = $data['user_input'];
                $ussdRequest->ussd_session_id = $ussdSession->id;

                // Confirm menu exists and is active
                if ($nextUssdMenu != null && $nextUssdMenu->status == 1)
                {
                    // Serve menu
                    return ProcessUssdRequestUtilsImpl::serveMenu($ussdSession, $nextUssdMenu, $ussdRequest);
                } else 
                {
                    // Record error information
                    ProcessUssdRequestUtilsImpl::saveProcessUssdErrorSessionAndRequest(
                        "Could not find next menu for ussd code.",
                        $ussdSession,
                        $ussdRequest
                    );

                    throw new \Exception("Could not find next menu for ussd code");
                }
            } else 
            {
                // Create new USSD session
                $ussdSession = new UssdSession();
                $ussdSession->ussd_code = $data['ussd_code'];
                $ussdSession->user_msisdn = $data['user_msisdn'];
                $ussdSession->response_message = "Initiated new USSD session for msisdn {"
                    . $data['user_msisdn'] ."}.";
                $ussdSession->status = 1;
                $ussdSession->save();

                // Get app associate with USSD code
                $appUssdMenu = AppUssdMenu::where('ussd_code', $data['ussd_code'])
                                            ->get();

                // Confirm if app exists
                if ($appUssdMenu != null)
                {
                    // Get menu(s) associated with app
                    $ussdMenu = UssdMenu::where('menu_key', $appUssdMenu->root_menu_key)
                                        ->where('status', 1)
                                        ->get();

                    // Create new USSD request
                    $ussdRequest = new UssdRequest();
                    $ussdRequest->user_input = $data['user_input'];
                    $ussdRequest->ussd_session_id = $ussdSession->id;

                    if ($ussdMenu != null && $ussdMenu->status == 1)
                    {
                        return ProcessUssdRequestUtils::serveMenu($ussdSession, $ussdMenu, $ussdRequest);
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
            return "Error occurred. Please contact support";
        }
    }
}