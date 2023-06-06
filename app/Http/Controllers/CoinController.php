<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index(Request $request){
        (new HomeController())->getLocale($request);

        $reflector = new \ReflectionClass('App\Enums\CoinCombo');
        $comboCoin = $reflector->getConstants();

        return view('frontend/pages/buy-coin', compact('comboCoin'));
    }
}
