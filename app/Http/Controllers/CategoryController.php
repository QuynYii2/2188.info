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

    public function category(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::get()->toTree();
//        $listProduct = Product::whereIn('list_category',$id)->paginate(9);
        $listProduct = Product::whereRaw("FIND_IN_SET(?, list_category)", [$id])->paginate(9);
        $listPayment = PaymentMethod::all();
        $listTransport = TransportMethod::all();
        return view('frontend/pages/category', compact('categories', 'listProduct', 'listPayment', 'listTransport'));
    }

    public function filterInCategory(Request $request, $id)
    {
        $sortArr = explode(' ', $request->data['sortBy']);
        $selectedPayments = $request->data['selectedPayments'];
        $selectedTransports = $request->data['selectedTransports'];
        $search_origin = $request->data['search_origin'];
        $minPrice = $request->data['minPrice'];
        $maxPrice = $request->data['maxPrice'];

        $query = Product::where('category_id', '=', $id)
            ->join('users', 'products.user_id', '=', 'users.id');

        $selectedPaymentsArray = [];
        foreach ($selectedPayments as $payment) {
            $selectedPaymentsArray = array_merge($selectedPaymentsArray, explode(',', $payment));
        }

        $selectedPaymentsArray = array_unique($selectedPaymentsArray);

        if ($search_origin) {
            $query->where('products.origin', 'LIKE', '%' . $search_origin . '%');
        }

        if (count($selectedPaymentsArray) > 1) {
            $query->where(function ($query) use ($selectedPaymentsArray) {
                foreach ($selectedPaymentsArray as $payment) {
                    $query->orWhere('users.payment_method', 'LIKE', '%' . $payment . '%');
                }
            });
        }

        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('products.price', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $query->where('products.price', '>=', $minPrice);
        } elseif ($maxPrice !== null) {
            $query->where('products.price', '<=', $maxPrice);
        }

        $selectedTransportsArray = [];
        foreach ($selectedTransports as $transport) {
            $selectedTransportsArray = array_merge($selectedTransportsArray, explode(',', $transport));
        }

        $selectedTransportsArray = array_unique($selectedTransportsArray);

        if (count($selectedTransportsArray) > 1) {
            $query->where(function ($query) use ($selectedTransportsArray) {
                foreach ($selectedTransportsArray as $transport) {
                    $query->orWhere('users.transport_method', 'LIKE', '%' . $transport . '%');
                }
            });
        }

        $listProduct = $query->orderBy('products.' . $sortArr[0], $sortArr[1])
            ->paginate($request->data['countPerPage']);

        return response()->json($listProduct);
    }
}
