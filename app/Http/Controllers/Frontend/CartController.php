<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\CartStatus;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            $carts = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->get();

            return view('frontend/pages/cart')->with('cartItems', $carts);
        } else {
            return view('frontend/pages/login');
        }
    }

    public function addToCart(Request $request, Product $product)
    {
        if (Auth::check()) {
            $productID = $product->id;
            $valid = false;

            $oldCarts = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->get();

            foreach ($oldCarts as $oldCart) {
                if ($oldCart->product_id == $productID) {
                    $valid = true;
                    break;
                }
            }

            if ($valid == true) {
                $quantity = $request->input('quantity');
                $oldCart = Cart::where([
                    ['product_id', '=', $productID],
                    ['status', '=', CartStatus::WAIT_ORDER]
                ])->get();
                $cart = $oldCart[0];
                $cart->quantity = $cart->quantity + $quantity;
                $cart->save();
            } else {
                $quantity = $request->input('quantity', 1);// Số lượng mặc định là 1, có thể điều chỉnh tùy ý
                $cart = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'status' => CartStatus::WAIT_ORDER,
                ];
                Cart::create($cart);
            }
            return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
        } else {
            (new HomeController())->getLocale($request);
            return view('frontend/pages/login');
        }

    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $quantity = $request->input('quantity', 1);
        if ($cart != null || $cart->status == CartStatus::WAIT_ORDER) {
            $cart->quantity = $quantity;
            $cart->save();
        }
        return redirect(route('cart.index'));
    }

    public function change(Request $request, $id)
    {
        $cart = Cart::find($id);
        $quantity = $request->input('quantity', 1);
        if ($cart != null || $cart->status == CartStatus::WAIT_ORDER) {
            $cart->quantity = $quantity;
            $cart->save();
        }

        return response()->json([
            'message' => 'Success',
            'cart' => $cart,
        ], 200);
    }

    public function delete($id)
    {
        $cart = Cart::find($id);
        if ($cart != null || $cart->status == CartStatus::WAIT_ORDER) {
            $cart->status = CartStatus::DELETED;
            $cart->save();
        }
        return redirect(route('cart.index'));
    }

    public function clearCart()
    {
        $carts = Cart::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', CartStatus::WAIT_ORDER]
        ])->get();
        foreach ($carts as $cart) {
            $cart->status = CartStatus::DELETED;
            $cart->save();
        }
        return redirect(route('cart.index'));
    }
}
