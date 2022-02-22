<?php

namespace App\Models;

class App extends BaseModel
{
    public $fillable = [
        'name',
        'organization_id',
    ];

    public function organization() 
    {
        return $this->belongsTo(Organization::class);
    }

    public function appUssdMenu()
    {
        return $this->hasMany(AppUssdMenu::class);
    }
}
