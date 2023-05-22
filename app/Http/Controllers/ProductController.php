<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail_product(Request $request, $id) {
        (new HomeController())->getLocale($request);
        $product = Product::find($id);
        return view('frontend/pages/detail-product',[
            'product' => $product
        ]);
    }
}
