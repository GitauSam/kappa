<?php

namespace App\Services\Ussd;

interface ProcessUssdRequestService
{
    /**
     * @param array $data
     * 
     * Processes ussd request 
     * based on the values 
     * in the data array.
     */
    public static function execute($data): string;
}