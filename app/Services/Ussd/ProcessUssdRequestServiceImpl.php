<?php

namespace App\Services\Ussd;

use App\Models\AppUssdMenu;
use App\Models\UssdMenu;
use App\Models\UssdRequest;
use App\Models\UssdSession;
use App\Services\Ussd\Utils\ProcessUssdRequestUtilsImpl;
use Illuminate\Support\Facades\Log;

class ProcessUssdRequestServiceImpl implements ProcessUssdRequestService 
{
    public static function execute($data): string
    {
        try 
        {
            // Get latest valid user USSD session
            $ussdSession = UssdSession::where('ussd_code', $data['ussd_code'])
                                        ->where('ussd_msisdn', $data['user_msisdn'])
                                        ->where('status', 1)
                                        ->latest()
                                        ->first();

            Log::debug("Breakpoint 1");
            Log::debug(gettype($ussdSession));
            Log::debug($ussdSession);

            // Confirm USSD session exists and has not expired
            if ($ussdSession != null && !ProcessUssdRequestUtilsImpl::checkIfSessionIsExpired($ussdSession->updated_at, 5)) 
            {
                Log::debug("Breakpoint 2");
                // Get next menu
                $nextUssdMenu = UssdMenu::where('menu_key', $ussdSession->next_ussd_menu_key)
                                            ->where('status', 1)
                                            ->first();

                Log::debug($nextUssdMenu);

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
                Log::debug("Breakpoint 3");
                // Create new USSD session
                $ussdSession = new UssdSession();
                $ussdSession->ussd_code = $data['ussd_code'];
                $ussdSession->ussd_msisdn = $data['user_msisdn'];
                $ussdSession->response_message = "Initiated new USSD session for msisdn {"
                    . $data['user_msisdn'] ."}.";
                Log::debug("Breakpoint 3.1");
                $ussdSession->status = 1;
                Log::debug("Breakpoint 3.2");
                $ussdSession->save();
                Log::debug("Breakpoint 3.3");

                // Get app associate with USSD code
                $appUssdMenu = AppUssdMenu::where('ussd_code', $data['ussd_code'])
                                            ->first();

                Log::debug("App ussd menu is null check: " . $appUssdMenu == null ? "is null" : "is not null" );

                // Confirm if app exists
                if ($appUssdMenu != null)
                {
                    Log::debug("Breakpoint 3.4");
                    // Get menu(s) associated with app
                    $ussdMenu = UssdMenu::where('menu_key', $appUssdMenu->root_menu_key)
                                        ->where('status', 1)
                                        ->first();

                    Log::debug("Ussd Menu status: " . $ussdMenu->status);
                    Log::debug(gettype($ussdMenu));

                    // Create new USSD request
                    $ussdRequest = new UssdRequest();
                    $ussdRequest->user_input = $data['user_input'];
                    $ussdRequest->ussd_session_id = $ussdSession->id;

                    if ($ussdMenu != null && $ussdMenu->status == 1)
                    {
                        return ProcessUssdRequestUtilsImpl::serveMenu($ussdSession, $ussdMenu, $ussdRequest);
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
            Log::debug("Breakpoint 4");
            Log::debug($th->getMessage());
            return "Error occurred. Please contact support";
        }
    }
}