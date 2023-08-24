<?php

use App\Models\Currency;
use Carbon\Carbon;
use GeoIp2\Database\Reader;
use \GuzzleHttp\Client;

if (!function_exists('get_country_from_ip')) {
    function get_country_from_ip($ip)
    {
        $apiKey = env('MAXMIND_API_KEY');
        $database = storage_path('app/geoip/GeoLite2-Country.mmdb');

        if (!file_exists($database)) {
            throw new Exception('GeoIP database not found');
        }

        $reader = new Reader($database);
        $record = $reader->country($ip);

        return $record->country->isoCode;
    }
}

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
        $client = new Client();
        $response = $client->request('GET', 'https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert', [
            'query' => [
                'to' => $to,
                'from' => $from,
                'amount' => $amount,
            ],
            'headers' => [
                'X-RapidAPI-Key' => env('KEY_CONVERT_CURRENCY'),
                'X-RapidAPI-Host' => 'currency-conversion-and-exchange-rates.p.rapidapi.com',
            ],
        ]);
        $responseBody = $response->getBody()->getContents();
        $data = json_decode($responseBody, true);
        $rate = $data['info']['rate'];
        return $rate;
    }
}
