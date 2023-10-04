<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listNation = [];
        $perPage = 20;

        Country::where('isShow', '1')
            ->orderBy('continents')
            ->orderBy('name')
            ->chunk($perPage, function ($countries) use (&$listNation) {
                foreach ($countries as $country) {
                    $states = State::where('country_code', $country->iso2)
                        ->where('country_name', $country->name)
                        ->get();

                    $stateData = $states->map(function ($state) {
                        $cities = City::where('state_code', $state->state_code)
                            ->where('country_code', $state->country_code)
                            ->get(['name', 'city_code', 'state_code']);

                        return [
                            'name' => $state->name,
                            'state_code' => $state->state_code,
                            'country_code' => $state->country_code,
                            'total_child' => $cities->count(),
                            'child' => $cities->toArray(),
                        ];
                    });

                    $listNation[] = [
                        'name' => $country->name,
                        'country_code' => $country->iso2,
                        'isShow' => $country->isShow,
                        'total_child' => $states->count(),
                        'child' => $stateData,
                    ];
                }
            });

        return response()->json($listNation);



        $listNation = Country::where('isShow', '1')
            ->orderBy('continents')
            ->orderBy('name')
            ->cursor()
            ->map(function ($country) {
                $states = State::where('country_code', $country->iso2)
                    ->where('country_name', $country->name)
                    ->cursor()
                    ->map(function ($state) {
                        $cities = City::where('state_code', $state->state_code)
                            ->where('country_code', $state->country_code)
                            ->get(['name', 'city_code', 'state_code']);

                        return [
                            'name' => $state->name,
                            'state_code' => $state->state_code,
                            'country_code' => $state->country_code,
                            'total_child' => $cities->count(),
                            'child' => $cities->toArray(),
                        ];
                    });

                return [
                    'name' => $country->name,
                    'country_code' => $country->iso2,
                    'isShow' => $country->isShow,
                    'total_child' => $states->count(),
                    'child' => $states->toArray(),
                ];
            });

        return response()->json($listNation);

        return view('backend.address.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
