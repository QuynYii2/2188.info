<?php

namespace App\Http\Controllers;

use App\Models\StatisticShop;
use Illuminate\Http\Request;

class StatisticShopController extends Controller
{
    public function getStatisticShops()
    {
        $statisticShop = StatisticShop::orderBy('datetime', 'desc')->limit(2)->get();
        $myArray = null;
        $items = null;
        foreach ($statisticShop as $shop) {
            $items[] = [$shop->access, $shop->views, $shop->orders, $shop->datetime];
            $myArray[] = $items;
        }
        return $myArray;
    }
}
