<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends BaseModel
{

    use HasFactory;

    public $fillable = [
        'name',
        'status'
    ];

    public function app()
    {
        return $this->hasMany(App::class);
    }
}
