<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdMenuOption extends Model
{
    use HasFactory;

    public $fillable = [
        'ussd_menu_id',
        'option_menu_key',
        'option_menu_text',
        'option_menu_action',
        'option_menu_session_field',
        'is_menu_option_interactive',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    public function ussdMenu()
    {
        return $this->belongsTo(UssdMenu::class);
    }
}
