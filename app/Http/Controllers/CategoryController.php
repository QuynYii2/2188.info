<?php

namespace App\Http\Controllers;


use App\Enums\CategoryStatus;
use App\Enums\ProductStatus;
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
        $categories = Category::where('status', CategoryStatus::ACTIVE)->where('parent_id', null)->get();
        $category = Category::find($id);
        $childCategories = Category::where('parent_id', $id)->get();
        $listPayment = PaymentMethod::all();
        $listTransport = TransportMethod::all();
        $priceProductOfCategory = Product::selectRaw('MAX(price) AS maxPrice, MIN(price) AS minPrice')
            ->where('products.status', '=', ProductStatus::ACTIVE)
            ->whereRaw("FIND_IN_SET(?, products.list_category)", [$id])
            ->first();
        if ($priceProductOfCategory->maxPrice === null) {
            $priceProductOfCategory->maxPrice = 1000;
        }
        if ($priceProductOfCategory->minPrice === null) {
            $priceProductOfCategory->minPrice = 0;
        }
        $currency = (new HomeController())->getLocation($request);
        $listProduct = Product::whereRaw("FIND_IN_SET(?, list_category) > 0", [$id])
            ->where('status', ProductStatus::ACTIVE)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('frontend/pages/category',
            compact('categories', 'listProduct', 'listPayment', 'listTransport', 'priceProductOfCategory', 'category',
                'childCategories', 'currency'));
    }

    public function filterInCategory(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $sortArr = explode(' ', $request->data['sortBy']);
        $selectedPayments = $request->data['selectedPayments'];
        $selectedTransports = $request->data['selectedTransports'];
        $search_origin = $request->data['search_origin'];
        $minPrice = $request->data['minPrice'];
        $maxPrice = $request->data['maxPrice'];
        $isSale = $request->data['isSale'];

        $query = Product::select('products.*', 'users.payment_method', 'users.transport_method')->where([
            [
                'products.status',
                '=',
                ProductStatus::ACTIVE
            ]
        ])->whereRaw("FIND_IN_SET(?, products.list_category)", [$id])->join('users', 'products.user_id', '=',
            'users.id');

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

        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('products.price', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $query->where('products.price', '>=', $minPrice);
        } elseif ($maxPrice !== null) {
            $query->where('products.price', '<=', $maxPrice);
        }

        if ($isSale == 'true') {
            $query->whereNotNull('products.old_price');
        }

        $listProduct = $query->orderBy('products.' . $sortArr[0], $sortArr[1])->paginate($request->data['countPerPage']);

        return response()->json($this->renderDataToHTML($listProduct, $request));
    }

    public function renderDataToHTML($listProduct, $request)
    {
        (new HomeController())->getLocale($request);
        $str = '';
        $currency = (new HomeController())->getLocation($request);
        switch (locationHelper()) {
            case 'cn':
                $nameProduct = 'name_zh';
                break;
            case 'jp':
                $nameProduct = 'name_ja';
                break;
            case 'vi':
                $nameProduct = 'name_vi';
                break;
            case 'kr':
                $nameProduct = 'name_ko';
                break;
            default:
                $nameProduct = 'name_en';
                break;
        }

        foreach ($listProduct as $product) {
            $str .= '<div class="col-xl-2 col-md-3 col-6 section mb-4">
            <div class="item">
                <div class="item-img">
                    <img src="' . asset('storage/' . $product['thumbnail']) . '" alt="">
                    <div class="button-view">
                        <button>' . __('home.Quick view') . '</button>
                    </div>
                    <div class="text">
                        <div class="text-sale">
                            ' . __('home.sales') . '
                        </div>
                        <div class="text-new">
                            ' . __('home.new') . '
                        </div>
                    </div>
                </div>
                <div class="item-body">
                    <div class="card-title1">
                        <a href="' . route('detail_product.show', $product['id']) . '">' . $product[$nameProduct] . '</a>
                    </div>
                    <div class="card-price">
                        <div class="price-sale">
                            <strong>' . number_format(convertCurrency('USD', $currency, $product['price']), 0, ',',
                    '.') . $currency . '</strong>
                        </div>
                        <div class="price-cost">';
            if ($product['old_price'] != null) {
                $str .= '<strike>' . number_format(convertCurrency('USD', $currency, $product['old_price']), 0, ',',
                        '.') . $currency . '</strike>';
            }
            $str .= '</div>
                    </div>
                    <div class="card-bottom d-flex justify-content-between">
                        <div class="card-bottom--left">
                            <a href="' . route('detail_product.show', $product['id']) . '">' . __('home.Choose Options') . '</a>
                        </div>
                        <div class="card-bottom--right">
                            <i class="item-icon fa-regular fa-heart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        return $str;
    }
}
