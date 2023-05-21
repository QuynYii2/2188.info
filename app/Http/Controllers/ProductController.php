<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail_product() {
        return view('frontend/pages/detail-product');
    }
}
