<?php

namespace App\Http\Controllers\Member;

use App\Enums\CartStatus;
use App\Enums\MemberPartnerStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\RegisterMember;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\MemberPartner;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterMemberController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $memberCompanys = MemberRegisterInfo::where('status', MemberRegisterInfoStatus::ACTIVE)->get();
        $member = MemberRegisterPersonSource::where('user_id', Auth::user()->id)->first();
        $check = null;
        if ($member) {
            $check = 'pass';
        }
        if (!$check) {
            toast('Vui lòng đăng kí thành hội viên', 'error', 'top-right');
            return redirect(route('process.register.member'));
        }
        return view('frontend/pages/member/index', compact('memberCompanys'));
    }

    public function memberStand(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $company = MemberRegisterInfo::find($id);
        if ($company && $company->member == RegisterMember::TRUST) {
            return back();
        }
        $currency = (new \App\Http\Controllers\Frontend\HomeController())->getLocation($request);
        return view('frontend.pages.member.stand-member', compact('company','currency'));
    }

    public function memberParent(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $company = MemberRegisterInfo::find($id);
        $carts = DB::table('carts')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->join('member_register_infos', 'member_register_infos.user_id', '=', 'carts.user_id')
            ->where([['products.user_id', $company->user_id], ['carts.member', 1], ['carts.status', CartStatus::WAIT_ORDER]])
            ->select('carts.*', 'member_register_infos.name', 'member_register_infos.member', 'member_register_infos.address')
            ->get();
        return view('frontend.pages.member.member-partner', compact('company', 'carts'));
    }

    public function memberPartner(Request $request)
    {
        (new HomeController())->getLocale($request);
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = null;
        $memberList = null;
        if ($memberPerson) {
            $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();

            $memberList = MemberPartner::where([
                ['company_id_source', $company->id],
                ['status', MemberPartnerStatus::ACTIVE]
            ])->get();
        }
        session()->forget('region');
        if ($company && $company->member == RegisterMember::TRUST) {
            return back();
        }
        return view('frontend.pages.member.member-partner', compact('company', 'memberList'));
    }

    public function memberPartnerLocale($locale)
    {
        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = null;
        $memberList = null;
        if ($memberPerson) {
            $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();

            $memberList = MemberPartner::where([
                ['company_id_source', $company->id],
                ['status', MemberPartnerStatus::ACTIVE]
            ])->get();
        }
        session()->forget('region');
        session()->put('region', $locale);
        if ($company && $company->member == RegisterMember::TRUST) {
            return back();
        }
        return view('frontend.pages.member.member-partner', compact('company', 'memberList'));
    }

    public function saveProduct(Request $request)
    {
        $id = $request->input('idProduct');
        $product = Product::find($id);
        session()->forget('firstProduct');
        session()->push('firstProduct', $product);
        return view('frontend/pages/member/product');
    }
}
