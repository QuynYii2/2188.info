<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\AddressOrder;
use App\Enums\AddressOrderStatus;
use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            $addresses = OrderAddress::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', AddressOrderStatus::ACTIVE]
            ])->get();

            return view('frontend/pages/profile/address-book')->with('addresses', $addresses);
        } else {
            return view('frontend/pages/login');
        }
    }


    public function store(Request $request)
    {
        if (Auth::check()) {
            $check = $request->input('default');
            if ($check == null){
                $check = AddressOrder::ABSENCE;
            }
            $address = [
                'user_id' => Auth::user()->id,
                'username' => $request->input('username'),
                'company' => $request->input('company'),
                'phone' => $request->input('phone'),
                'city' => $request->input('city'),
                'province' => $request->input('province'),
                'location' => $request->input('location'),
                'address_detail' => $request->input('address_detail'),
                'address_option' => $request->input('address_option'),
                'default' => $check,
                'status' => AddressOrderStatus::ACTIVE,
            ];
            OrderAddress::create($address);
            return redirect(route('address.show'));
        } else {
            (new HomeController())->getLocale($request);
            return view('frontend/pages/login');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $address = OrderAddress::findOrFail($id);
        $address->username = $request->input('username');
        $address->company = $request->input('company');
        $address->phone = $request->input('phone');
        $address->city = $request->input('city');
        $address->province = $request->input('province');
        $address->location = $request->input('location');
        $address->address_detail = $request->input('address_detail');
        $address->address_option = $request->input('address_option');

        if ($request->input('default') == null) {
            $check = 0;
        } else {
            $check = 1;
        }

        $address->default = $check;

        $address->save();
        return redirect(route('address.show'));

    }

    public function destroy($id)
    {
        $address = OrderAddress::findOrFail($id);
        $address->delete();

        return redirect(route('address.show'));

    }
}
