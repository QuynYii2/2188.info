<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'chuc_vu',
        'phu_trach',
        'parent_user_id',
        'user_id',
    ];
}
