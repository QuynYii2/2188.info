<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\SetupMarketing;
use App\Models\TopSellerConfig;
use App\Models\TransportMethod;
use Illuminate\Http\Request;

class DetailMarketingController extends Controller
{
    public function index($id, Request $request)
    {
        $currency = (new HomeController())->getLocation($request);
        $listPayment = PaymentMethod::all();
        $listTransport = TransportMethod::all();
        $topSeller = TopSellerConfig::where('local', $id)->get();
        $arrayProduct = null;

        foreach ($topSeller as $item) {
            $listProduct = $item->product;
            $arrayProductItem = explode(',', $listProduct);
            foreach ($arrayProductItem as $value) {
                $arrayProduct[] = $value;
            }
        }
        $products = null;
        if ($arrayProduct) {
            $products = Product::whereIn('id', $arrayProduct)->get();
        }
        return view('frontend.pages.marketing-detail', compact('listPayment', 'listTransport', 'products', 'currency'));
    }


    public function delete($id, $product)
    {
        $topSeller = TopSellerConfig::where('local', $id)->get();

        foreach ($topSeller as $item) {
            $listProduct = $item->product;
            $arrayProductItem = explode(',', $listProduct);
            if (($key = array_search($product, $arrayProductItem)) !== false) {
                unset($arrayProductItem[$key]);
            }
            $listProduct = implode(',', $arrayProductItem);
            $item->product = $listProduct;
            $item->save();
        }

        alert()->success('Success', 'Delete thành công');
        return redirect(route('seller.config.show'));
    }
}
