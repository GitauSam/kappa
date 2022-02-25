<?php

namespace App\Models;

class App extends BaseModel
{
    public $fillable = [
        'name',
        'organization_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
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
