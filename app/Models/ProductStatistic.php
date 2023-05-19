<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'country_code',
        'view_count',
        'sale_count',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
