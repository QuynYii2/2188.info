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
    public function show($code)
    {
        $listAddress = DB::table('addresses')
            ->where('code', '=', $code)
            ->orWhere('code', 'like', $code . '!__')->get();
        return response()->json($listAddress);
    }

    public function index()
    {
        $states = Address::where('code',  'not like', '%!%')
            ->cursor()
            ->map(function ($state) {
                $cities = Address::where('code','like', $state->code . '!__')
                    ->get();

                return [
                    'name' => $state->name,
                    'code' => $state->code,
                    'name_en' => $state->name_en,
                    'total_child' => $cities->count(),
                    'child' => $cities->toArray(),
                ];
            });

        return response()->json($states);
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
