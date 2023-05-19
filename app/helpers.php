<?php

use GeoIp2\Database\Reader;

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
    function convertCurrency($price, $countryCode)
    {
        switch ($countryCode) {
            case 'vi':
                return number_format($price, 0, ',', '.') . ' VND';
            case 'kr':
                return number_format($price * 570, 0, ',', '.') . ' KRW';
            case 'jp':
                return '¥' . number_format($price * 109, 0, ',', '.');
            case 'cn':
                return '¥' . number_format($price * 6.5, 0, ',', '.');
            default:
                return number_format($price, 2) . ' USD';
        }
    }
}
