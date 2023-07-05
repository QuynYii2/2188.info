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
        'assign_to'
    ];
}
