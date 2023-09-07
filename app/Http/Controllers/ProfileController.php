<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\EvaluateProduct;
use App\Models\Product;
use App\Models\ProductViewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function info(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/info');
    }

    public function my_notification(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/my-notification');
    }

    public function order_management(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/order-management');
    }

    public function return_management(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/return-management');
    }

    public function address_book(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/address-book');
    }

    public function payment_information(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/payment-information');
    }

    public function product_evaluation(Request $request)
    {
        (new HomeController())->getLocale($request);
        $listEvaluate = EvaluateProduct::where('user_id', Auth::user()->id)->get();

        return view('frontend/pages/profile/product-evaluation', compact('listEvaluate'));
    }

    public function favorite_product(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/favorite-product');
    }

    public function product_viewed(Request $request)
    {
        (new HomeController())->getLocale($request);
        $listProductIDs = ProductViewed::where('user_id', Auth::user()->id)->first();
        $arrayProducts = null;
        if ($listProductIDs) {
            $productIds = $listProductIDs->productIds;
            if ($productIds != null) {
                $arrayIds = explode(",", $productIds);
                for ($i = 0; $i < count($arrayIds); $i++) {
                    if ($arrayIds[$i] != null) {
                        $product = Product::find($arrayIds[$i]);
                        $arrayProducts[] = $product;
                    }
                }
            }
        }
        return view('frontend/pages/profile/product-viewed', compact('arrayProducts'));
    }

    public function my_review(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/profile/my-review');
    }
}
