<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = Address::where('code', 'not like', '%!%')
            ->cursor()
            ->map(function ($state) {
                $cities = Address::where('code', 'like', $state->code.'!__')
                    ->where('isShow', '=', '1')
                    ->orderBy('sort_index', 'asc')
                    ->get();

                return [
                    'name' => $state->name ?? '',
                    'code' => $state->code ?? '',
                    'name_en' => $state->name_en ?? '',
                    'total_child' => $cities->count(),
                    'child' => $cities->toArray(),
                ];
            })
            ->filter(function ($state) {
                return $state['total_child'] !== 0;
            });


        return response()->json($states);
    }

    public function splitStateCode($code, $checkRegion)
    {
        if ($checkRegion == 0) {
            $lengCode = count(explode('!', $code));
            return $lengCode;
        }
        return $checkRegion;
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
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $checkRegion = 0;

        $listAddress = Address::where('code', $code)
            ->cursor()
            ->map(function ($pAddress) use (&$checkRegion) {
                $checkRegion = $this->splitStateCode($pAddress->code, $checkRegion);

                $cAddresses = Address::where('code', 'like', $pAddress->code.'!__')
                    ->orderBy('sort_index', 'asc')
                    ->get();

                if ($cAddresses->count() !== 0 && $checkRegion === 2) {
                    $cAddresses = $cAddresses->filter(function ($cAdd) {
                        return $cAdd['isShow'] != null && $cAdd['isShow'] != 0;
                    });
                }

                return [
                    'id' => $pAddress->id,
                    'code' => $pAddress->code,
                    'name' => $pAddress->name,
                    'name_en' => $pAddress->name_en,
                    'isShow' => $pAddress->isShow,
                    'total_child' => $cAddresses->count(),
                    'child' => $cAddresses->toArray(),
                ];
            });

        return response()->json($listAddress);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
