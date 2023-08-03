<?php

namespace App\Http\Controllers\Member;

use App\Enums\MemberRegisterInfoStatus;
use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterMemberController extends Controller
{
    public function index(Request $request)
    {
//        $isMember = MemberRegisterPersonSource::where([
//            ['email', Auth::user()->email],
//            ['check', 1]
//        ])->first();
//
//        if ($isMember) {
        (new HomeController())->getLocale($request);
//            $memberCompany = MemberRegisterInfo::find($isMember->member_id);
        $memberCompanys = MemberRegisterInfo::where('status', MemberRegisterInfoStatus::ACTIVE)->get();
//        $products = Product::where([['user_id', Auth::user()->id], ['status', ProductStatus::ACTIVE]])->get();
//        return view('frontend/pages/member/index', compact('products', 'memberCompany'));
        return view('frontend/pages/member/index', compact('memberCompanys'));
//        } else {
//            return back();
//        }
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
