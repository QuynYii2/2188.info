<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\Revenue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RevenusController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $user = Auth::user()->id;
        $role_id = DB::table('role_user')->where('user_id', $user)->get();
        $isAdmin = false;
        foreach ($role_id as $item) {
            if ($item->role_id == 1) {
                $isAdmin = true;
            }
        }
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $sellerID = $request->input('seller');
        $locationID = $request->input('location');
        $arraySeller = null;
//        dd($startDate, $endDate, $sellerID, $locationID);
        if ($isAdmin) {
            $revenues = Revenue::all();
            foreach ($revenues as $revenue) {
                $arraySeller[] = $revenue->seller_id;
                $arraySeller = array_unique($arraySeller);
            }

            if ($sellerID == null && $endDate == null) {
                $endDate = Carbon::now()->addHours(7)->endOfDay();
                if ($startDate == null) {
                    $startDate = Carbon::now()->addDays(-30);
                }

                if ($locationID == null) {
                    $revenues = Revenue::where([
                        ['date', '>', $startDate],
                        ['date', '<', $endDate]
                    ])->get();
                } else {
                    $revenues = Revenue::where([
                        ['date', '>', $startDate],
                        ['date', '<', $endDate],
                        ['location', '=', $locationID],
                    ])->get();
                }
            } elseif ($sellerID == null && $endDate != null) {
                if ($startDate == null) {
                    $startDate = Carbon::now()->addDays(-30)->startOfDay();
                }
                $endDate = Carbon::parse($endDate);
                $endDate->endOfDay();
                $revenues = Revenue::where([['date', '>', $startDate], ['date', '<', $endDate]])->get();
            } elseif ($sellerID != null && $endDate == null) {
                if ($startDate == null) {
                    $startDate = Carbon::now()->addDays(-30)->startOfDay();
                }
                $endDate = Carbon::now()->addHours(7)->endOfDay();

                if ($locationID == null || $locationID == 'all') {
                    $revenues = Revenue::where([
                        ['seller_id', $sellerID],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate]
                    ])->get();
                } else {
                    $revenues = Revenue::where([
                        ['seller_id', $sellerID],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate],
                        ['location', '=', $locationID],
                    ])->get();
                }
            } else {
                if ($startDate == null) {
                    $startDate = Carbon::now()->addDays(-30)->startOfDay();
                }
                $endDate = Carbon::parse($endDate);
                $endDate->endOfDay();

                if ($locationID == null || $locationID == 'all') {
                    $revenues = Revenue::where([
                        ['seller_id', $sellerID],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate]
                    ])->get();
                } else {
                    $revenues = Revenue::where([
                        ['seller_id', $sellerID],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate],
                        ['location', '=', $locationID],
                    ])->get();
                }
            }
        } else {
            if ($endDate == null) {
                $endDate = Carbon::now()->addHours(7)->endOfDay();
                if ($startDate == null) {
                    $startDate = Carbon::now()->addDays(-30);
                }

                if ($locationID == null) {
                    $revenues = Revenue::where([
                        ['seller_id', $user],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate]
                    ])->get();
                } else {
                    $revenues = Revenue::where([
                        ['seller_id', $user],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate],
                        ['location', '=', $locationID],
                    ])->get();
                }
            } else {
                if ($startDate == null) {
                    $startDate = Carbon::now()->addDays(-30);
                }
                $endDate = Carbon::parse($endDate);
                $endDate->endOfDay();
                if ($locationID == null) {
                    $revenues = Revenue::where([
                        ['seller_id', $user],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate]
                    ])->get();
                } else {
                    $revenues = Revenue::where([
                        ['seller_id', $user],
                        ['date', '>', $startDate],
                        ['date', '<', $endDate],
                        ['location', '=', $locationID],
                    ])->get();
                }
            }
        }


        return view('backend.revenue.show-revenue', compact('revenues', 'arraySeller', 'isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
