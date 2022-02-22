<?php

namespace App\Models;

class UssdMenu extends BaseModel
{
    public $fillable = [
        'app_ussd_menu',
        'menu_key',
        'next_menu_key',
        'previous_menu_key',
        'menu_text',
        'menu_action',
        'is_final_menu',
    ];

    public function appUssdMenu()
    {
        return $this->belongsTo(AppUssdMenu::class);
    }
    
}
