<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\CartStatus;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $currency = (new \App\Http\Controllers\Frontend\HomeController())->getLocation($request);
            return back()->with('cartItems', $carts)->with('currency', $currency);
        } else {
            return view('frontend/pages/login');
        }
    }

    public function addToCart(Request $request, Product $product)
    {
        if (Auth::check()) {
            $productID = $product->id;
            $variable = $request->input('variable');
            $valid = false;

            $productDetail = Variation::where([
                ['product_id', $productID],
                ['variation', $variable]
            ])->first();

            $oldCarts = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['values', '=', $variable],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->get();

            foreach ($oldCarts as $oldCart) {
                if ($oldCart->product_id == $productID) {
                    $valid = true;
                    break;
                }
            }

            $price = $request->input('price');

            if ($valid == true) {
                $quantity = $request->input('quantity');
                $oldCart = Cart::where([
                    ['product_id', '=', $productID],
                    ['values', '=', $variable],
                    ['status', '=', CartStatus::WAIT_ORDER]
                ])->first();
                $cart = $oldCart;
                $cart->price = $price;
                $cart->quantity = $cart->quantity + $quantity;
                $success = $cart->save();
            } else {
                $quantity = $request->input('quantity', 1);// Số lượng mặc định là 1, có thể điều chỉnh tùy ý
                if ($quantity < 1) {
                    return back();
                }
                $cart = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id,
                    'price' => $price,
                    'quantity' => $quantity,
                    'values' => $variable,
                    'status' => CartStatus::WAIT_ORDER,
                ];
                $success = Cart::create($cart);
            }

            if ($success) {
                return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
            } else {
                return back();
            }
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

        $sales = null;

        $quantity = $request->input('quantity', 1);
        if ($cart != null || $cart->status == CartStatus::WAIT_ORDER) {
            $cart->quantity = $quantity;

            $productSales = ProductSale::where('product_id', $cart->product_id)->get();
            foreach ($productSales as $productSale) {
                $listQuantity = $productSale->quantity;
                $arrayQuantity = explode('-', $listQuantity);
                $compare = $arrayQuantity[0];
                if ($quantity >= $compare) {
                    $sales = $productSale;
                }
            }

            if ($sales) {
                $cart->price = $sales->sales;
            } else {
                $product = Product::find($cart->product_id);
                $cart->price = $product->price;
            }

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

    public function addToCartPromotion(Request $request, Product $product, $percent)
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
                $cart->price = $product->price - $product->price * $percent / 100;
                $cart->quantity = $cart->quantity + $quantity;
                $cart->save();
            } else {
                $quantity = $request->input('quantity', 1);
                if ($quantity < 1) {
                    return back();
                }
                $cart = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id,
                    'price' => $product->price - $product->price * $percent / 100,
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

    public function addToCartApi(Request $request, $product)
    {
        $productID = $product;
        $product = Product::find($productID);
        if (!$product) {
            return response('not found', 404);
        }
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

        $item = $request->input('value');

        if ($item) {
            $listProduct = explode(',', json_decode($request->input('value')));
            $listQuantity = explode(',', json_decode($request->input('quantity')));
        }
        if ($valid == true) {
            if ($item) {
                for ($i = 0; $i < sizeof($listProduct); $i++) {
                    $variation = Variation::find($listProduct[$i]);
                    $quantity = $listQuantity[$i];
                    $oldCart = Cart::where([
                        ['product_id', '=', $productID],
                        ['values', '=', $variation->variation],
                        ['status', '=', CartStatus::WAIT_ORDER]
                    ])->get();
                    if (sizeof($oldCart) == 0) {
                        $oldCart = Cart::where([
                            ['product_id', '=', $productID],
                            ['values', '=', $variation->variation],
                            ['status', '=', CartStatus::DELETED]
                        ])->get();
                        $cart = $oldCart[0];
                        $cart->price = $variation->price;
                        $cart->member = 1;
                        $cart->status = CartStatus::WAIT_ORDER;
                        $cart->quantity = $quantity;
                        $cart->save();
                    } else {
                        $cart = $oldCart[0];
                        $cart->price = $variation->price;
                        $cart->member = 1;
                        $cart->status = CartStatus::WAIT_ORDER;
                        $cart->quantity = $cart->quantity + $quantity;
                        $cart->save();
                    }
                }
            }
        } else {
            if ($item) {
                for ($j = 0; $j < sizeof($listProduct); $j++) {
                    $variation = Variation::find($listProduct[$j]);
                    $quantity = $listQuantity[$j];
                    if ($quantity < 1) {
                        return response('error', 400);
                    }
                    $cart = [
                        'user_id' => Auth::user()->id,
                        'product_id' => $product->id,
                        'price' => $variation->price,
                        'values' => $variation->variation,
                        'member' => 1,
                        'quantity' => $quantity,
                        'status' => CartStatus::WAIT_ORDER,
                    ];
                    Cart::create($cart);
                }
            }
        }
        return $cart;
    }

    public function getAllCarts()
    {
        $carts = Cart::where([
            ['user_id', Auth::user()->id],
            ['status', CartStatus::WAIT_ORDER]
        ])->get();
        return $carts;
    }
}
