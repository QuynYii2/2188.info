<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankUserSeller extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'percent',
        'user_id',
        'apply',
    ];
}
