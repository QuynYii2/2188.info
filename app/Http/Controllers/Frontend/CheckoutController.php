<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\CartStatus;
use App\Enums\EvaluateProductStatus;
use App\Enums\OrderItemStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            $number = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->count();
            $carts = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->get();
            $user = User::find(Auth::user()->id);
            return view('frontend/pages/checkout', compact('number', 'carts', 'user'));
        } else {
            return view('frontend/pages/login');
        }
    }

    public function store(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            $carts = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->get();
            $total = 0;

            foreach ($carts as $cart) {
                $total = $total + ($cart->price * $cart->quantity);
            }

            $order = [
                'user_id' => Auth::user()->id,
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'orders_method' => $request->input('order_method'),
                'total_price' => $total,
                'shipping_price' => 1,
                'discount_price' => 1,
                'total' => $total,
                'status' => OrderStatus::PROCESSING
            ];

           Order::create($order);

            $orders = Order::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', OrderStatus::PROCESSING]
            ])->get();

            $number = count($orders);

            foreach ($carts as $cart) {
                $item = [
                    'order_id' => $orders[$number-1]->id,
                    'product_id' => $cart->product->id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'status' => OrderItemStatus::ACTIVE
                ];
                OrderItem::create($item);
            }

            foreach ($carts as $cart) {
                $cart->status = CartStatus::ORDERED;
                $cart->save();
            }

            return redirect()->route('home');

        } else {
            return view('frontend/pages/login');
        }
    }
}
