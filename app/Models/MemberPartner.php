<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        // member được follow
        'company_id_source',
        // member đi follow
        'company_id_follow',
        'quantity',
        'price',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(MemberRegisterInfo::class);
    }
}
