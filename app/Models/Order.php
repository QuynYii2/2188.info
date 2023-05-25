<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'total',
        'address',
        'user_id',
        'total_price',
        'orders_method',
        'shipping_price',
        'discount_price',
        'status'
    ];

    // Các mối quan hệ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts')
            ->withPivot('quantity');
    }
}
