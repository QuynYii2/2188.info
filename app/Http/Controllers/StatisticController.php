<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\StatisticAccess;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function getStatisticAccess()
    {
        $statisticAccess = StatisticAccess::orderBy('datetime', 'desc')->limit(7)->get();
        $numbers = null;
        $datetime = null;
        foreach ($statisticAccess as $access) {
            $numbers[] = $access->numbers;
            $datetime[] = $access->datetime;
        }
        $myArray[] = [$numbers, $datetime];
        return $myArray;
    }

    public function getStatisticRevenue()
    {
        $revenues = Revenue::orderBy('date', 'desc')->limit(7)->get();
        $numbers = null;
        $datetime = null;
        foreach ($revenues as $item) {
            $numbers[] = $item->revenue;
            $datetime[] = $item->date;
        }
        $myArray[] = [$numbers, $datetime];
        return $myArray;
    }

    public function getStatisticUser()
    {
        $userAll = User::all();
        $countUserAll = count($userAll);
        $buyers = User::where('type_account', 'buyer')->get();
        $supBuyers = User::where('type_account', 'personal')->get();
        $countBuyer = count($buyers) + count($supBuyers);
        $percentBuyer = $countBuyer / $countUserAll * 100;
        $percentBuyer = (integer)$percentBuyer;
        $percentSeller = 100 - $percentBuyer;
        return [$percentBuyer, $percentSeller];
    }
}
