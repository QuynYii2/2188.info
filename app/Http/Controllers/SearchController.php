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
        $id = $request->input('category_search');
        if ($id == 0) {
            $products = Product::where(function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_vi', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_ja', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_ko', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_zh', 'LIKE', '%' . $name . '%');
            })->where('status', ProductStatus::ACTIVE)->get();
        } else {
            $products = Product::where(function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_vi', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_ja', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_ko', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $name . '%')
                    ->orWhere('name_zh', 'LIKE', '%' . $name . '%');
            })->where('products.status', ProductStatus::ACTIVE)
                ->whereRaw("FIND_IN_SET(?, products.list_category)", [$id])->get();
        }
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
