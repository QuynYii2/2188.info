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
        $item = Currency::where([
            ['from', $from],
            ['to', $to],
        ])->first();
        $time = 24;
        if ($item) {
            $createTime = Carbon::parse($item->created_at)->addDay();
            $currentTime = Carbon::now();
            if ($createTime < $currentTime) {
                $rate = getExchangeRate($from, $to, $amount);
                $item->rate = $rate;
                $item->save();
            } else {
                $rate = $item->rate;
                $item->save();
            }
        } else {
            $rate = getExchangeRate($from, $to, $amount);
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

        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert?from='.$from.'&to='.$to.'&amount='.$amount, [
            'headers' => [
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
                'X-RapidAPI-Key' => 'be654f625cmsh6b5bde7af2d1784p19dcd2jsnd8821fdbb687',
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        $rate = $data['info']['rate'];
        return $rate;
    }
}