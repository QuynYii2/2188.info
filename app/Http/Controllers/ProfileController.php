<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatus;
use App\Enums\MemberPartnerStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\MemberRegisterType;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\EvaluateProduct;
use App\Models\Member;
use App\Models\MemberPartner;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Product;
use App\Models\ProductViewed;
use App\Models\StaffUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function info(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/info');
    }

    public function memberInfo(Request $request)
    {
        (new HomeController())->getLocale($request);
        $getMemberId = \App\Models\MemberRegisterPersonSource::where('email', Auth::user()->email)->value('member_id');
        $memberId = \App\Models\MemberRegisterPersonSource::where('member_id', $getMemberId)->value('id');
        $memberPersonSource = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = MemberRegisterInfo::find($memberPersonSource->member_id);
        $member = Member::find($company->member_id);
        $member_id = $company->id;
        $exitsMember = $company;

        $categories_no_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', null]
        ])->get();

        $categories_one_parent_array = null;
        foreach ($categories_no_parent as $category) {
            $categories_oneparent = Category::where([
                ['status', CategoryStatus::ACTIVE],
                ['parent_id', $category->id]
            ])->get();
            foreach ($categories_oneparent as $item) {
                $categories_one_parent_array[] = $item;
            }
        }

        $categories_one_parent = collect($categories_one_parent_array);

        $categories_two_parent_array = null;
        foreach ($categories_one_parent as $category) {
            $categories_twoparent = Category::where([
                ['status', CategoryStatus::ACTIVE],
                ['parent_id', $category->id]
            ])->get();
            foreach ($categories_twoparent as $item) {
                $categories_two_parent_array[] = $item;
            }
        }

        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();

        $categories_two_parent = collect($categories_two_parent_array);

        $exitMemberPerson = null;
        if (Auth::check()) {
            $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        }

        if ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::SOURCE) {
            $person = $exitMemberPerson;
        } elseif ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::REPRESENT) {
            $person = MemberRegisterPersonSource::find($exitMemberPerson->person);
        }
        $memberPerson = $exitMemberPerson;

        $person = $person->id;
        $memberRepresent = MemberRegisterPersonSource::find($memberId);
        if (!$memberRepresent) {
            return back();
        }
        $memberSource = MemberRegisterPersonSource::find($memberRepresent->person);
        $findMember = $memberRepresent->email;
        $userRepresent = User::where('email', $findMember)->first();
        $staffUsers = StaffUsers::where('parent_user_id', $userRepresent->id)->get();
        $company = null;
        $memberList = null;
        if ($memberPerson) {
            $company = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
            $memberList = MemberPartner::where([
                ['company_id_source', $company->id],
                ['status', MemberPartnerStatus::ACTIVE]
            ])->get();
        }
        return view('frontend.pages.member.member-profile.member-account', compact('company', 'member', 'exitsMember',
            'categories_no_parent', 'categories_one_parent', 'categories_two_parent',
            'categories', 'memberPerson', 'memberPersonSource', 'person', 'memberRepresent',
            'memberSource', 'staffUsers', 'userRepresent', 'memberList', 'member_id'));
    }

    public function memberPerson(Request $request)
    {
        (new HomeController())->getLocale($request);

        $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $company = MemberRegisterInfo::find($memberPerson->member_id);
        $member_id = $company->id;

        $memberPersonSource = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $exitsMember = null;
        if ($memberPersonSource) {
            $exitsMember = MemberRegisterInfo::where([
                ['id', $memberPersonSource->member_id],
                ['status', MemberRegisterInfoStatus::ACTIVE]
            ])->first();
        }
        return view('frontend.pages.profile.member-person', compact(
            'memberPersonSource',
            'exitsMember',
            'member_id',
        ));
    }

    public function memberRepresent(Request $request)
    {
        (new HomeController())->getLocale($request);
        $exitMemberPerson = null;
        if (Auth::check()) {
            $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        }

        if ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::SOURCE) {
            $person = $exitMemberPerson;
        } elseif ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::REPRESENT) {
            $person = MemberRegisterPersonSource::find($exitMemberPerson->person);
        }
        $memberPerson = $exitMemberPerson;

        $person = $person->id;

        return view('frontend.pages.profile.member-represent', compact(
            'memberPerson',
            'person'
        ));
    }

    public function memberShip($member, Request $request)
    {
        (new HomeController())->getLocale($request);
        $memberRepresent = MemberRegisterPersonSource::find($member);
        if (!$memberRepresent) {
            return back();
        }
        $memberSource = MemberRegisterPersonSource::find($memberRepresent->person);
        $findMember = $memberRepresent->email;
        $userRepresent = User::where('email', $findMember)->first();
        $staffUsers = StaffUsers::where('parent_user_id', $userRepresent->id)->get();
        return view('frontend.pages.profile.member-staff',
            compact('memberRepresent', 'memberSource', 'staffUsers', 'userRepresent'));
    }

    public function my_notification(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/my-notification');
    }

    public function order_management(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/order-management');
    }

    public function return_management(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/return-management');
    }

    public function address_book(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/address-book');
    }

    public function payment_information(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/payment-information');
    }

    public function product_evaluation(Request $request)
    {
        (new HomeController())->getLocale($request);
        $listEvaluate = EvaluateProduct::where('user_id', Auth::user()->id)->get();

        return view('frontend/pages/profile/product-evaluation', compact('listEvaluate'));
    }

    public function favorite_product(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/favorite-product');
    }

    public function product_viewed(Request $request)
    {
        (new HomeController())->getLocale($request);
        $listProductIDs = ProductViewed::where('user_id', Auth::user()->id)->first();
        $arrayProducts = null;
        if ($listProductIDs) {
            $productIds = $listProductIDs->productIds;
            if ($productIds != null) {
                $arrayIds = explode(",", $productIds);
                for ($i = 0; $i < count($arrayIds); $i++) {
                    if ($arrayIds[$i] != null) {
                        $product = Product::find($arrayIds[$i]);
                        $arrayProducts[] = $product;
                    }
                }
            }
        }
        return view('frontend/pages/profile/product-viewed', compact('arrayProducts'));
    }

    public function my_review(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/my-review');
    }
}
