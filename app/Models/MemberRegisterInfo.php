<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRegisterInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'phone',
        'fax',
        'code_fax',
        'category_id',
        'code_business',
        'number_business',
        'type_business',
        'member',
        'member_id',
        'address',
        'status',
        'giay_phep_kinh_doanh',
    ];
}
