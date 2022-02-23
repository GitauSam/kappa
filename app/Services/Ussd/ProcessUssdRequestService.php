<?php

namespace App\Services;

interface ProcessUssdRequestService
{
    /**
     * @param array $data
     * 
     * Processes ussd request 
     * based on the values 
     * in the data array.
     */
    public function execute($data): string;
}