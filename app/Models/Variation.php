<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'product_id',
        'quantity',
        'user_id',
        'price',
        'old_price',
        'thumbnail',
        'variation',
        'description',
        'status',
    ];
}
