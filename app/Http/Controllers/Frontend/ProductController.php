<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\AttributeProductStatus;
use App\Enums\CartStatus;
use App\Enums\ProductStatus;
use App\Enums\VariationStatus;
use App\Http\Controllers\Controller;
use App\Libraries\GeoIP;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
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

    public function getListByShops(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $products = Product::where('user_id', $id)->get();
        return view('frontend.pages.shopProducts.list-by-shop', compact('products'));
    }

    public function getListByCategoryAndShops(Request $request, $category, $shop)
    {
        (new HomeController())->getLocale($request);
        $products = Product::where([
            ['user_id', $shop],
            ['category_id', $category]
        ])->get();
        return view('frontend.pages.shopProducts.list-by-category', compact('products'));
    }

    public function detailProduct($id, Request $request)
    {
        $currency = (new HomeController())->getLocation($request);
        $product = Product::find($id);
        $productAttributes = DB::table('product_attribute')
            ->where('product_id', $id)
            ->where('status', AttributeProductStatus::ACTIVE)
            ->get();
        $myArray = null;
        $listAtt = null;
        if (!$productAttributes->isEmpty()) {
            foreach ($productAttributes as $item) {

                $id = $item->attribute_id;
                $att = Attribute::where('id', $id)->first(['id', 'name', 'name_vi', 'name_zh', 'name_en', 'name_ja', 'name_ko',]);
                $listAtt[$id] = $att;

                $attribute = $item->attribute_id;
                $properties = $item->value;
                $arrayProperty = explode(',', $properties);
                $array = null;
                $list = null;
                foreach ($arrayProperty as $property) {
                    $list = $list . '-' . $property;
                }
                $list = $attribute . $list;
                $myArray[] = $list;
            }
        }

        $testArray = null;
        if ($myArray) {
            foreach ($myArray as $myItem) {
                $key = explode("-", $myItem);
                $demoArray = null;
                for ($j = 1; $j < count($key); $j++) {
                    $demoArray[] = $key[0] . '-' . $key[$j];
                }
                $testArray[] = $demoArray;
            }
        }

        //detail_product.member.attribute
        $testArray = $this->getArray($testArray);

        return view('frontend.pages.member.member-table-order', compact('product', 'currency', 'testArray', 'listAtt'));
    }

    public function orderMemberProduct(Request $request, $product)
    {
        $productID = $product;

        $product = Product::find($productID);
        if (!$product) {
            return response('not found', 404);
        }

        $productInfo = $request->productInfo;

//        dd($productInfo);

        $valid = false;
        $oldCarts = Cart::where([
            ['user_id', '=', Auth::user()->id],
            ['product_id', '=', $productID],
            ['status', '=', CartStatus::WAIT_ORDER]
        ])->get();

        if ($productInfo) {
            $arrayProductInfo = explode('#', $productInfo);
            foreach ($arrayProductInfo as $productInfoItem) {
                $array_quantity_variable = explode('&', $productInfoItem);
                $quantity = $array_quantity_variable[0];
                $value = $array_quantity_variable[1];

                foreach ($oldCarts as $oldCart) {
                    if ($oldCart->values == $value) {
                        $valid = true;
                        break;
                    }
                }

                if ($valid == true) {
                    $variation = Variation::where('product_id', $productID)
                        ->where('variation', $value)
                        ->where('status', VariationStatus::ACTIVE)
                        ->first();

                    if ($variation) {
                        $price = $variation->price;
                    } else {
                        $price = $product->price;
                    }

                    $oldCart = Cart::where([
                        ['user_id', '=', Auth::user()->id],
                        ['product_id', '=', $productID],
                        ['values', '=', $value],
                        ['status', '=', CartStatus::WAIT_ORDER]
                    ])->first();

                    if ($oldCart) {
                        $oldCart->price = $price;
                        $total = (int)$oldCart->quantity + (int)$quantity;
                        $oldCart->quantity = $total;
                        $oldCart->save();
                    } else {
                        $cart = [
                            'user_id' => Auth::user()->id,
                            'product_id' => $product->id,
                            'price' => $price,
                            'values' => $value,
                            'member' => 1,
                            'quantity' => $quantity,
                            'status' => CartStatus::WAIT_ORDER,
                        ];
                        Cart::create($cart);
                    }

//                    if (!$variation) {
//                        $variation->quantity = $variation->quantity - $quantity;
//                        $variation->save();
//                    }
                } else {
                    $variation = Variation::where('product_id', $productID)
                        ->where('variation', $value)
                        ->where('status', VariationStatus::ACTIVE)
                        ->first();

                    if ($variation) {
                        $price = $variation->price;
                    } else {
                        $price = $product->price;
                    }

                    $cart = [
                        'user_id' => Auth::user()->id,
                        'product_id' => $product->id,
                        'price' => $price,
                        'values' => $value,
                        'member' => 1,
                        'quantity' => $quantity,
                        'status' => CartStatus::WAIT_ORDER,
                    ];
                    Cart::create($cart);

//                    if (!$variation) {
//                        $variation->quantity = $variation->quantity - $quantity;
//                        $variation->save();
//                    }
                }
            }
        }

        return redirect(route('checkout.show'));
    }

    private function mergeArray($array1, $array2)
    {
        $arrayList = [];
        for ($j = 0; $j < count($array1); $j++) {
            for ($z = 0; $z < count($array2); $z++) {
                $arrayList[] = $array1[$j] . "," . $array2[$z];
            }
        }
        return $arrayList;
    }

    private function getArray($array)
    {
        if ($array) {
            if (count($array) == 1) {
                return $array;
            }
            $newArray = $array[0];
            for ($i = 1; $i < count($array); $i++) {
                $newArray = $this->mergeArray($newArray, $array[$i]);
            }
            return $newArray;
        } else {
            return null;
        }
    }
}
