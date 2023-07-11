<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankSetUpSeller extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'setup',
        'user_id',
    ];
}
