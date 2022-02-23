<?php

namespace App\Models;

class UssdRequest extends BaseModel
{
    public $fillable = [
        'user_input',
        'ussd_session_id',
        'ussd_menu_text',
        'response_message',
    ];
}
