<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'price',
        'thumbnail',
        'location',
        'description',
        'storage_id',
        'qty',
        'status',
        'old_price',
        'slug',
        'category_id',
        'hot',
        'feature',
        'gallery',
        'short_description',
        'list_category',
        'min',
        'origin',

        'name_vi',
        'name_ja',
        'name_ko',
        'name_en',
        'name_zh',

        'description_vi',
        'description_ja',
        'description_ko',
        'description_en',
        'description_zh',

        'short_description_vi',
        'short_description_ja',
        'short_description_ko',
        'short_description_en',
        'short_description_zh',

    ];

    // Product.php
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot('value');
    }

    // Product.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
