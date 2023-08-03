<?php

namespace App\Http\Controllers;

use App\Models\StatisticShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticShopController extends Controller
{
    public function getStatisticShops()
    {
        $statisticShop = StatisticShop::where('user_id', Auth::user()->id)->orderBy('datetime', 'desc')->limit(2)->get();
        $myArray = null;
        $items = null;
        foreach ($statisticShop as $shop) {
            $items[] = [$shop->access, $shop->views, $shop->orders, $shop->datetime];
            $myArray[] = $items;
        }
        return $myArray;
    }
}
