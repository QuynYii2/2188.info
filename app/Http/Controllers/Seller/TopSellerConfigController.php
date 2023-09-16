<?php

namespace App\Http\Controllers\Seller;

use App\Enums\CategoryStatus;
use App\Enums\CoinStatus;
use App\Enums\OrderMethod;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PaypalPaymentController;
use App\Models\Category;
use App\Models\Coin;
use App\Models\Permission;
use App\Models\Product;
use App\Models\TopSellerConfig;
use Auth;
use DB;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class TopSellerConfigController extends Controller
{
    public function index(Request $request)
    {

        (new HomeController())->getLocale($request);
        $configs = TopSellerConfig::where('user_id', Auth::user()->id)->get();
        return view('backend.top-seller-config.list', compact('configs'));
    }

    public function processCreate()
    {
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        $reflector = new \ReflectionClass('App\Enums\TopSellerConfigLocation');
        $options = $reflector->getConstants();
        return view('backend.top-seller-config.create', compact('categories', 'options'));
    }

    public function create(Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $arrayProduct = $request->input('arrayProduct');
            $listProduct = implode(',', $arrayProduct);

            $config = new TopSellerConfig();

            $category = $request->input('category');
            $local = $request->input('local');

            if (!$category) {
                $category = 0;
            }
            // Lay ra prodcut dau tien trong mang
            $product = Product::find($arrayProduct[0]);

            $config->url = '#';
            $config->name_custom = '#';
            // gan thumbnail product vao day
            $config->thumbnail = $product->thumbnail;
            $config->category = $category;
            $config->local = $local;
            $config->product = $listProduct;
            $config->user_id = Auth::user()->id;

            $success = $config->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect(route('seller.config.show'));
            }
            alert()->error('Error', 'Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            return back();
        }
    }

    public function delete(Request $request,$id)
    {
        (new HomeController())->getLocale($request);
        try {
            TopSellerConfig::where('id', $id)->delete();
            alert()->success('Success', 'Delete success!');
            return redirect(route('seller.config.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            return back();
        }
    }
}
