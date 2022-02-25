<?php

namespace App\Models;

class AppUssdMenu extends BaseModel
{
    public $fillable = [
        'ussd_code',
        'app_id',
        'root_menu_key',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function ussdMenu()
    {
        return $this->hasMany(UssdMenu::class);
    }
}
