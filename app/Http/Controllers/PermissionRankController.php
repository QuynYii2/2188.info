<?php

namespace App\Http\Controllers;

use App\Enums\PermissionUserStatus;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionRankController extends Controller
{
    public function index(Request $request){
        (new HomeController())->getLocale($request);
        $permissions = DB::table('permission_user')->where([['user_id', Auth::user()->id],['status', PermissionUserStatus::ACTIVE]])->get();

        return view('frontend/pages/profile/rank', compact('permissions'));
    }
}
