<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'code',
        'percent',
        'user_id',
        'status',
        'apply',
        'startDate',
        'endDate',
        'description'
    ];
}
