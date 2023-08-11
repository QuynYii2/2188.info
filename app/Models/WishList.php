<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
//    use SoftDeletes;
protected $table  = 'Wish_Lists';
    use HasFactory;
    protected $fillable = ['user_id', 'product_id'];
    protected $dates = ['deleted_at'];
}
