<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'email',
        'phone',
        'address',
        'logo',
        'status',
    ];
}
