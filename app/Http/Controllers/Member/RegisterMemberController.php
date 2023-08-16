<?php

namespace App\Http\Controllers\Member;

use App\Enums\MemberRegisterInfoStatus;
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

    public function saveProduct(Request $request)
    {
        $id = $request->input('idProduct');
        $product = Product::find($id);
        session()->forget('firstProduct');
        session()->push('firstProduct', $product);
        return view('frontend/pages/member/product');
    }
}
