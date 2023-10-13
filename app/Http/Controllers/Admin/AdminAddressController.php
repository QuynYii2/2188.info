<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\TranslateController;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAddressController extends Controller
{
    public function index($code)
    {
        $listAddress = DB::table('addresses')->where('phone', 'like', $code . '!__')->get();
        return response()->json($listAddress);
    }

    public function create(Request $request)
    {
        $code = (new HomeController())->generateRandomString(2);

        do {
            $address = DB::table('addresses')->where('code', $code)->first();

            if ($address) {
                $code = (new HomeController())->generateRandomString(2);
            } else {
                break;
            }
        } while (true);

        $name = $request->input('name');
        $status = $request->input('status');
        $isShow = $request->input('isShow');
        $created_by = Auth::user()->id;
        $ld = new TranslateController();

        $nameEN = $ld->translateText($name, 'en');
        $address = new Address();
        $address->name = $name;
        $address->status = $status;
        $address->isShow = $isShow;
        $address->created_by = $created_by;
        $address->name_en = $nameEN;

        $address->save();
        return response()->json($address);
    }
}
