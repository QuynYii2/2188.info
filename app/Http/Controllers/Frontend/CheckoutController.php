<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = Cart::getContent();
        $total = Cart::getTotal();

        return view('checkout.index', compact('items', 'total'));
    }
}
