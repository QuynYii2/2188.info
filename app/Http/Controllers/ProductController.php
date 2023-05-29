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
        $product = Product::find($id);
        if (Auth::check()) {
            $result = EvaluateProduct::where([
                ['product_id', '=', $product->id],
                ['status', '=', EvaluateProductStatus::APPROVED]
            ])->orWhere([
                ['user_id', '=', Auth::user()->id],
                ['product_id', '=', $product->id]
            ])->get();
        } else {
            $result = EvaluateProduct::where([
                ['product_id', '=', $product->id],
                ['status', '=', EvaluateProductStatus::APPROVED]
            ])->get();
        }

        $otherProduct = Product::where('id', '!=', $id)->limit(4)->get();

        return view('frontend/pages/detail-product', [
            'result' => $result,
            'product' => $product,
            'otherProduct' => $otherProduct
        ]);
    }
}
