<?php

namespace App\Models;

class ServiceRequest extends BaseModel
{
    public $fillable = [
        'ussd_session_id',
        'user_email',
        'user_name',
        'user_national_id',
        'event_id',
    ];
}
