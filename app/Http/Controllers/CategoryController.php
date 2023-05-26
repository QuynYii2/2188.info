<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::get()->toTree();
        $productByLocal9 = Product::all()->take(9);
        return view('frontend.categories.index', compact('categories', 'productByLocal9'));
    }

    public function category(Request $request, $id) {
        (new HomeController())->getLocale($request);
        $categories = Category::get()->toTree();
        $productByLocal9 = Product::where('category_id', '=', $id)->get()->take(9);
        return view('frontend/pages/category', compact('categories', 'productByLocal9'));
    }
}
