<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $states = Address::where('code', 'not like', '%!%')
            ->where('isShow', '=', '1')
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

    public function show($code)
    {
        $checkRegion = 0;

        $listAddress = Address::where('code', $code)
            ->where('isShow', '=', '1')
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

    public function showRegion($code)
    {
        $listAddress = Address::where('code', 'like', $code . '!__')
            ->where('isShow', '=', '1')
            ->orderBy('sort_index', 'asc')
            ->cursor()
            ->map(function ($pAddress) {
                $cAddresses = Address::where('code', 'like', $pAddress->code . '!__')
                    ->orderBy('sort_index', 'asc')
                    ->where('isShow', 1)
                    ->get();

                return [
                    'id' => $pAddress->id,
                    'code' => $pAddress->code,
                    'name' => $pAddress->name,
                    'name_en' => $pAddress->name_en,
                    'total_child' => $cAddresses->count(),
                    'child' => $cAddresses->toArray(),
                ];
            })->filter(function ($cAddress) {
                return $cAddress['total_child'] != 0;
            });
        return response()->json($listAddress);
    }
}
