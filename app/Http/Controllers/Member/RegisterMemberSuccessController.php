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
use App\Models\StaffUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterMemberSuccessController extends Controller
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
        $memberAccounts = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->get();
        if (!$memberAccounts->isEmpty()) {
            $products = \App\Models\Product::where(function ($query) use ($company, $memberAccounts) {
                if (count($memberAccounts) == 2) {
                    $user1 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                    $user2 = \App\Models\User::where('email', $memberAccounts[1]->email)->first();
                } else {
                    $user1 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                    $user2 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                }

                $query->where([['user_id', $company->user_id], ['status', \App\Enums\ProductStatus::ACTIVE]])
                    ->orWhere([['user_id', $user1->id], ['status', \App\Enums\ProductStatus::ACTIVE]])
                    ->orWhere([['user_id', $user2->id], ['status', \App\Enums\ProductStatus::ACTIVE]]);
            })->paginate(6);
        } else {
            $products = \App\Models\Product::where([['user_id', $company->user_id], ['status', \App\Enums\ProductStatus::ACTIVE]])->paginate(6);
        }
        $currency = (new \App\Http\Controllers\Frontend\HomeController())->getLocation($request);
        if ($request->ajax()) {
            $view = view('products-member', compact('products', 'currency'))->render();
            return response()->json(['html' => $view]);
        }
        $firstProduct = null;
        if (!$products->isEmpty()) {
            $firstProduct = $products[0];
        }
        return view('frontend.pages.member.stand-member', compact('company', 'currency','products', 'firstProduct' , 'id'));
    }

    public function staffInfo($memberId)
    {
        $staffUsers = StaffUsers::where('parent_user_id', Auth::user()->id);
        return view('frontend.pages.member.tab-staff-member',compact('staffUsers'));
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

    public function memberPartnerLocale($locale, Request $request)
    {
        $homeController = new HomeController();
        $homeController->getLocale($request);

        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        if (!$memberPerson) {
            return back();
        }

        $company = MemberRegisterInfo::find($memberPerson->member_id);
        if (!$company) {
            return back();
        }

        if ($company->member == RegisterMember::TRUST || $company->member == RegisterMember::BUYER) {
            return back();
        }

        $memberList = DB::table('member_register_infos')
            ->join('member_register_person_sources', 'member_register_person_sources.member_id', '=', 'member_register_infos.id')
            ->join('users', 'users.email', '=', 'member_register_person_sources.email')
            ->where([
                ['users.region', $locale],
                ['member_register_infos.id', '!=', $company->id],
                ['member_register_infos.member', $company->member],
                ['member_register_infos.type_business', $company->type_business],
                ['member_register_infos.status', MemberRegisterInfoStatus::ACTIVE]
            ])
            ->select('member_register_infos.*', 'users.region')
            ->get();
        $memberList = $memberList->unique();

        return view('frontend.pages.member.member-partner-locale', compact('company', 'memberList', 'locale'));
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
