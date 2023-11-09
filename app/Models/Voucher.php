<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{

    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'code',
        'quantity',
        'percent',
        'user_id',
        'status',
        'apply',
        'startDate',
        'endDate',
        'description',
        'assign_to',

        'name_en',
        'name_vi',
        'name_kr',
        'name_jp',
        'name_cn',

        'description_en',
        'description_vi',
        'description_kr',
        'description_jp',
        'description_cn',
    ];
}
