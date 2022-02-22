<?php

namespace App\Models;

class Organization extends BaseModel
{

    public $fillable = [
        'name',
        'status'
    ];

    public function app()
    {
        return $this->hasMany(App::class);
    }
}
