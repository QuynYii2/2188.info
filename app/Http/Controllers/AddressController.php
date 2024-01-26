<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\Address;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class AddressController extends Controller
{

    public function index()
    {
        $states = Address::where('code', 'not like', '%!%')
            ->where('isShow', '=', '1')
            ->cursor()
            ->map(function ($state) {
                $cities = Address::where('code', 'like', $state->code . '!__')
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

    public function show($code)
    {
        $checkRegion = 0;

        $listAddress = Address::where('code', $code)
            ->where('isShow', '=', '1')
            ->cursor()
            ->map(function ($pAddress) use (&$checkRegion) {
                $checkRegion = $this->splitStateCode($pAddress->code, $checkRegion);

                $cAddresses = Address::where('code', 'like', $pAddress->code . '!__')
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

    public function splitStateCode($code, $checkRegion)
    {
        if ($checkRegion == 0) {
            $lengCode = count(explode('!', $code));
            return $lengCode;
        }
        return $checkRegion;
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

    public function getDataAddressFromNn21Kr()
    {
        $timeEnd = 60 * 60 * 24 * 30;

        $cacheKey = 'listDataFromNn21Kr';
        $listDataFromNn21Kr = Cache::get($cacheKey, function () {
            return $this->callApi();
        });


        foreach ($listDataFromNn21Kr as $key => $item) {
            if ($item->id == 10000) {
                unset($listDataFromNn21Kr[$key]);
                continue;
            }
            if ($item->parent_id == 10000) {
                $this->saveDataToDB($item);
                unset($listDataFromNn21Kr[$key]);
            }
        }
        Cache::put('listDataFromNn21Kr', $listDataFromNn21Kr, $timeEnd);

        sort($listDataFromNn21Kr);

        while (!empty($listDataFromNn21Kr)) {
            $listAddress = Address::all();

            foreach ($listAddress as $item) {
                foreach ($listDataFromNn21Kr as $key => $address) {
//chưa check lỗi 940
                    if ($item->created_by != $address->parent_id ) {
                        continue;
                    }

                    $this->saveDataToDB($address, $item->code);
                    unset($listDataFromNn21Kr[$key]);
                    error_log(count($listDataFromNn21Kr));
                }
                Cache::put('listDataFromNn21Kr', $listDataFromNn21Kr, $timeEnd);
            }
        }

        return response()->json(['message' => 'success']);

    }

    private function callApi()
    {
        $url = 'http://118.27.193.239:8088/region/regionListTreeJson';

        $headers = [
            'AJAX' => 'Y',
            'Accept' => 'application/json, text/javascript, */*; q=0.01',
            'Accept-Language' => 'vi,en-US;q=0.9,en;q=0.8,vi-VN;q=0.7,ko;q=0.6,ja;q=0.5',
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Origin' => 'http://118.27.193.239:8088',
            'Referer' => 'http://118.27.193.239:8088/region/region3?menu_id=10107&screen_id=&menu_nm=%EC%A3%BC%EC%86%8C%EA%B4%80%EB%A6%AC&js_url=',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
            'X-Requested-With' => 'XMLHttpRequest',
        ];


        $client = new Client();

        try {
            $response = $client->request('GET', $url, [
                'headers' => $headers,
            ]);

            $body = $response->getBody();
            // Now you can handle the $body as needed
            return (json_decode($body->getContents())->treeData);
        } catch (Exception $e) {
            // Handle exceptions, if any
            return 'Error: ' . $e->getMessage();
        }
    }

    private function saveDataToDB($item, $parent_code = '')
    {
        $code = (new HomeController())->generateRandomString(2);
        if ($parent_code) {
            $code = $parent_code . '!' . $code;
        }
        $address = new Address();
        $address->code = $code;
        $address->name = $item->name;
        $address->name_en = $this->callApiReEngName($item->id);
        $address->sort_index = $item->sort_seq;
        $address->created_by = $item->id;

        $address->save();
    }

    private function callApiReEngName($code)
    {
        $url = 'http://118.27.193.239:8088/region/regionList2DepthJson';

        $headers = [
            'AJAX' => 'Y',
            'Accept' => 'application/json, text/javascript, */*; q=0.01',
            'Accept-Language' => 'vi,en-US;q=0.9,en;q=0.8,vi-VN;q=0.7,ko;q=0.6,ja;q=0.5',
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Origin' => 'http://118.27.193.239:8088',
            'Referer' => 'http://118.27.193.239:8088/region/region3?menu_id=10107&screen_id=&menu_nm=%EC%A3%BC%EC%86%8C%EA%B4%80%EB%A6%AC&js_url=',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
            'X-Requested-With' => 'XMLHttpRequest',
        ];


        $client = new Client();
        $data = [
            'levels' => '',
            'upcode' => '',
            'code' => $code,
            'use_yn' => '',
        ];

        try {
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'form_params' => $data,
            ]);

            $body = $response->getBody();
            // Now you can handle the $body as needed
            return (json_decode($body->getContents())->userdata->region_enm);
        } catch (Exception $e) {
            // Handle exceptions, if any
            return 'Error: ' . $e->getMessage();
        }
    }

    public function removeData()
    {
        Address::truncate();
        Cache::flush();
    }
}
