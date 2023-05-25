<?php

namespace App\Http\Controllers;

use App\Enums\EvaluateProductStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\EvaluateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function detail_product(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            $product = Product::find($id);
            $result = EvaluateProduct::where([
                ['product_id', '=', $product->id],
                ['status', '=', EvaluateProductStatus::APPROVED]
            ])->orWhere([
                ['user_id', '=', Auth::user()->id],
                ['product_id', '=', $product->id]
            ])->get();
            return view('frontend/pages/detail-product', [
                'result' => $result,
                'product' => $product
            ]);
        } else {
            return view('frontend/pages/login');
        }
    }
}
