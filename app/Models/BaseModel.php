<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    public $fillable = [
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
