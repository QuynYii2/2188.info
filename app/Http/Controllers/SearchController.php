<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByNameProducts(Request $request)
    {
        (new HomeController())->getLocale($request);
        $name = $request->input('key_search');
        $currency = (new HomeController())->getLocation($request);
        $products = Product::where([
            ['status', ProductStatus::ACTIVE],
            ['name', 'LIKE', '%' . $name . '%']
        ])->get();
        return view('frontend.pages.search-result', compact('products', 'currency'));
    }

    public function searchByCategory($id, Request $request)
    {
        $currency = (new HomeController())->getLocation($request);
        (new HomeController())->getLocale($request);
        if ($id == 0) {
            $products = Product::where('status', ProductStatus::ACTIVE)->get();
        } else {
            $products = Product::where('products.status', ProductStatus::ACTIVE)
                ->whereRaw("FIND_IN_SET(?, products.list_category)", [$id])->get();
        }
        return view('frontend.pages.search-result', compact('products', 'currency'));
    }
}
