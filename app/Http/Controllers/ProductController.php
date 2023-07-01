<?php

namespace App\Http\Controllers;

use App\Enums\AttributeProductStatus;
use App\Enums\EvaluateProductStatus;
use App\Enums\PromotionStatus;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\EvaluateProduct;
use App\Models\Product;
use App\Models\ProductViewed;
use App\Models\Promotion;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function detail_product(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $product = Product::find($id);
        $product->views = $product->views + 1;
        $product->save();
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

        $vouchers = Voucher::where([['status', VoucherStatus::ACTIVE], ['user_id', $product->user_id]])->get();
        $arrayVouchers = null;
        foreach ($vouchers as $voucher) {
            $listIds = $voucher->apply;
            $arrayID = explode(",", $listIds);
            for ($i = 0; $i < count($arrayID); $i++) {
                if ($arrayID[$i] == $product->id) {
                    $arrayVouchers[] = $voucher;
                }
            }
        }

        $promotions = Promotion::where([['status', PromotionStatus::ACTIVE], ['user_id', $product->user_id]])->get();
        $arrayPromotions = null;
        foreach ($promotions as $promotion) {
            $listIds = $promotion->apply;
            $arrayID = explode(",", $listIds);
            for ($i = 0; $i < count($arrayID); $i++) {
                if ($arrayID[$i] == $product->id) {
                    $arrayPromotions[] = $promotion;
                }
            }
        }

        $attributes = DB::table('product_attribute')->where([['product_id', $product->id], ['status', AttributeProductStatus::ACTIVE]])->get();

        return view('frontend/pages/detail-product', [
            'result' => $result,
            'product' => $product,
            'otherProduct' => $otherProduct,
            'attributes' => $attributes,
            'arrayVouchers' => $arrayVouchers,
            'arrayPromotions' => $arrayPromotions
        ]);
    }

    public function productViewed(Request $request)
    {
        try {
            $list = ProductViewed::where('user_id', Auth::user()->id)->first();
            if ($list && $list->productIds != null && $request->input('productIds') != null) {
//                $list->productIds = $request->input('productIds');
                $arrayIdsOld = explode(",", $list->productIds);
                $arrayIdsNew = explode(",", $request->input('productIds'));
                $listArray = array_unique(array_merge($arrayIdsOld, $arrayIdsNew), SORT_REGULAR);
                $list->productIds = implode(",", $listArray);;
                $list->save();
            } else {
                $item = [
                    'user_id' => Auth::user()->id,
                    'productIds' => $request->input('productIds'),
                ];
                $list = ProductViewed::create($item);
            }
            return $list;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function detailProduct($id)
    {
        $product = Product::find($id);
        $product->views = $product->views + 1;
        $product->save();
        return $product;
    }
}
