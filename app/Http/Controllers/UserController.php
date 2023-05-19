<?php

namespace App\Http\Controllers;

use App\Libraries\GeoIP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {

        $ipAddress = $request->ip();
        $geoIp = new GeoIP();
        $locale = $geoIp->get_country_from_ip('183.80.130.4');

        if ($request->type_account == 'seller') {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'rental_code' => 'required',
                'image' => 'required|image',
                'social_media' => 'required',
                'industry' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'password' => 'required|min:6',
            ]);
        } else {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'rental_code' => 'nullable',
                'image' => 'nullable|image',
                'social_media' => 'nullable',
                'industry' => 'nullable',
                'product_name' => 'nullable',
                'product_code' => 'nullable',
                'password' => 'required|min:6',
            ]);
        }

        // Lưu thông tin người dùng vào cơ sở dữ liệu
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->rental_code = $request->rental_code;
        $user->social_media = $request->social_media;
        $user->industry = $request->industry;
        $user->product_name = $request->product_name;
        $user->product_code = $request->product_code;
        $user->password = Hash::make($request->password);
        $user->type_account = $request->type_account;
        $user->region = $locale;

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $user->image = $imagePath;
        }

        $success = $user->save();

        Session::flash('success', 'Đăng ký thành công!');

        if ($success) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

    }

}
