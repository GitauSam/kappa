<?php

namespace App\Services\Ussd\Utils;

use App\Models\UssdMenu;
use App\Models\UssdRequest;
use App\Models\UssdSession;
use Carbon\Carbon;

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
        $ussdSession->previous_ussd_menu_key = $ussdSession->current_ussd_menu_key;
        $ussdSession->current_ussd_menu_key = $ussdMenu->menu_key;
        $ussdSession->next_ussd_menu_key = $ussdMenu->next_menu_key;
        $ussdSession->response_message .= "Serving menu: {" . $ussdMenu->menu_text . "}.";
        $ussdSession->save();

        $ussdRequest->ussd_menu_text = $ussdMenu->menu_text;
        $ussdRequest->response_message = "Serving menu: {" . $ussdMenu->menu_text . "}.";
        $ussdRequest->status = 1;
        $ussdRequest->save();

        return $ussdMenu->menu_text;
    }
}