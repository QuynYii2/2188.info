<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail_product(Request $request) {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/detail-product');
    }
}
