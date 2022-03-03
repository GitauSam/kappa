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
        'menu_session_field',
        'is_final_menu',
        'is_parent',
        'is_interactive',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function appUssdMenu()
    {
        return $this->belongsTo(AppUssdMenu::class);
    }

    public function ussdMenuOption()
    {
        return $this->hasMany(UssdMenuOption::class);
    }
    
}
