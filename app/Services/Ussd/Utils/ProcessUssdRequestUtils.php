<?php

namespace App\Services\Ussd\Utils;

use App\Models\UssdMenu;
use App\Models\UssdRequest;
use App\Models\UssdSession;

interface ProcessUssdRequestUtils 
{
    /**
     * @param string $message - Error message
     * 
     * @param UssdSession $ussdSession - Current ussd session
     * 
     * Records and saves errors to the ussd session. 
     */
    public static function saveProcessUssdErrorSession(string $message, UssdSession $ussdSession);
    
    /**
     * @param string $message - Error message
     * 
     * @param UssdSession $ussdSession - Current ussd session
     * 
     * @param UssdRequest $ussdRequest - Current ussd request
     * 
     * Records and saves errors to the ussd session
     * and ussd request. 
     */
    public static function saveProcessUssdErrorSessionAndRequest(string $message, UssdSession $ussdSession, UssdRequest $ussdRequest);

    /**
     * @param Timestamp $timestamp 
     * 
     * @param Int $duration
     * 
     * Checks if time elapsed is greater than the duration provided.
     * If it is, returns true, otherwise false.
     */
    public static function checkIfSessionIsExpired($timestamp, $duration): bool;

    /**
     * @param UssdSession $ussdSession - Current ussd session
     * 
     * @param UssdRequest $ussdRequest - Current ussd request
     * 
     * @param UssdMenu $ussdMenu - Menu to be served
     * 
     * Updates session and request details with current state of the process 
     */
    public static function serveMenu(UssdSession $ussdSession, UssdMenu $ussdMenu, UssdRequest $ussdRequest): string;
}