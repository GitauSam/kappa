<?php

namespace App\Http\Controllers;

use App\Services\Ussd\ProcessUssdRequestServiceImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UssdController extends Controller
{
    public function processUssdRequest(Request $request)
    {
        Log::debug("Request: " . json_encode($request->all()));
        return ProcessUssdRequestServiceImpl::execute($request->all());
    }
}
