<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function getCurrency(Request $request, $amount)
    {
        $currency = (new HomeController())->getLocation($request);
        $total = number_format(convertCurrency('USD', $currency, $amount), 0, ',', '.');
        $str = $total . ' ' . $currency;
        return $str;
    }

    public function getCurrencyLocal($currency, $amount)
    {
        $total = number_format(convertCurrency('USD', $currency, $amount), 0, ',', '.');
        $str = $total . ' ' . $currency;
        return $str;
    }
}
