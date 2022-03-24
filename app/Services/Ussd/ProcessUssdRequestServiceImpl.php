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

            // Confirm USSD session exists and has not expired
            if ($ussdSession != null && !ProcessUssdRequestUtilsImpl::checkIfSessionIsExpired($ussdSession->updated_at, 5)) 
            {
                $currentUssdMenu = UssdMenu::where('menu_key', $ussdSession->current_ussd_menu_key)
                                                ->first();

                $nextUssdMenuFromOption = null;

                if ($currentUssdMenu->is_parent && $currentUssdMenu->is_interactive)
                {
                    Log::debug("Checking selected menu option");
                    // Get appropriate child menu action from input
                    foreach($currentUssdMenu->ussdMenuOption as $index => $ussdMenuOption) {
                        Log::debug("Current index: " . $index);
                        if ($index + 1 == $data['user_input'])
                        {
                            Log::debug("Current index == " . $index + 1);
                            $optionMenuAction = $ussdMenuOption->option_menu_action;

                            if (
                                $optionMenuAction != null &&
                                !empty($optionMenuAction) &&
                                is_callable("App\Services\Ussd\Utils\ProcessUssdRequestUtilsImpl::" . $optionMenuAction)
                            ) 
                            {
                                call_user_func_array(
                                    [
                                        "App\Services\Ussd\Utils\ProcessUssdRequestUtilsImpl", $optionMenuAction
                                    ], 
                                    match ($optionMenuAction) 
                                    {
                                        'appendSessionData' => [
                                            $ussdSession,
                                            $ussdMenuOption->option_menu_session_field,
                                            $data['user_input']
                                        ],
                                        'exitMenu' => [
                                            $ussdSession,
                                            $ussdMenuOption->option_menu_next_menu_key
                                        ],
                                        default => [], 
                                    }
                                );
                            }

                            $nextUssdMenuFromOption = $ussdMenuOption->option_menu_next_menu_key;

                            break;
                        }
                    }
                } else if ($currentUssdMenu->is_interactive == 1 && $currentUssdMenu->menu_session_field != null && !empty($currentUssdMenu->menu_session_field))
                {
                    if ($currentUssdMenu->menu_action != null && !empty($currentUssdMenu->menu_action)) {
                        $menuAction = $currentUssdMenu->menu_action;

                        if (is_callable("App\Services\Ussd\Utils\ProcessUssdRequestUtilsImpl::" . $menuAction)) 
                        {
                            call_user_func_array(
                                [ 
                                    "App\Services\Ussd\Utils\ProcessUssdRequestUtilsImpl", $menuAction
                                ], 
                                match ($menuAction) 
                                {
                                    'appendSessionData' => [
                                        $ussdSession,
                                        $currentUssdMenu->menu_session_field,
                                        $data['user_input']
                                    ],
                                    default => [], 
                                }
                            );
                        }
                    }
                }

                // Get next menu
                $nextUssdMenu = UssdMenu::where(
                                        'menu_key', 
                                        $nextUssdMenuFromOption ?? $ussdSession->next_ussd_menu_key
                                    )
                                    ->where('status', 1)
                                    ->first();

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
                $ussdSession->ussd_msisdn = $data['user_msisdn'];
                $ussdSession->response_message = "Initiated new USSD session for msisdn {"
                    . $data['user_msisdn'] ."}.";
                $ussdSession->status = 1;
                $ussdSession->save();

                // Get app associate with USSD code
                $appUssdMenu = AppUssdMenu::where('ussd_code', $data['ussd_code'])
                                            ->first();

                Log::debug("App ussd menu is null check: " . $appUssdMenu == null ? "is null" : "is not null" );

                // Confirm if app exists
                if ($appUssdMenu != null)
                {
                    // Get menu(s) associated with app
                    $ussdMenu = UssdMenu::where('menu_key', $appUssdMenu->root_menu_key)
                                        ->where('status', 1)
                                        ->first();

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
            Log::channel('menu-error')->error($th->getMessage(), ['file' => __FILE__, 'line' => __LINE__]);
            return "Error occurred. Please contact support\n";
        }
    }
}