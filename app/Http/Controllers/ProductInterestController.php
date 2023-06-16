<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Libraries\GeoIP;
use App\Models\ProductInterested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductInterestController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $geoIp = new GeoIP();
        $locale = $geoIp->get_country_from_ip('183.80.130.4');
        if ($locale !== null && is_array($locale)) {
            $locale = $locale['countryCode'];
        }
        $userProduct = ProductInterested::where('user_id', Auth::user()->id)->first();
        return view('frontend/pages/product-interest', compact('userProduct', 'locale'));
    }

    // product.interest.index

    public function delete($id)
    {
        $userProduct = ProductInterested::where('user_id', Auth::user()->id)->first();
        $listCategory = $userProduct->categories_id;
        $myArray = explode(',', $userProduct->categories_id);
        $newArray = null;
        for ($i = 0; $i < count($myArray); $i++) {
            if ($myArray[$i] != $id) {
                $newArray[] = $myArray[$i];
            }
        }
        $value = implode(",", $newArray);
//        dd($newArray);
        $userProduct->categories_id = $value;
        $userProduct->save();
        return redirect(route('product.interest.index'));
    }
}
