<?php

namespace App\Http\Controllers\Seller;

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
    public function index()
    {
        $configs = TopSellerConfig::where('user_id', Auth::user()->id)->get();
        return view('backend.top-seller-config.list', compact('configs'));
    }

    public function processCreate()
    {
        $categories = Category::all();
        $reflector = new \ReflectionClass('App\Enums\TopSellerConfigLocation');
        $options = $reflector->getConstants();
        return view('backend.top-seller-config.create', compact('categories', 'options'));
    }

    public function create(Request $request)
    {
        try {
            $price = $request->input('moneyLocal');
            $name_custom = $request->input('name_custom');
            $config = new TopSellerConfig();
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                $config->thumbnail = $thumbnailPath;
            }
            $url = $request->input('url');
            $category = $request->input('category');
            $local = $request->input('local');
            $product = $request->input('product');
            if ($name_custom) {
                $config->name_custom = $name_custom;
            } elseif ($product) {
                $products = Product::find($product);
                $config->name_custom = $products->name;
                $config->thumbnail = $products->thumbnail;
            } elseif ($category) {
                $categorys = Category::find($category);
                $config->name_custom = $categorys->name;
                $config->thumbnail = $categorys->thumbnail;
            }

            if ($url) {
                $config->url = $url;
            } elseif ($product) {
                $products = Product::find($product);
                $config->url =  route('detail_product.show', $product->id);
                $config->thumbnail = $products->thumbnail;
            } elseif ($category) {
                $categorys = Category::find($category);
                $config->url =  route('category.show', $categorys->id);
                $config->thumbnail = $categorys->thumbnail;
            }
            if (!$category) {
                $category = 0;
            }
            if (!$product) {
                $product = 0;
            }
            $config->category = $category;
            $config->local = $local;
            $config->product = $product;
            $config->user_id = Auth::user()->id;
//            $coin->quantity = $coin->quantity - $price * 9;
//            $coin->save();
            $success = $config->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect(route('seller.config.show'));
            }
            alert()->error('Error', 'Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            dd($exception);
            return back();
        }
    }

    public function delete($id)
    {
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
