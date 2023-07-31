<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'access',
        'views',
        'orders',
        'datetime',
    ];
}
