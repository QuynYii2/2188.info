<?php

namespace App\Http\Controllers;

use App\Enums\EvaluateProductStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\EvaluateProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail_product(Request $request, $id) {
        (new HomeController())->getLocale($request);
        $products = Product::find($id);
        $result = EvaluateProduct::where([
            ['product_id', '=', $products->id],
            ['status','=', EvaluateProductStatus::APPROVED]
        ])->get();
        return view('frontend/pages/detail-product', [
            'result' => $result
        ]);
    }
}
