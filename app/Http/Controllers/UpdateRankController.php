<?php

namespace App\Http\Controllers;

use App\Enums\MemberRegisterInfoStatus;
use App\Models\MemberRegisterInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateRankController extends Controller
{
    public function detail()
    {
        $user = Auth::user();
        $member = MemberRegisterInfo::where([
            ['user_id', $user->id],
            ['status', MemberRegisterInfoStatus::ACTIVE]
        ])->first();
        return view('frontend.pages.member.user.detail', compact('member'));
    }

    public function updateMember(Request $request)
    {
        $user = Auth::user();
        try {
            $member = MemberRegisterInfo::where('user_id', $user->id)->first();
            if (!$member) {
                alert()->error('Error', 'Error, Not found!');
                return back();
            }
            $member->member = $request->input('member');
            $member->save();

            alert()->success('Success', 'Success, Update success!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }
}
