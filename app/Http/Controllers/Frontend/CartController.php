<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request, Product $product)
    {
    $quantity = $request->input('quantity', 1); // Số lượng mặc định là 1, có thể điều chỉnh tùy ý

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function index()
    {
        $items = Cart::getContent();
        $total = Cart::getTotal();

        return view('cart.index', compact('items', 'total'));
    }

    public function update(Request $request, Product $product)
    {
        Cart::update($product->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity,
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove(Product $product)
    {
        Cart::remove($product->id);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function clearCart()
    {
        Cart::clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

}
