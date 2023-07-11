<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class StorageProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'gallery',
        'quantity',
        'price',
        'origin',
        'name',
        'create_by',
        'updated_by',
    ];
}
