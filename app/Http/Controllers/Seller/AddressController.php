<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $perPage = $request->query('perPage', 5);
        $countries = Country::orderBy('isShow', 'desc')->orderBy('name')
            ->paginate($perPage);
        $listNation = [];

        foreach ($countries as $country) {
            $states = State::where('country_code', $country->iso2)
                ->where('country_name', $country->name)
                ->orderBy('isShow', 'desc')
                ->get();

            $stateData = $states->map(function ($state) {
                $cities = City::where('state_code', $state->state_code)
                    ->where('country_code', $state->country_code)
                    ->orderBy('isShow', 'desc')
                    ->get(['id', 'name', 'city_code', 'state_code', 'isShow']);

                return [
                    'id' => $state->id,
                    'name' => $state->name,
                    'state_code' => $state->state_code,
                    'country_code' => $state->country_code,
                    'isShow' => $state->isShow,
                    'total_child' => $cities->count(),
                    'child' => $cities->toArray(),
                ];
            });

            $listNation[] = [
                'id' => $country->id,
                'name' => $country->name,
                'country_code' => $country->iso2,
                'isShow' => $country->isShow,
                'total_child' => $states->count(),
                'child' => $stateData,
            ];
        }

        $paginationInfo = $countries;
        return view('backend.address.index', compact('listNation', 'paginationInfo'));
    }

    public function detail(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $address = Address::find($id);
        $listAddress = Address::where('code', 'like', $address->code . '!__')
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
        $listAddress = collect($listAddress);
        return view('backend.address.detail', compact('address', 'listAddress'));
    }


    public function updateStarNation($id)
    {
        $nation = Country::find($id);
        if (!$nation) {
            return response()->json(['message' => 'Không tìm thấy quốc gia'], 404);
        }
        $nation->isShow = !$nation->isShow;
        $nation->save();
        return response('Success!', 200);
    }

    public function updateStarState($id)
    {
        $nation = State::find($id);
        if (!$nation) {
            return response()->json(['message' => 'Không tìm thấy quốc gia'], 404);
        }
        $nation->isShow = !$nation->isShow;
        $nation->save();
        return response('Success!', 200);
    }

    public function updateStarCity($id)
    {
        $nation = City::find($id);
        if (!$nation) {
            return response()->json(['message' => 'Không tìm thấy quốc gia'], 404);
        }
        $nation->isShow = !$nation->isShow;
        $nation->save();
        return response('Success!', 200);
    }
}
