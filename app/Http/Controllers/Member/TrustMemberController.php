<?php

namespace App\Http\Controllers\Member;

use App\Enums\MemberRegisterInfoStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrustMemberController extends Controller
{
    public function memberStand(Request $request)
    {

        $isAdmin = (new HomeController())->checkAdmin();
        if (!$isAdmin) {
            $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            (new HomeController())->getLocale($request);
            $company = MemberRegisterInfo::where([
                ['id', $memberPerson->member_id],
                ['status', MemberRegisterInfoStatus::ACTIVE]
            ])->first();
            $companies = MemberRegisterInfo::where('category_id', $company->category_id)->get();
            return view('frontend.pages.member.trust.member-trust', compact('companies', 'company'));
        } else {
            return back();
        }
    }

    public function memberPartnerLocale(Request $request, $locale)
    {
        (new HomeController())->getLocale($request);
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
        $companies = MemberRegisterInfo::where('category_id', $company->category_id)->get();
        return view('frontend.pages.member.trust.member-trust-locale', compact('company', 'companies', 'locale'));
    }
}
