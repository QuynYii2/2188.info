<?php

namespace App\Services;
class CurrencyService
{
    function convertCurrency($price, $countryCode): string
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

