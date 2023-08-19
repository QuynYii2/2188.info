<?php

namespace App\Http\Controllers\Member;

use App\Enums\MemberPartnerStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\MemberPartner;
use App\Models\MemberRegisterInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrustMemberController extends Controller
{
    public function memberStand(Request $request)
    {
        (new HomeController())->getLocale($request);
        $company = MemberRegisterInfo::where([
            ['user_id', Auth::user()->id],
            ['status', MemberRegisterInfoStatus::ACTIVE]
        ])->first();
        $companies = MemberRegisterInfo::where('category_id', $company->category_id)->get();
        return view('frontend.pages.member.trust.member-trust', compact('companies','company'));
    }

    public function memberPartnerLocale($locale)
    {
        $company = MemberRegisterInfo::where('user_id', Auth::user()->id)->first();
        $companies = MemberRegisterInfo::where('category_id', $company->category_id)->get();
        return view('frontend.pages.member.trust.member-trust-locale', compact('company', 'companies', 'locale'));
    }
}
