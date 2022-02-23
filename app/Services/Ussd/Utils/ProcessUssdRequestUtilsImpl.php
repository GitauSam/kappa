<?php

namespace App\Services\Ussd\Utils;

use App\Models\UssdRequest;
use App\Models\UssdSession;

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
        // todo: implement time comparison logic
        return false;
    }
}