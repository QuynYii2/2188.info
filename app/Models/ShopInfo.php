<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'country',
        'masothue',
        'product_name',
        'product_code',
        'product_key',
        'business_license',
    ];
}
