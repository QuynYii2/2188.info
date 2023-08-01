<?php

namespace App\Http\Controllers;

use App\Models\StatisticAccess;
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
}
