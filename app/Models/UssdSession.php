<?php

namespace App\Models;

class UssdSession extends BaseModel
{

    public $fillable = [
        'ussd_code',
        'ussd_msisdn',
        'current_ussd_menu_key',
        'next_ussd_menu_key',
        'previous_ussd_menu_key',
        'response_message',
    ];

    public function ussdRequest()
    {
        return $this->hasMany(UssdRequest::class);
    }
}
