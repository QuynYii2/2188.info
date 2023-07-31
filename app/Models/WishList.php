<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
//    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['user_id', 'product_id'];
    protected $dates = ['deleted_at'];
}
