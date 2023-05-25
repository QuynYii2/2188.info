<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $orderAll = Order::where([
            ['user_id', '=', Auth::user()->id],
        ])->get();

        $orderWaitPay = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::WAIT_PAYMENT]
        ])->get();

        $orderProcessing = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::PROCESSING]
        ])->get();

        $orderShipping = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::SHIPPING]
        ])->get();

        $orderDelivered = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::DELIVERED]
        ])->get();

        $orderCancel
            = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::CANCELED]
        ])->get();

        return view('frontend/pages/profile/order-management', compact(
            'orderAll',
            'orderWaitPay',
            'orderProcessing',
            'orderShipping',
            'orderDelivered',
            'orderCancel'
        ));
    }

    public function cancel(Request $request, $id){
        $order = Order::find($id);
        (new HomeController())->getLocale($request);
        if ($order != null){
            $order->status = OrderStatus::CANCELED;
            $order->save();
        }
        return redirect(route('order.show'));
    }
}
