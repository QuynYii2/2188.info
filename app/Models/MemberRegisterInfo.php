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
        // ngành hàng
        'code_business',
        // số đăng kí kinh doanh
        'number_business',
        // ngành nghề
        'type_business',

        'member',
        'member_id',

        'address',
        'status',
        'giay_phep_kinh_doanh',
        //
        // ngày đăng kí
        'datetime_register',
        // số thông quan
        'number_clearance',
        // tên công ty tiếng anh
        'name_en',
        // tên công ty tiếng hàn
        'name_kr',
        // địa chỉ công ty tiếng anh
        'address_en',
        // địa chỉ công ty tiếng hàn
        'address_kr',
        // chứng nhận công ty
        'certify_business',
        // trạng thái công ty
        'status_business',
        // mã hàng 1,2,3,4
        'code_1',
        'code_2',
        'code_3',
        'code_4',

        'email',
        'homepage',
    ];
}
