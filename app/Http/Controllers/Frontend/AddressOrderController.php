<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\AddressOrder;
use App\Enums\AddressOrderStatus;
use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressOrderController extends Controller
{

    public function show(Request $request)
    {
        (new HomeController())->getLocale($request);
        $addresses = OrderAddress::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', AddressOrderStatus::ACTIVE]
        ])->get();
        return view('frontend/pages/profile/address-book')->with('addresses', $addresses);
    }

    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $addresses = OrderAddress::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', AddressOrderStatus::ACTIVE]
        ])->get();
        return view('frontend.pages.order-address.list', compact('addresses'));
    }

    public function processCreate(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend.pages.order-address.create');
    }


    public function store(Request $request)
    {
        $check = $request->input('default');
        if ($check == null) {
            $check = AddressOrder::ABSENCE;
        } else {
            $check = AddressOrder::DEFAULT;
            OrderAddress::where('user_id', Auth::user()->id)
                ->where('status', AddressOrderStatus::ACTIVE)
                ->where('default', AddressOrder::DEFAULT)
                ->update(['default' => AddressOrder::ABSENCE]);
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
        alert()->success('Success', 'Tạo mới địa chỉ thành công');
        return redirect(route('user.address.show'));
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
            OrderAddress::where('user_id', Auth::user()->id)
                ->where('id', '<>', $id)
                ->update(['default' => 0]);
        }

        $address->default = $check;

        $address->save();
        alert()->success('Success', 'Cập nhật địa chỉ thành công');
        return redirect(route('user.address.show'));
    }

    public function delete($id)
    {
        //
    }

    public function detail($id)
    {
        $address = OrderAddress::find($id);
        return response()->json($address);
    }
}
