<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\TransportMethod;
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
//        $listProduct = Product::whereIn('list_category',$id)->paginate(9);
        $listProduct = Product::whereRaw("FIND_IN_SET(?, list_category)", [$id])->paginate(9);
        $listPayment = PaymentMethod::all();
        $listTransport = TransportMethod::all();
        return view('frontend/pages/category', compact('categories', 'listProduct', 'listPayment', 'listTransport'));
    }

    public function filterInCategory(Request $request, $id) {
        $lastParam = $request->route('id');
        dd($lastParam)
        (new HomeController())->getLocale($request);
        $categories = Category::get()->toTree();
        $listProduct = Product::where('category_id', '=', $id)->paginate(9);
        $listPayment = PaymentMethod::all();
        $listTransport = TransportMethod::all();
        return view('frontend/pages/category', compact('categories', 'listProduct', 'listPayment', 'listTransport'));
    }
}
