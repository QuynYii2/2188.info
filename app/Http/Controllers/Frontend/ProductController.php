<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Libraries\GeoIP;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
//    use CountryCodeTrait;
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

        $categories = Category::get()->toTree();

        $locations = ['vi', 'kr', 'jp', 'cn'];

        $locations = array_diff($locations, [$locale]);

        $productByLocal = Product::whereIn('location', array_slice($locations, 0, 3))
            ->limit(10)
            ->get();

        $productByLocal = Product::all();

        return view('frontend/pages/product', [
            'productByLocal' => $productByLocal,
            'currency' => $currency,
            'countryCode' => $locale,
            'categories' => $categories
        ]);
    }

    public function getListByViews(Request $request)
    {
        (new HomeController())->getLocale($request);
        $products = Product::where('status', ProductStatus::ACTIVE)->orderBy('views', 'DESC')->limit(9)->get();
        return view('frontend.pages.profile.my-review', compact('products'));
    }
}
