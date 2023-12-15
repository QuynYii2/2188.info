<?php

namespace App\Http\Controllers;

use App\Enums\AttributeProductStatus;
use App\Enums\CartStatus;
use App\Enums\CategoryStatus;
use App\Enums\EvaluateProductStatus;
use App\Enums\ProductInterestedStatus;
use App\Enums\ProductStatus;
use App\Enums\PromotionStatus;
use App\Enums\VariationStatus;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\EvaluateProduct;
use App\Models\MemberRegisterInfo;
use App\Models\Product;
use App\Models\ProductInterested;
use App\Models\ProductSale;
use App\Models\ProductViewed;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Variation;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function getDataToModalAtt($id)
    {
        $productID = $id;
        $productList = DB::table('product_attribute')->where([
            ['product_id', $id],
            ['status', 'ACTIVE']
        ])->get();
        $myArray = null;
        $listAtt = null;
        if (!$productList->isEmpty()) {
            foreach ($productList as $item) {

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


        $testArray = $this->getArray($testArray);
        return view('frontend.pages.member.modal-att', compact('testArray', 'listAtt', 'productID'));
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

    public function detail_product(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $value = $this->findProduct(1, $id);

        if ($value == 404) {
            return back();
        }
        $listCart = null;
        if (Auth::check()) {
            $listCart = Cart::where('user_id', Auth::user()->id)->where('status', CartStatus::WAIT_ORDER)->get();
        }
        $currency = (new HomeController())->getLocation($request);

        $thisProduct = Product::find($id);
        $user_id = $thisProduct->user_id;

        $listReview = DB::table('evaluate_products')
            ->join('products', 'products.id', '=', 'evaluate_products.product_id')
            ->where('evaluate_products.status', EvaluateProductStatus::APPROVED)
            ->where('products.user_id', $user_id)
            ->select('evaluate_products.*')
            ->get();

        $totalReview = $listReview->count();
        $totalStar = 0;
        $calcStar = 0;
        foreach ($listReview as $item) {
            $totalStar = $totalStar + (int)$item->star_number;
        }
        if ($totalReview > 0) {
            $calcStar = $totalStar / $totalReview;
        }

        $fiveStar = EvaluateProduct::where('product_id', $id)->where('star_number', 5)->get();
        $fourStar = EvaluateProduct::where('product_id', $id)->where('star_number', 4)->get();
        $threeStar = EvaluateProduct::where('product_id', $id)->where('star_number', 3)->get();
        $twoStar = EvaluateProduct::where('product_id', $id)->where('star_number', 2)->get();

        $countFiveStar = $fiveStar->count();
        $countFourStar = $fourStar->count();
        $countThreeStar = $threeStar->count();
        $countTwoStar = $twoStar->count();

        $percentFiveStar = 0;
        $percentFourStar = 0;
        $percentThreeStar = 0;
        $percentTwoStar = 0;
        $percentOneStar = 0;
        if ($totalReview > 0) {
            $percentFiveStar = ($countFiveStar / $totalReview) * 100;
            $percentFourStar = ($countFourStar / $totalReview) * 100;
            $percentThreeStar = ($countThreeStar / $totalReview) * 100;
            $percentTwoStar = ($countTwoStar / $totalReview) * 100;
            $percentOneStar = 100 - $percentFiveStar - $percentFourStar - $percentThreeStar - $percentTwoStar;
        }

        $arrayStar = [$percentOneStar, $percentTwoStar, $percentThreeStar, $percentFourStar, $percentFiveStar];

        $products = Product::where('user_id', $user_id)->where('status', ProductStatus::ACTIVE)->get();

        $user = User::find($user_id);
        $company = MemberRegisterInfo::where('email', $user->email)->first();

        $arrayCode1 = [];
        $arrayCode2 = [];
        $arrayCode3 = [];
        if ($company) {
            $code1 = $company->code_1;
            if ($code1) {
                $arrayCode1 = explode(',', $code1);
            }
            $code2 = $company->code_2;
            if ($code2) {
                $arrayCode2 = explode(',', $code2);
            }
            $code3 = $company->code_3;
            if ($code3) {
                $arrayCode3 = explode(',', $code3);
            }
        }

        $categories1 = Category::whereIn('id', $arrayCode1)->where('status', CategoryStatus::ACTIVE)->get();
        $categories2 = Category::whereIn('id', $arrayCode2)->where('status', CategoryStatus::ACTIVE)->get();
        $categories3 = Category::whereIn('id', $arrayCode3)->where('status', CategoryStatus::ACTIVE)->get();

        $nameCategory = null;
        foreach ($categories1 as $item) {
            if ($nameCategory) {
                $nameCategory = $nameCategory . ',' . $item->name;
            } else {
                $nameCategory = $item->name;
            }
        }

        foreach ($categories2 as $item) {
            if ($nameCategory) {
                $nameCategory = $nameCategory . ',' . $item->name;
            } else {
                $nameCategory = $item->name;
            }
        }

        foreach ($categories3 as $item) {
            if ($nameCategory) {
                $nameCategory = $nameCategory . ',' . $item->name;
            } else {
                $nameCategory = $item->name;
            }
        }

        return view('frontend/pages/detail-product', $value)->with([
            'currency' => $currency,
            'listCart' => $listCart,
            'calcStar' => $calcStar,
            'products' => $products,
            'company' => $company,
            'arrayStar' => $arrayStar,
            'nameCategory' => $nameCategory,
        ]);
    }

    private function findProduct($key, $text)
    {
        if ($key === 1) {
            $product = Product::find($text);
        } else {
            $product = Product::where('slug', $text)->first();
        }

        if (!$product || $product->status != ProductStatus::ACTIVE) {
            return 404;
        }

        $product->views = $product->views + 1;
        $product->save();
        if (Auth::check()) {
            $result = EvaluateProduct::where([
                ['product_id', '=', $product->id],
                ['status', '=', EvaluateProductStatus::APPROVED]
            ])->orWhere([
                ['user_id', '=', Auth::user()->id],
                ['product_id', '=', $product->id]
            ])->get();
        } else {
            $result = EvaluateProduct::where([
                ['product_id', '=', $product->id],
                ['status', '=', EvaluateProductStatus::APPROVED]
            ])->get();
        }


        $product_att = DB::table('product_attribute')->where('product_id', '=', $text)->get();
        $listAtt = [];
        $listProperties = [];
        foreach ($product_att as $item) {
            $id = $item->attribute_id;
            $att = Attribute::where('id', $id)->first(['id', 'name', 'name_vi', 'name_zh', 'name_en', 'name_ja', 'name_ko',]);
            $listAtt[$id] = $att;
            $listProperties[$id] = explode(',', $item->value);
        }
        $otherProduct = Product::where('id', '!=', $product->id)
            ->limit(16)
            ->get();

        $related_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(16)
            ->get();

        $id_products = 0;
        if (Auth::check()) {
            $id_products = ProductViewed::where('user_id', Auth::user()->id)
                ->first();
        }

        $view_products = Product::whereIn('id', [$id_products])
            ->limit(16)
            ->get();

        $listProducts = Product::where('user_id', $product->user_id)
            ->where('id', '!=', $product->id)
            ->orderBy('id', 'desc')
            ->limit(16)
            ->get();

        $vouchers = Voucher::where([['status', VoucherStatus::ACTIVE], ['user_id', $product->user_id]])->get();
        $arrayVouchers = null;
        foreach ($vouchers as $voucher) {
            $listIds = $voucher->apply;
            $arrayID = explode(",", $listIds);
            for ($i = 0; $i < count($arrayID); $i++) {
                if ($arrayID[$i] == $product->id) {
                    $arrayVouchers[] = $voucher;
                }
            }
        }

        $promotions = Promotion::where([['status', PromotionStatus::ACTIVE], ['user_id', $product->user_id]])->get();
        $arrayPromotions = null;
        foreach ($promotions as $promotion) {
            $listIds = $promotion->apply;
            $arrayID = explode(",", $listIds);
            for ($i = 0; $i < count($arrayID); $i++) {
                if ($arrayID[$i] == $product->id) {
                    $arrayPromotions[] = $promotion;
                }
            }
        }
        $attributes = DB::table('product_attribute')->where([['product_id', $product->id], ['status', AttributeProductStatus::ACTIVE]])->get();
        $variables = Variation::where([['product_id', $product->id], ['status', VariationStatus::ACTIVE]])->get();

        return ['result' => $result,
            'product' => $product,
            'otherProduct' => $otherProduct,
            'attributes' => $attributes,
            'arrayVouchers' => $arrayVouchers,
            'arrayPromotions' => $arrayPromotions,
            'variables' => $variables,
            'listAtt' => $listAtt,
            'listProducts' => $listProducts,
            'listProperties' => $listProperties,
            'related_products' => $related_products,
            'view_products' => $view_products,
        ];
    }

    // Products by language

    public function orderProduct($id, Request $request)
    {
        (new HomeController())->getLocale($request);
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

        return view('frontend.pages.orderProductsDetail.order-products', compact('product', 'currency', 'testArray', 'listAtt'));
    }

    public function productViewed(Request $request)
    {
        try {
            $list = ProductViewed::where('user_id', Auth::user()->id)->first();
            if ($list && $list->productIds != null && $request->input('productIds') != null) {
//                $list->productIds = $request->input('productIds');
                $arrayIdsOld = explode(",", $list->productIds);
                $arrayIdsNew = explode(",", $request->input('productIds'));
                $listArray = array_unique(array_merge($arrayIdsOld, $arrayIdsNew), SORT_REGULAR);
                $list->productIds = implode(",", $listArray);;
                $list->save();
            } else {
                $item = [
                    'user_id' => Auth::user()->id,
                    'productIds' => $request->input('productIds'),
                ];
                $list = ProductViewed::create($item);
            }
            return $list;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function detailProduct($id)
    {
        $product = Product::find($id);
        $product->views = $product->views + 1;
        $product->save();
        return $product;
    }

    public function listProductsByLanguage(Request $request, $locale)
    {
        (new HomeController())->getLocale($request);
        $merge_products = null;
        $productInterested = ProductInterested::where([['user_id', Auth::user()->id], ['status', ProductInterestedStatus::ACTIVE]])->first();
        $arrayShopsIDs = null;
        $arrayCategoryIDs = null;
        if ($productInterested) {
            $listCategoryIDs = $productInterested->categories_id;
            $arrayCategoryIDs = explode(',', $listCategoryIDs);
            if ($arrayCategoryIDs != null) {
                foreach ($arrayCategoryIDs as $categoryID) {
                    $products = null;
                    $products = Product::where([
                        ['location', $locale],
                        ['category_id', $categoryID]
                    ])->get();
                    foreach ($products as $product) {
                        $arrayShopsIDs[] = $product->user_id;
                        $arrayShopsIDs = array_unique($arrayShopsIDs);
                    }
                    if (!$products->isEmpty()) {
                        $merge_products[] = $products;
                    }
                }
            }
        }
        $products = $merge_products;
        return view('frontend.pages.productsLanguage.products', compact(
            'products',
            'locale',
            'arrayCategoryIDs',
            'arrayShopsIDs',
        ));
    }

    public function findBySlug(Request $request, $slug)
    {
        (new HomeController())->getLocale($request);
        $value = $this->findProduct('123', $slug);
        return view('frontend/pages/detail-product', $value);
    }

    public function getVariable(Request $request, $id, $value)
    {
        $variable = Variation::where([
            ['product_id', $id],
            ['variation', $value],
            ['status', VariationStatus::ACTIVE]
        ])->first();
        if (!$variable) {
            return response('not found', 404);
        }
        return response($variable, 200);
    }

    public function getListProductShop(Request $request)
    {
        (new HomeController())->getLocale($request);
        $products = Product::where([
            ['user_id', Auth::user()->id],
            ['status', ProductStatus::ACTIVE]
        ])->orderBy('id', 'desc')->get();
        $currency = (new HomeController())->getLocation($request);
        return view('frontend.pages.profile.my-shop', compact('products', 'currency'));
    }

    public function getProductSale(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $price_sales = ProductSale::where('product_id', $id)->get();
        $currency = (new HomeController())->getLocation($request);
        return view('frontend/pages/member/product-sales', compact('price_sales', 'currency'));
    }

    public function getAllProduct(Request $request)
    {
        $products = Product::all();
        $currency = (new HomeController())->getLocation($request);
        return view('frontend.pages.member.product-load', compact('products', 'currency'));
    }
}
