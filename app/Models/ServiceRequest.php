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
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
