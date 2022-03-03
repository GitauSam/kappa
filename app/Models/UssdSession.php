<?php

namespace App\Models;

class UssdSession extends BaseModel
{

    public $fillable = [
        'ussd_code',
        'ussd_msisdn',
        'user_identification_number',
        'current_ussd_menu_key',
        'next_ussd_menu_key',
        'previous_ussd_menu_key',
        'response_message',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function ussdRequest()
    {
        return $this->hasMany(UssdRequest::class);
    }
}
