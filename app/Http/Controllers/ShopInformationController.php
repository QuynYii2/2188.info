<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShopInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function store(Request $request)
    {
        try {
            $shopinformation = new ShopInfo();

            $shopinformation->user_id = Auth::user()->id;
            $shopinformation->name = $request->input('name');
            $shopinformation->country = $request->input('region');
            $shopinformation->masothue = $request->input('masothue');
            $shopinformation->product_name = $request->input('product_name');
            $shopinformation->product_code = $request->input('product_code');
            $shopinformation->product_key = $request->input('product_key');
            $shopinformation->information = $request->input('information');
            $shopinformation->business_license = $request->input('business_license');

            $Shop = $shopinformation->save();
        } catch (\Exception $exception){
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
