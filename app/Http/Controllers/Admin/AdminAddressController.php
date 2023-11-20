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
        $listAddress = Address::where('code', '=', $code)
            ->cursor()
            ->map(function ($pAddress) {
                $cAddresses = Address::where('code', 'like', $pAddress->code . '!__')
                    ->orderBy('sort_index', 'asc')
                    ->get();

                return [
                    'id' => $pAddress->id,
                    'code' => $pAddress->code,
                    'name' => $pAddress->name,
                    'name_en' => $pAddress->name_en,
                    'total_child' => $cAddresses->count(),
                    'child' => $cAddresses->toArray(),
                ];
            });
        return response()->json($listAddress);
    }
    public function showRegion($code)
    {
        $listAddress = Address::where('code', 'like', $code . '!__')
            ->orderBy('sort_index', 'asc')
            ->cursor()
            ->map(function ($pAddress) {
                $cAddresses = Address::where('code', 'like', $pAddress->code . '!__')
                    ->orderBy('sort_index', 'asc')
                    ->get();

                return [
                    'id' => $pAddress->id,
                    'code' => $pAddress->code,
                    'name' => $pAddress->name,
                    'name_en' => $pAddress->name_en,
                    'total_child' => $cAddresses->count(),
                    'child' => $cAddresses->toArray(),
                ];
            });
        return response()->json($listAddress);
    }

    public function index()
    {
        $states = Address::where('code', 'not like', '%!%')
            ->orderBy('sort_index', 'asc')
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

    public function modifyAddress(Request $request)
    {
        switch ($request->input('mode')) {
            case 'create':
                return $this->create($request);
                break;
            case 'edit':
                return $this->update($request);
                break;
        }
        return back();
    }

    public function create($request)
    {
        $code = (new HomeController())->generateRandomString(2);

        $name = $request['name'];
        $nameEN = $request['name_en'];
        $sort_index = $request['sort_index'];
        $status = $request['status'];
        $isShow = $request['isShow'] ?? 1;
        $codeParent = $request['up_code'];

        $created_by = Auth::user()->id;

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

        return $address;
    }

    public function update($request)
    {
        $id = $request['up_code'];
        $address = Address::find($id);

        $name = $request['name'];
        $nameEN = $request['name_en'];
        $sort_index = $request['sort_index'];
        $status = $request['status'];
        $isShow = $request['isShow'] ?? 1;

        $address->name = $name;
        $address->name_en = $nameEN;
        $address->sort_index = $sort_index;
        $address->status = $status;
        $address->isShow = $isShow;
        $address->updated_by = Auth::user()->id;

        $address->save();

        return $address;
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
        return back();
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
        return back();
    }

    public function delete($id)
    {
        $address = Address::find($id);
        $delete = Address::where('id', $id)->delete();
        Address::where('code', '=', $address->code)
            ->orWhere('code', 'like', $address->code . '%')->delete();
        return back();
    }

    public function getById($id)
    {
        $address = Address::where('id', '=', $id)
            ->orderBy('sort_index', 'asc')
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

        return response()->json($address);
    }
}
