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
            ->orWhere('code', 'like', $code . '!__')
            ->orderBy('sort_index', 'asc')
            ->get();
        return response()->json($listAddress);
    }

    public function index()
    {
        $states = Address::where('code', 'not like', '%!%')
            ->cursor()
            ->map(function ($state) {
                $cities = Address::where('code', 'like', $state->code . '!__')
                    ->orderBy('sort_index', 'asc')
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

        $name = $request->input('name');
        $sort_index = $request->input('sort_index');
        $status = $request->input('status');
        $isShow = $request->input('isShow');
        $created_by = Auth::user()->id;

        $ld = new TranslateController();
        $nameEN = $ld->translateText($name, 'en');

        $codeParent = $request->input('up_code');

        do {
            $item = DB::table('addresses')->where('code', $code)->first();

            if ($item) {
                $code = (new HomeController())->generateRandomString(2);
            } else {
                break;
            }
        } while (true);

        $address = new Address();
        if ($codeParent) {
            $code = $codeParent . '!' . $code;
            $address->up_code = $codeParent;
        }

        $address->code = $code;
        $address->name = $name;
        $address->sort_index = $sort_index;
        $address->status = $status;
        $address->isShow = $isShow;
        $address->created_by = $created_by;
        $address->name_en = $nameEN;

        $address->save();
        return response()->json($address);
    }

    public function update($id, Request $request)
    {
        $address = Address::find($id);
        $address->name = $request->input('name');
        $address->sort_index = $request->input('sort_index');
        $address->status = $request->input('status');
        $address->isShow = $request->input('isShow');
        $address->updated_by = Auth::user()->id;

        $ld = new TranslateController();
        $nameEN = $ld->translateText($request->input('name'), 'en');

        $address->name_en = $nameEN;
        $address->save();
        return response()->json($address);
    }

    public function changeStatus($id)
    {
        $address = Address::find($id);
        if ($address->status == 1) {
            $address->status = 0;
        } else {
            $address->status = 1;
        }
        $address->save();
        return response()->json($address);
    }

    public function changeShow($id)
    {
        $address = Address::find($id);
        if ($address->isShow == 1) {
            $address->isShow = 0;
        } else {
            $address->isShow = 1;
        }
        $address->save();
        return response()->json($address);
    }

    public function delete($id)
    {
        $address = Address::find($id);
        $delete = Address::where('id', $id)->delete();
        Address::where('code', '=', $address->code)
            ->orWhere('code', 'like', $address->code . '%')->delete();
        if ($delete) {
            return response('success', 200);
        }
        return response('error', 500);
    }
}
