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
            $coin = Coin::where([['user_id', \Illuminate\Support\Facades\Auth::user()->id], ['status', CoinStatus::ACTIVE]])->first();
            $price = $request->input('moneyLocal');
            if ($coin != null) {
                if ($coin->quantity >= $price * 9) {
                    $config = new TopSellerConfig();
                    if ($request->hasFile('thumbnail')) {
                        $thumbnail = $request->file('thumbnail');
                        $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                        $config->thumbnail = $thumbnailPath;
                    }
                    $url = $request->input('url_tag');
                    $local = $request->input('local');
                    $config->url = $url;
                    $config->local = $local;
                    $config->user_id = Auth::user()->id;
                    $coin->quantity = $coin->quantity - $price * 9;
                    $coin->save();
                    $success = $config->save();
                    if ($success) {
                        alert()->success('Success', 'Create success!');
                        return redirect(route('seller.config.show'));
                    }
                    alert()->error('Error', 'Create error!');
                    return back();
                } else {
                    alert()->error('Error', 'Not enough coin!');
                    return back();
                }
            }
            alert()->error('Error', 'Please buy coin to continue!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
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
