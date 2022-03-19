<?php

namespace App\Services\Ussd\Utils;

use App\Models\UssdMenu;
use App\Models\UssdRequest;
use App\Models\UssdSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessUssdRequestUtilsImpl implements ProcessUssdRequestUtils 
{
    public static function saveProcessUssdErrorSession(string $message, UssdSession $ussdSession)
    {
        $ussdSession->response_message .= " " . $message;
        $ussdSession->status = 0;
        $ussdSession->save();
    }

    public static function saveProcessUssdErrorSessionAndRequest(string $message, UssdSession $ussdSession, UssdRequest $ussdRequest)
    {
        $ussdRequest->ussd_menu_text = "N/A";
        $ussdRequest->response_message .= " " . $message;
        $ussdRequest->status = 0;
        $ussdRequest->save();

        $ussdSession->response_message .= " " . $message;
        $ussdSession->status = 0;
        $ussdSession->save();
    }

    public static function checkIfSessionIsExpired($timestamp, $duration): bool
    {
        return $timestamp->addMinutes($duration)->lt(Carbon::now());
    }

    public static function serveMenu(UssdSession $ussdSession, UssdMenu $ussdMenu, UssdRequest $ussdRequest): string
    {
        Log::debug("UssdMenu previous_menu_key: " . $ussdMenu->previous_menu_key);
        Log::debug("UssdMenu current_menu_key: " . $ussdMenu->menu_key);
        Log::debug("UssdMenu next_menu_key: " . $ussdMenu->next_menu_key);
        
        Log::debug("UssdSession previous_ussd_menu_key: " . $ussdSession->previous_ussd_menu_key);
        Log::debug("UssdSession current_ussd_menu_key: " . $ussdSession->current_ussd_menu_key);
        Log::debug("UssdSession next_ussd_menu_key: " . $ussdSession->next_ussd_menu_key);

        $menu = ProcessUssdRequestUtilsImpl::formatMenu($ussdMenu);

        Log::debug("Formatted menu to be served: " . $menu);

        if ($ussdMenu->is_final_menu == 1) $ussdSession->status = 2;
        $ussdSession->previous_ussd_menu_key = $ussdSession->current_ussd_menu_key;
        $ussdSession->current_ussd_menu_key = $ussdMenu->menu_key;
        $ussdSession->next_ussd_menu_key = $ussdMenu->next_menu_key;
        $ussdSession->response_message .= "Serving menu: {" . $menu . "}.";
        $ussdSession->save();

        $ussdRequest->ussd_menu_text = $ussdMenu->menu_text;
        $ussdRequest->response_message = "Serving menu: {" . $menu . "}.";
        $ussdRequest->status = 1;
        $ussdRequest->save();

        return $menu;
    }

    public static function formatMenu(UssdMenu $ussdMenu): string
    {
        if ($ussdMenu->is_parent != null && $ussdMenu->is_parent == 1)
        {
            $menu = $ussdMenu->menu_text;
            $count = 0;

            foreach($ussdMenu->ussdMenuOption as $ussdMenuOption)
            {
                if ($ussdMenuOption->status == 1) $menu .= "\n" . ++$count . ". " . $ussdMenuOption->option_menu_text;
            }

            return nl2br($menu);
        }

        return $ussdMenu->menu_text;
    }

    public static function appendSessionData(UssdSession $ussdSession, string $field, $data)
    {
        Log::debug("Attempting to append: " . $data . " to field: " . $field);
        $ussdSession->$field = $data;
    }

    public static function exitMenu(UssdSession $ussdSession, string $exitMenuKey): void
    {
        $ussdSession->next_ussd_menu_key = $exitMenuKey;
        $ussdSession->save();
    }
}