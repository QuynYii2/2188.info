<?php

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

if (!function_exists('convertCurrency')) {
    function convertCurrency($from, $to, $amount)
    {
        $fromCache = Cache::get('from');
        $toCache = Cache::get('to');
        if (Cache::has('exchange_rate') && $fromCache == $from && $toCache == $to) {
            $rate = Cache::get('exchange_rate');
        } else {
            $rate = getExchangeRate($from, $to, $amount);
        }
        return $rate * $amount;

    }

    function getExchangeRate($from, $to, $amount)
    {


        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert?from='.$from.'&to='.$to.'&amount='.$amount, [
            'headers' => [
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
                'X-RapidAPI-Key' => '7b2135e174msh19d71786a52d326p108060jsn3bec55c24554',
            ],
        ]);


        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
//        dd($data['info']['rate']);
        $rate = $data['info']['rate'];
        $time = 300; //5 minute
        Cache::flush();
        Cache::put('from', $from, $time);
        Cache::put('to', $to, $time);
        Cache::put('exchange_rate', $rate, $time);

        return $rate;
    }
}