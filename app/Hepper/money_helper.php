<?php

use App\Models\Currency;
use Illuminate\Support\Carbon;

if (!function_exists('convertCurrency')) {
    function convertCurrency($from, $to, $amount)
    {
        $rate = convertCurrencyDB($from, $to, $amount);
        return $rate * $amount;
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


    function getExchangeRate($from, $to, $amount)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert?from='.$from.'&to='.$to.'&amount='.$amount, [
            'headers' => [
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
                'X-RapidAPI-Key' => '8952fb2442msha95d77aae500e2fp1de1adjsn9039eaaf3beb',
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        $rate = $data['info']['rate'];
        return $rate;
    }
}