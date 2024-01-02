<?php

use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\StaffUsers;
use App\Models\User;

if (!function_exists('getTypeMember')) {
    function getTypeMember()
    {
        $getMemberType = null;
        if (Auth::check()) {
            $getMemberId = MemberRegisterPersonSource::where('email', Auth::user()->email)->value('member_id');
            if (!$getMemberId) {
                /* Check nếu công ty không tồn tại thì nó có thể là nhân viên*/
                $user_parent = StaffUsers::where('user_id', Auth::user()->id)->first();
                $user = User::find($user_parent->parent_user_id);
                $getMemberId = MemberRegisterPersonSource::where('email', $user->email)->value('member_id');
            }

            $getMemberType = MemberRegisterInfo::where('id', $getMemberId)->select('id', 'member')->first();
        }
        return $getMemberType;
    }
}