<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\TransportMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = User::where('id', Auth::user()->id)->first(['payment_method', 'transport_method']);
        $listPayment = PaymentMethod::all();
        $listTransport = TransportMethod::all();
        return view('backend/shop_setting/index', compact('listPayment', 'listTransport', 'list'));
    }

    public function profileShop()
    {
        $user = Auth::user();
        return view('backend/shop_profile/index', compact('user'));
    }

    public function saveProfileShop(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->region = $request->input('region');
        $user->rental_code = $request->input('rental_code');
        $user->product_name = $request->input('product_name');
        $user->product_code = $request->input('product_code');
        $user->industry = $request->input('industry');
        if ($request->hasFile('image')) {
            $gallery = $request->file('image');
            $galleryPath = $gallery->store('images', 'public');
            $user->image = $galleryPath;
        }

        $user->save();
        return view('backend/shop_profile/index', compact('user'));
    }

    public function savePaymentMethod(Request $request)
    {
        $user = Auth::user();
        $user->payment_method = implode(',', $request->input('payment_method'));
        $user->save();
        return $this->index();
    }

    public function saveTransportMethod(Request $request)
    {
        $user = Auth::user();
        $user->transport_method = implode(',', $request->input('transport_method'));
        $user->save();
        return $this->index();
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
