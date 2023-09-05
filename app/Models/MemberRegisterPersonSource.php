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
        'person',
        'isVerify',
        'type',
        'status',
        //
        // ngày đăng kí
        'datetime_register',
        // tên tiếng anh
        'name_en',
        // chức trách
        'responsibility',
        // chức vụ
        'position',
        // id code
        'code',
    ];
}
