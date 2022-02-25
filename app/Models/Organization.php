<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends BaseModel
{

    use HasFactory;

    public $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function app()
    {
        return $this->hasMany(App::class);
    }
}
