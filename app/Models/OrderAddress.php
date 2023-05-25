<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'username', 'company', 'phone', 'city', 'province', 'location', 'address_detail', 'address_option', 'status', 'default'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
