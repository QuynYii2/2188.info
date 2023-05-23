<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluateProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'product_id',
        'star_number',
        'content',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
