<?php
use App\Models\MemberRegisterPersonSource;
use App\Models\MemberRegisterInfo;

if (!function_exists('getTypeMember')) {
    function getTypeMember()
    {
        $getMemberId = MemberRegisterPersonSource::where('email' , Auth::user()->email)->value('member_id');
        $getMemberType = MemberRegisterInfo::where('id', $getMemberId)->select('id', 'member')->first();

        return $getMemberType;
    }
}