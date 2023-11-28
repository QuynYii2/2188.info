<?php

namespace App\Http\Controllers\Member;

use App\Enums\MemberRegisterInfoStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrustMemberController extends Controller
{
    public function memberStand(Request $request)
    {

        $isAdmin = (new HomeController())->checkAdmin();

        $locale = app()->getLocale();
        if (!$locale) {
            $locale = $request->session()->get('locale');
        }
        if (!$locale) {
            $locale = 'kr';
        }

        if (!$isAdmin) {
            $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            (new HomeController())->getLocale($request);
            $company = MemberRegisterInfo::where([
                ['id', $memberPerson->member_id],
                ['status', MemberRegisterInfoStatus::ACTIVE]
            ])->first();

            $companies = $this->queryMember($company, $locale);

            return view('frontend.pages.member.trust.member-trust', compact('companies', 'company'));
        } else {
            return back();
        }
    }

    public function memberPartnerLocale(Request $request, $locale)
    {
        (new HomeController())->getLocale($request);
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = MemberRegisterInfo::where([
            ['id', $memberPerson->member_id],
            ['status', MemberRegisterInfoStatus::ACTIVE]
        ])->first();
        $companies = $this->queryMember($company, $locale);
        return view('frontend.pages.member.trust.member-trust-locale', compact('company', 'companies', 'locale'));
    }

    public function queryMember($company, $locale)
    {
        $companies = DB::table('member_register_infos')
            ->join('member_register_person_sources', 'member_register_person_sources.member_id', '=', 'member_register_infos.id')
            ->join('users', 'users.email', '=', 'member_register_person_sources.email')
            ->where('member_register_infos.id', '!=', $company->id)
            ->where('users.region', $locale)
            ->where('member_register_infos.member', $company->member)
            ->where('member_register_infos.category_id', 'like', '%' . $company->category_id . '%')
            ->where('member_register_infos.status', MemberRegisterInfoStatus::ACTIVE)
            ->select('member_register_infos.*', 'users.region')
            ->distinct()
            ->paginate(30);
        return $companies;
    }
}
