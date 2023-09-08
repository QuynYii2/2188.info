<?php

use App\Models\Currency;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;


if (!function_exists('convertCurrency')) {
    function convertCurrency($from, $to, $amount)
    {
        switch ($from) {
            case 'vi':
                $currentFrom = 'VND';
                break;
            case 'kr':
                $currentFrom = 'KRW';
                break;
            case 'cn':
                $currentFrom = 'CNY';
                break;
            default:
                $currentFrom = 'USD';
        }
//        $rate = convertCurrencyDB($currentFrom, $to, $amount);
//        if ($rate != 1) {
//            return $rate * $amount;
//        } else {
        $rate = subConvertCurrencyDB($currentFrom, $to, $amount);
        return $rate*$amount;
//        }
    }

    function convertCurrencyDB($from, $to, $amount)
    {
        $cacheKey = "exchange_rate_{$from}_{$to}";
        $cachedRate = Cache::get($cacheKey);

        if (!$cachedRate) {
            $cachedRate = getExchangeRate($from, $to, $amount);
            Cache::put($cacheKey, $cachedRate, 1440);
        }

        $item = Currency::where([
            ['from', $from],
            ['to', $to],
        ])->first();

        if ($item) {
            $createTime = Carbon::parse($item->created_at)->addDay();
            $currentTime = Carbon::now();
            if ($createTime < $currentTime) {
                $item->rate = $cachedRate;
                $item->save();
            } else {
                $cachedRate = $item->rate;
            }
        } else {
            $currency = new Currency();
            $currency->from = $from;
            $currency->to = $to;
            $currency->rate = $cachedRate;
            $currency->save();
        }

        return $cachedRate;
    }

    function subConvertCurrencyDB($from, $to, $amount)
    {
        $item = Currency::where([
            ['from', $from],
            ['to', $to],
        ])->first();

        if ($item) {
            $createTime = Carbon::parse($item->created_at)->addDay();
            $currentTime = Carbon::now();
            if ($createTime < $currentTime) {
                $rate = subGetExchangeRate($from, $to, $amount);
                $item->rate = $rate;
                $item->save();
            } else {
                $rate = $item->rate;
            }
        } else {
            $rate = subGetExchangeRate($from, $to, $amount);
            $currency = new Currency();
            $currency->from = $from;
            $currency->to = $to;
            $currency->rate = $rate;
            $currency->save();
        }
        return $rate;
    }


    function getExchangeRate($from, $to, $amount)
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert?from=' . $from . '&to=' . $to . '&amount=' . $amount, [
            'headers' => [
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
                'X-RapidAPI-Key' => 'eb9ba2aa18msh85ccd247d114b7bp125ddfjsndcb93a58ed8f',
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        $rate = null;
        if ($data['success'] == true) {
            $rate = $data['info']['rate'];
        }

        return $rate;
    }

    function subGetExchangeRate($from, $to, $amount)
    {
        $client = new \GuzzleHttp\Client();
        $amount = 1;
        $url = 'https://currency-converter-by-api-ninjas.p.rapidapi.com/v1/convertcurrency?have=' . $from . '&want=' . $to . '&amount=' . $amount;
        $response = $client->request('GET', $url, [
            'headers' => [
                'X-RapidAPI-Host' => 'currency-converter-by-api-ninjas.p.rapidapi.com',
                'X-RapidAPI-Key' => '79b4b17bc4msh2cb9dbaadc30462p1f029ajsn6d21b28fc4af',
            ],
        ]);
        $item = $response->getBody();
        $jsonData = $item->getContents();
        $data = json_decode($jsonData, true);
        $new_amount = $data['new_amount'];
        return $new_amount;
    }
}