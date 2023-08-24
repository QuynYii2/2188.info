<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopSellerConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'thumbnail',
        'url',
        'product',
        'name_custom',
        'category'
    ];
}
