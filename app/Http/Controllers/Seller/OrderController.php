<?php

namespace App\Http\Controllers\Seller;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $isAdmin = (new HomeController())->checkAdmin();
        if ($isAdmin) {
            $orders = Order::where('status', '!=', OrderStatus::DELETED)->get();
        } else {
            $orders = Order::where([
                ['user_id', Auth::user()->id],
                ['status', '!=', OrderStatus::DELETED]
            ])->get();
        }
        return view('backend.order.list', compact('orders'));
    }

    public function search(Request $request)
    {
        (new HomeController())->getLocale($request);
        $query = [];
        $fullName = $request->input('fullName');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        if ($fullName) {
            $str = ['fullname', 'like', '%' . $fullName . '%'];
            array_push($query, $str);
        }
        if ($phoneNumber) {
            $str = ['phone', 'like', '%' . $phoneNumber . '%'];
            array_push($query, $str);
        }
        if ($email) {
            $str = ['email', 'like', '%' . $email . '%'];
            array_push($query, $str);
        }
        if ($from_date) {
            $str = ['created_at', '>=', $from_date . ' 00:00:00'];
            array_push($query, $str);
        }
        if ($to_date) {
            $str = ['created_at', '<=', $to_date . ' 23:59:59'];
            array_push($query, $str);
        }

        $orders = Order::where($query)->get();
        return view('backend.order.list', compact('orders', 'fullName', 'phoneNumber', 'email', 'from_date', 'to_date' ));
    }

    public function detail(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('backend.order.detail', compact('order', 'orderItems'));
    }
}
