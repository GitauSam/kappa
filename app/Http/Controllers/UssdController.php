<?php

namespace App\Http\Controllers;

use App\Services\Ussd\ProcessUssdRequestServiceImpl;
use Illuminate\Http\Request;

class UssdController extends Controller
{
    public function processUssdRequest(Request $request)
    {
        return ProcessUssdRequestServiceImpl::execute($request->all());
    }
}
