<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInterested extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'categories_id',
        'status',
    ];
}
