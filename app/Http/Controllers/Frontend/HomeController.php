<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\CartStatus;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Libraries\GeoIP;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $locale = '';
        $currency = '';
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            app()->setLocale($request->session()->get('locale'));
        } else {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip('183.80.130.4');
            if ($locale !== null && is_array($locale)) {
                $locale = $locale['countryCode'];
            } else {
                $locale = 'vi';
            }
        }
        app()->setLocale($locale);

        $currencies = [
            'vi' => 'VND',
            'kr' => 'KRW',
            'cn' => 'CNY',
            'jp' => 'JPY',
        ];

        if (array_key_exists($locale, $currencies)) {
            $currency = $currencies[$locale];
        }

        $productByLocal = Product::where('location', $locale)->limit(10)->get();

        $categories = Category::get()->toTree();

        $locations = ['vi', 'kr', 'jp', 'cn'];

        $locations = array_diff($locations, [$locale]);

        $productByLocal = Product::whereIn('location', array_slice($locations, 0, 3))
            ->limit(10)
            ->get();

        $productByLocal5 = Product::all()->take(5);

        return view('frontend/index',[
            'productByLocal' => $productByLocal,
            'currency' => $currency,
            'countryCode' => $locale,
            'categories' => $categories
        ]);
    }


    public function shop()
    {
        return view('frontend/pages/product-list');
    }

    public function register(Request $request)
    {
        $this->getLocale($request);
        return view('frontend/pages/register');
    }

    public function getLocale(Request $request)
    {
        $locale = '';
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            app()->setLocale($request->session()->get('locale'));
        } else {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip('183.80.130.4');
            if ($locale !== null && is_array($locale)) {
                $locale = $locale['countryCode'];
            } else {
                $locale = 'vi';
            }
        }
        app()->setLocale($locale);
    }
}
