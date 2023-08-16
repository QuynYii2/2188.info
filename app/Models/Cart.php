<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'price', 'quantity', 'product_id', 'user_id', 'values', 'status', 'member'];

    // Các mối quan hệ
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function add($data)
    {
        return Cart::create($data);
    }
}
