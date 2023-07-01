<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'promotion_id',
        'customer_id',
    ];
}
