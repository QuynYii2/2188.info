<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRegisterPersonSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'member_id',
        'name',
        'rank',
        'password',
        'staff',
        'passwordConfirm',
        'phone',
        'email',
        'sns_account',
        'verifyCode',
        'isVerify',
        'type',
        'status',
    ];
}
