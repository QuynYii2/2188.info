<?php

namespace App\Http\Controllers\Seller;

use App\Enums\AttributeProductStatus;
use App\Enums\AttributeStatus;
use App\Enums\CartStatus;
use App\Enums\CategoryStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\OrderStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\ProductStatus;
use App\Enums\PromotionStatus;
use App\Enums\RegisterMember;
use App\Enums\VariationStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\TranslateController;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Promotion;
use App\Models\StaffUsers;
use App\Models\StorageProduct;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::where('status', CategoryStatus::ACTIVE)->where('parent_id', null)->get();
        $isAdmin = (new HomeController())->checkAdmin();
        if ($isAdmin) {
            $products = Product::where('status', '!=', ProductStatus::DELETED)->orderByDesc('id')->paginate(10);
        } else {
            $check_ctv_shop = StaffUsers::where('user_id', Auth::user()->id)->first();
            if ($check_ctv_shop) {
                $products = Product::where([['user_id', $check_ctv_shop->parent_user_id], ['status', '!=', ProductStatus::DELETED]])->orderByDesc('id')->paginate(10);
            } else {
                $products = Product::where([['user_id', Auth::user()->id], ['status', '!=', ProductStatus::DELETED]])->orderByDesc('id')->paginate(10);
            }
        }
        $currency = (new HomeController())->getLocation($request);
        return view('backend/products/index', ['products' => $products, 'categories' => $categories, 'currency' => $currency]);
    }

    public function search(Request $request)
    {
        (new HomeController())->getLocale($request);
        $currency = (new HomeController())->getLocation($request);
        $query = Product::query();

        $fullName = $request->input('fullName');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        if ($fullName) {
            $query->whereHas('user', function ($userQuery) use ($fullName) {
                $userQuery->where('name', 'like', '%' . $fullName . '%');
            });
        }

        if ($phoneNumber) {
            $query->whereHas('user', function ($userQuery) use ($phoneNumber) {
                $userQuery->where('phone', 'like', '%' . $phoneNumber . '%');
            });
        }

        if ($email) {
            $query->whereHas('user', function ($userQuery) use ($email) {
                $userQuery->where('email', 'like', '%' . $email . '%');
            });
        }

        if ($from_date) {
            $query->where('created_at', '>=', $from_date . ' 00:00:00');
        }

        if ($to_date) {
            $query->where('created_at', '<=', $to_date . ' 23:59:59');
        }

        $products = $query->paginate(10);

        return view('backend.products.index', compact('currency', 'products', 'fullName', 'phoneNumber', 'email', 'from_date', 'to_date'));
    }


    public function home(Request $request)
    {
        (new HomeController())->getLocale($request);
        $productProcessings = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where([['products.user_id', '=', Auth::user()->id], ['orders.status', '=', OrderStatus::PROCESSING]])
            ->select('order_items.*')
            ->get();
        $productWaitPayments = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where([['products.user_id', '=', Auth::user()->id], ['orders.status', '=', OrderStatus::WAIT_PAYMENT]])
            ->select('order_items.*')
            ->get();
        $productShippings = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where([['products.user_id', '=', Auth::user()->id], ['orders.status', '=', OrderStatus::SHIPPING]])
            ->select('order_items.*')
            ->get();
        $productDelivereds = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where([['products.user_id', '=', Auth::user()->id], ['orders.status', '=', OrderStatus::DELIVERED]])
            ->select('order_items.*')
            ->get();
        $productCancels = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where([['products.user_id', '=', Auth::user()->id], ['orders.status', '=', OrderStatus::CANCELED]])
            ->select('order_items.*')
            ->get();
        $productPause = DB::table('products')
            ->join('storage_products', 'storage_products.id', '=', 'products.storage_id')
            ->where([['products.user_id', '=', Auth::user()->id], ['storage_products.quantity', '=', 0], ['storage_products.create_by', '=', Auth::user()->id]])
            ->select('products.*')
            ->get();
        $promotions = Promotion::where([['user_id', Auth::user()->id], ['status', PromotionStatus::INACTIVE]])->get();
        $productAll = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('created_at', 'desc')->get();
        return view('backend/products/home', compact(
            'productProcessings',
            'productWaitPayments',
            'productShippings',
            'productDelivereds',
            'productCancels',
            'productPause',
            'productAll',
            'promotions'));
    }

    public function toggleProduct(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $product = Product::find($id);
        if ($product->status == ProductStatus::ACTIVE) {
            $product->status = ProductStatus::INACTIVE;
        } else {
            $product->status = ProductStatus::ACTIVE;
        }
        $product->save();
        return $product;
    }

    public function getProductsViews(Request $request)
    {
        (new HomeController())->getLocale($request);
        $user = Auth::user()->id;
        $role_id = DB::table('role_user')->where('user_id', $user)->get();
        $isAdmin = false;
        foreach ($role_id as $item) {
            if ($item->role_id == 1) {
                $isAdmin = true;
            }
        }
        $views = $request->input('views');
        $sellerID = $request->input('user_seller');
        $listUserId = null;
        if ($isAdmin) {
            $products = Product::where('status', '!=', ProductStatus::DELETED)->paginate(10);
            foreach ($products as $product) {
                $listUserId[] = $product->user_id;
                $listUserId = array_unique($listUserId);
            }
            if ($sellerID == null && $views == null) {
                $products = Product::where('status', '!=', ProductStatus::DELETED)->paginate(10);
            } elseif ($sellerID == null && $views != null) {
                if ($views == 'asc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'ASC')->paginate(10);
                } elseif ($views == 'desc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'DESC')->paginate(10);
                } else {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->paginate(10);
                }
            } elseif ($sellerID != null && $views == null) {
                if ($sellerID == '0') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->paginate(10);
                } else {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->paginate(10);
                }
            } elseif ($sellerID != null && $views != null) {
                if ($sellerID == '0' && $views == 'asc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'ASC')->paginate(10);
                } elseif ($sellerID == '0' && $views == 'desc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'DESC')->paginate(10);
                } elseif ($sellerID != '0' && $views == 'asc') {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->orderBy('views', 'ASC')->paginate(10);
                } elseif ($sellerID != '0' && $views == 'desc') {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->orderBy('views', 'DESC')->paginate(10);
                } else {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->paginate(10);
                }
            }
        } else {
            if ($views == 'asc') {
                $products = Product::where([['user_id', $user], ['status', '!=', ProductStatus::DELETED]])->orderBy('views', 'ASC')->paginate(10);
            } elseif ($views == 'desc') {
                $products = Product::where([['user_id', $user], ['status', '!=', ProductStatus::DELETED]])->orderBy('views', 'DESC')->paginate(10);
            } elseif ($views == 'no' || $views == null) {
                $products = Product::where([['user_id', $user], ['status', '!=', ProductStatus::DELETED]])->paginate(10);
            }
        }
        return view('backend/products/views', compact('products', 'isAdmin', 'listUserId'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $product = Product::findOrFail($id);
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', \Illuminate\Support\Facades\Auth::user()->id]])->get();
        $att_of_product = DB::table('product_attribute')->where('product_id', $product->id)->get();
        $productDetails = Variation::where([['product_id', $id], ['status', VariationStatus::ACTIVE]])->get();
        $price_sales = ProductSale::where('product_id', $id)->get();
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        $registerCate = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $registerCategories = MemberRegisterInfo::where('id', $registerCate->member_id)->first();
        $categoriesRegister = explode(',', $registerCategories->category_id);

        session()->forget('att_of_product');
        session()->push('att_of_product', $att_of_product);

        return view('backend.products.edit', compact(
            'categories',
            'att_of_product',
            'attributes',
            'price_sales',
            'product',
            'productDetails',
            'categoriesRegister'));

    }

    public function destroy(Product $product)
    {
        try {
            $product->status = ProductStatus::DELETED;
            $success = $product->save();
            if ($success) {
                alert()->success('Success', 'Product đã được xóa thành công!');
                return redirect()->route('seller.products.index');
            }
            alert()->error('Error', 'Không thể xoá sản phẩm!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error please try again!');
            return back();
        }
    }

    public function setHotProduct($id)
    {
        $user = User::find(Auth::id());
        $hasPermission = $user->permissions()->wherePivot('permission_id', 9)->where('status', PermissionUserStatus::ACTIVE)->get();
        if ($hasPermission->isNotEmpty() || checkAdmin()) {
            try {
                $product = Product::find($id);
                if ($product->hot == 1) {
                    $product->hot = 0;
                } else {
                    $product->hot = 1;
                }
                $product->save();
                return $product;
            } catch (\Exception $exception) {
                return $exception;
            }
        } else {
            return false;
        }
    }

    public function setFeatureProduct($id)
    {
        $user = User::find(Auth::id());
        $hasPermission = $user->permissions()->wherePivot('permission_id', 10)->where('status', PermissionUserStatus::ACTIVE)->get();
        if ($hasPermission->isNotEmpty() || checkAdmin()) {
            try {
                $product = Product::find($id);
                if ($product->feature == 1) {
                    $product->feature = 0;
                } else {
                    $product->feature = 1;
                }
                $product->save();
                return $product;
            } catch (\Exception $exception) {
                return $exception;
            }
        } else {
            return false;
        }
    }

    public function saveAttribute(Request $request)
    {
        try {
            $newArray = $this->getAttributeProperty($request);

            $testArray = null;
            if ($newArray) {
                foreach ($newArray as $myItem) {
                    $key = explode("-", $myItem);
                    $demoArray = null;
                    for ($j = 1; $j < count($key); $j++) {
                        $demoArray[] = $key[0] . '-' . $key[$j];
                    }
                    $testArray[] = $demoArray;
                }
            }
            $testArray = $this->getArray($testArray);
            session()->forget(['testArray', 'sourceArray']);
            session()->push('sourceArray', $newArray);
            session()->push('testArray', $testArray);
            if (!$testArray || !$newArray) {
                return view('backend.products.attribute-property.table-none-attribute');
            }
            return view('backend.products.attribute-property.table-attribute');
        } catch (Exception $exception) {
            return response($exception, 400);
        }
    }

    private function getAttributeProperty(Request $request)
    {
        (new HomeController())->getLocale($request);
        $proAtt = $request->input('attribute_property');

        if ($proAtt === null) {
            return null;
        }

        $newArray = [];

        $elements = explode(',', $proAtt);

        foreach ($elements as $element) {
            $parts = explode('-', $element);
            $prefix = $parts[0];
            $value = $parts[1];

            if (!isset($newArray[$prefix])) {
                $newArray[$prefix] = $prefix . '-' . $value;
            } else {

                $newArray[$prefix] .= '-' . $value;
            }
        }

        $newArray = array_values($newArray);

        return $newArray;
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

    public function removeVariation($id)
    {
        try {
            $variable = Variation::where('id', $id)->first();
            if ($variable) {
                $carts = Cart::where('product_id', $variable->product_id)->where('values', $variable->variation)->get();
                foreach ($carts as $cart) {
                    $cart->status = CartStatus::DELETED;
                    $cart->save();
                }
                $variable->status = VariationStatus::DELETED;

                $moreVariable = Variation::where('product_id', $variable->product_id)
                    ->where('id', '!=', $id)
                    ->where('status', VariationStatus::ACTIVE)
                    ->first();

                if ($moreVariable) {
                    $item = $variable->variation;
                    $arrayItems = explode(',', $item);
                    foreach ($arrayItems as $value) {
                        $arrayValue = explode('-', $value);
                        $product_attribute = DB::table('product_attribute')
                            ->where('product_id', $variable->product_id)
                            ->where('attribute_id', $arrayValue[0])
                            ->first();

                        if ($product_attribute) {
                            if (count($arrayItems) == 1) {
                                DB::table('product_attribute')
                                    ->where('product_id', $variable->product_id)
                                    ->where('attribute_id', $arrayValue[0])
                                    ->delete();
                            } else {
                                $property = $product_attribute->value;
                                $arrayProperty = explode(',', $property);
                                if (count($arrayProperty) > 1) {
                                    $key = array_search($arrayValue[1], $arrayProperty);
                                    if ($key !== false) {
                                        unset($arrayProperty[$key]);
                                    }
                                }
                                DB::table('product_attribute')
                                    ->where('product_id', $variable->product_id)
                                    ->where('attribute_id', $arrayValue[0])
                                    ->update(['value' => implode(',', $arrayProperty)]);
                            }
                        }
                    }
                } else {
                    DB::table('product_attribute')->where('product_id', $variable->product_id)->delete();
                }
                $success = $variable->save();
                if ($success) {
                    alert()->success('Success', 'Variable đã được xóa thành công!');
                    return back();
                }
            }

            alert()->error('Error', 'Không thể xoá variable!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error please try again!');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        try {
            $product = Product::findOrFail($id);

            $nameValue = $request->input('name');
            $descriptionValue = $request->input('description');
            $shortDescriptionValue = $request->input('short_description');
            $product->category_id = $request->input('category_id');

            $arrGallery = $request->input('imgGallery');

            if ($request->hasFile('imgThumbnail')) {
                $thumbnail = $request->file('imgThumbnail');
                $thumbnailPath = $thumbnail->store('product', 'public');
                $product->thumbnail = $thumbnailPath;
            }

            if (is_array($arrGallery)) {
                if ($request->hasFile('imgGallery')) {
                    $galleryPaths = array_map(function ($image) {
                        return $image->store('gallery', 'public');
                    }, $request->file('imgGallery'));
                    $product->gallery = implode(',', $galleryPaths);
                }
            }

            $number = $request->input('count');
            $isNew = $request->input('attribute_property');

            ProductSale::where('product_id', '=', $product->id)->delete();

            $product->description = $descriptionValue ?? $product->description;
            $product->short_description = $shortDescriptionValue;

            $product->name = $nameValue;
            $product->slug = \Str::slug($request->input('name'));

            $product->old_price = $request->input('giaban');

            if ($request->input('giakhuyenmai')) {
                $product->price = $request->input('giakhuyenmai');
            } else {
                $product->price = $request->input('giaban');
            }

            $product->qty = $request->input('qty');


            $product->origin = $request->input('origin');
            $product->min = $request->input('min');

            $ld = new TranslateController();

            $product->name_vi = $ld->translateText($nameValue, 'vi');
            $product->name_ja = $ld->translateText($nameValue, 'ja');
            $product->name_ko = $ld->translateText($nameValue, 'ko');
            $product->name_en = $ld->translateText($nameValue, 'en');
            $product->name_zh = $ld->translateText($nameValue, 'zh-CN');

            $product->description_vi = $ld->translateText($descriptionValue, 'vi');
            $product->description_ja = $ld->translateText($descriptionValue, 'ja');
            $product->description_ko = $ld->translateText($descriptionValue, 'ko');
            $product->description_en = $ld->translateText($descriptionValue, 'en');
            $product->description_zh = $ld->translateText($descriptionValue, 'zh-CN');

            $product->short_description_vi = $ld->translateText($shortDescriptionValue, 'vi');
            $product->short_description_ja = $ld->translateText($shortDescriptionValue, 'ja');
            $product->short_description_ko = $ld->translateText($shortDescriptionValue, 'ko');
            $product->short_description_en = $ld->translateText($shortDescriptionValue, 'en');
            $product->short_description_zh = $ld->translateText($shortDescriptionValue, 'zh-CN');


            $hot = $request->input('hot_product');
            $feature = $request->input('feature_product');

            if ($hot) {
                $product->hot = 1;
            } else {
                $product->hot = 0;
            }

            if ($feature) {
                $product->feature = 1;
            } else {
                $product->feature = 0;
            }

            $starts = $request->input('starts');
            if ($starts) {
                $ends = $request->input('ends');

                $sales = $request->input('sales');
                $days = $request->input('days');

                $ships = $request->input('ships');

                $counts = count($starts);
                for ($i = 0; $i < $counts; $i++) {
                    $newProductSale = null;
                    if (!$starts[$i]) {
                        $starts[$i] = $product->min;
                    }
                    if (!$ends[$i]) {
                        $quantity = $starts[$i];
                    } else {
                        $quantity = $starts[$i] . '-' . $ends[$i];
                    }
                    $newProductSale = [
                        'user_id' => $product->user_id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'sales' => $sales[$i],
                        'days' => $days[$i],
                        'ship' => $ships[$i],
                    ];
                    ProductSale::create($newProductSale);
                }
            }

            if ($isNew) {
                $newArray = $this->getAttributeProperty($request);

                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                    $product->thumbnail = $thumbnailPath;
                }

                $arrayProduct = [];
                if ($number) {
                    for ($i = 1; $i < $number + 1; $i++) {
                        $newVariationData = [];

                        if ($request->hasFile('thumbnail' . $i)) {
                            $thumbnail = $request->file('thumbnail' . $i);
                            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                            $newVariationData['thumbnail'] = $thumbnailPath;
                        }

                        $newVariationData['price'] = $request->input('price' . $i);
                        $newVariationData['old_price'] = $request->input('old_price' . $i);
                        $attPro = $request->input('attribute_property' . $i);
                        $newVariationData['variation'] = $attPro;

                        $newVariationData['product_id'] = $product->id;
                        $newVariationData['user_id'] = Auth::user()->id;
                        $newVariationData['status'] = VariationStatus::ACTIVE;
                        $newVariationData['description'] = $request->input('description' . $i);
                        $newVariationData['quantity'] = $request->input('quantity' . $i);

                        if (!$request->input('price' . $i) || $request->input('old_price' . $i) < $request->input('price' . $i)) {
                            $newVariationData['price'] = $request->input('old_price' . $i);
                        }

                        $oldVariable = Variation::where('product_id', $product->id)
                            ->where('variation', $attPro)
                            ->where('status', VariationStatus::ACTIVE)
                            ->first();
                        if ($oldVariable) {
                            $oldVariable->thumbnail = $newVariationData['thumbnail'];
                            $oldVariable->price = $newVariationData['price'];
                            $oldVariable->old_price = $newVariationData['old_price'];
                            $oldVariable->description = $newVariationData['description'];
                            $oldVariable->quantity = $newVariationData['quantity'];
                            $oldVariable->save();
                        } else {
                            $arrayProduct[] = $newVariationData;
                        }
                    }
                    Variation::insert($arrayProduct);
                    $this->createAttributeProduct($product, $newArray);
                }
                $updateProduct = $product->save();
            }
            $updateProduct = $this->updateProduct($product, $request, $number);

            if ($updateProduct) {
                alert()->success('Success', 'Cập nhật thành công.');
                return redirect()->route('seller.products.index');
            } else {
                alert()->error('Error', 'Cập nhật không thành công.');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again');
            return back();
        }
    }

    public function handleGallery($input)
    {
        $pattern = '/\/storage\/([^,"]+),?/';
        $matches = array();
        $arrResult = array();
        foreach ($input as $item) {
            preg_match_all($pattern, $item, $matches);
            array_push($arrResult, $matches[1]);
        }
        return implode(',', $arrResult[0]);
    }

    public function create(Request $request)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::where('parent_id', null)
            ->where('status', CategoryStatus::ACTIVE)
            ->get();
        $registerCate = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        $registerCategories = MemberRegisterInfo::where('id', $registerCate->member_id)->first();
        $categoriesRegister = [];
        $arrayCategory = explode(',', $registerCategories->category_id);
//        foreach ($arrayCategory as $registerCategor) {
//            array_push($categoriesRegister, $registerCategor);
//        }

        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();

        $id = Auth::user()->id;
        $roles = DB::table('role_user')->where('user_id', $id)->get('role_id');
        $storages = StorageProduct::where('create_by', Auth::user()->id)->orderByDesc('id')->get();
        foreach ($roles as $role) {
            if ($role->role_id == 1) {
                $storages = StorageProduct::all();
                break;
            }
        }
        session()->forget('att_of_product');

        return view('backend/products/create', [
            'categories' => $categories,
            'attributes' => $attributes,
            'storages' => $storages,
            'categoriesRegister' => $arrayCategory,
        ]);
    }

    public function store(Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $maxProduct = Product::where([
                ['user_id', Auth::user()->id],
                ['status', '!=', ProductStatus::DELETED]
            ])->get();
            $countProduct = count($maxProduct);

            $memberUser = DB::table('member_register_infos')
                ->join('member_register_person_sources', 'member_register_infos.id', '=', 'member_register_person_sources.member_id')
                ->where([['member_register_person_sources.email', '=', Auth::user()->email], ['member_register_infos.status', '=', MemberRegisterInfoStatus::ACTIVE]])
                ->select('member_register_infos.*')
                ->get();

            $notMember = false;
            if ($memberUser->isNotEmpty()) {
                foreach ($memberUser as $memberItem) {
                    if ($memberItem->member == RegisterMember::LOGISTIC || $memberItem->member == RegisterMember::BUYER || $memberItem->member == RegisterMember::TRUST) {
                        $notMember = true;
                    }
                }
            }

            $isAdmin = (new HomeController())->checkAdmin();
            if ($isAdmin == true) {
                $notMember = false;
            }

            if ($notMember == true) {
                if ($countProduct > 8) {
                    alert()->error('Error', 'Bạn đã tạo quá số lượng sản phẩm quy định! Vui lòng loại bớt sản phẩm hoặc nâng cấp nên gói tài khoản cao cấp hơn');
                    return back();
                }
            }

            $nameValue = $request->input('name');
            $descriptionValue = $request->input('description');
            $shortDescriptionValue = $request->input('short_description');

            $product = new Product();
            $qty_in_storage = DB::table('storage_products')->where('id', $request->input('storage-id'))->value('quantity');

            if ($request->hasFile('imgThumbnail')) {
                $thumbnail = $request->file('imgThumbnail');
                $thumbnailPath = $thumbnail->store('product', 'public');
                $product->thumbnail = $thumbnailPath;
            }

            if ($request->hasFile('imgGallery')) {
                $galleryPaths = array_map(function ($image) {
                    return $image->store('gallery', 'public');
                }, $request->file('imgGallery'));
                $product->gallery = implode(',', $galleryPaths);
            }

            $product->storage_id = $request->input('storage-id');
            $product->name = $nameValue;
            $product->description = $descriptionValue;
            $product->short_description = $shortDescriptionValue;
            $product->product_code = $request->input('product_code');
            $product->qty = $request->input('qty');;
            $product->category_id = $request->input('category_id');
            $product->user_id = Auth::user()->id;
            $product->location = Auth::user()->region;
            $product->slug = \Str::slug($request->input('name'));
            $product->old_price = $request->input('giaban');
            $product->origin = $request->input('origin');

            $ld = new TranslateController();

            $product->name_vi = $ld->translateText($nameValue, 'vi');
            $product->name_ja = $ld->translateText($nameValue, 'ja');
            $product->name_ko = $ld->translateText($nameValue, 'ko');
            $product->name_en = $ld->translateText($nameValue, 'en');
            $product->name_zh = $ld->translateText($nameValue, 'zh-CN');

            $product->description_vi = $ld->translateText($descriptionValue, 'vi');
            $product->description_ja = $ld->translateText($descriptionValue, 'ja');
            $product->description_ko = $ld->translateText($descriptionValue, 'ko');
            $product->description_en = $ld->translateText($descriptionValue, 'en');
            $product->description_zh = $ld->translateText($descriptionValue, 'zh-CN');

            $product->short_description_vi = $ld->translateText($shortDescriptionValue, 'vi');
            $product->short_description_ja = $ld->translateText($shortDescriptionValue, 'ja');
            $product->short_description_ko = $ld->translateText($shortDescriptionValue, 'ko');
            $product->short_description_en = $ld->translateText($shortDescriptionValue, 'en');
            $product->short_description_zh = $ld->translateText($shortDescriptionValue, 'zh-CN');


            if ($request->input('giakhuyenmai')) {
                $product->price = $request->input('giakhuyenmai');
            } else {
                $product->price = $request->input('giaban');
            }

            if ($request->input('min')) {
                $product->min = $request->input('min');
            } else {
                $product->min = 10;
            }


            $hot = $request->input('hot_product');
            $feature = $request->input('feature_product');

            if ($hot) {
                $product->hot = 1;
            } else {
                $product->hot = 0;
            }

            if ($feature) {
                $product->feature = 1;
            } else {
                $product->feature = 0;
            }
            $count = $request->input('count');

            $createProduct = $this->createProduct($product, $request, $count);
            if ($createProduct) {
                alert()->success('Success', 'Tạo mới sản phẩm thành công.');
                return redirect()->route('seller.products.index');
            } else {
                alert()->error('Error', 'Tạo mới sản phẩm không thành công.');
                return back();
            }
        } catch (\Exception $exception) {
            dd($exception);
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    private function createProduct($product, $request, $number)
    {
        $arrayIDs = $this->getCategory($request);
        if (!$arrayIDs || count($arrayIDs) == 0) {
            $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
            $category = $categories[0];
            $arrayIDs[] = $category->id;
        }
        $listIDs = implode(',', $arrayIDs);
        $product->category_id = $arrayIDs[0];
        $newProductData = [
            'storage_id' => $product->storage_id,
            'name' => $product->name,
            'description' => $product->description,
            'short_description' => $product->short_description,
            'product_code' => $product->product_code,
            'qty' => $product->qty,
            'category_id' => $product->category_id,
            'user_id' => Auth::user()->id,
            'location' => Auth::user()->region,
            'feature' => $product->feature,
            'hot' => $product->hot,
            'slug' => $product->slug,
            'price' => $product->price,
            'old_price' => $product->old_price,
            'gallery' => $product->gallery,
            'thumbnail' => $product->thumbnail,
            'list_category' => $listIDs,
            'min' => $product->min,
            'origin' => $product->origin,
            'status' => ProductStatus::INACTIVE,

            'name_vi' => $product->name_vi,
            'name_ja' => $product->name_ja,
            'name_ko' => $product->name_ko,
            'name_en' => $product->name_en,
            'name_zh' => $product->name_zh,

            'description_vi' => $product->description_vi,
            'description_ja' => $product->description_ja,
            'description_ko' => $product->description_ko,
            'description_en' => $product->description_en,
            'description_zh' => $product->description_zh,

            'short_description_vi' => $product->short_description_vi,
            'short_description_ja' => $product->short_description_ja,
            'short_description_ko' => $product->short_description_ko,
            'short_description_en' => $product->short_description_en,
            'short_description_zh' => $product->short_description_zh,

        ];

        $success = Product::create($newProductData);
        $product = Product::where('user_id', Auth::user()->id)->orderByDesc('id')->first();

        $starts = $request->input('starts');
        $ends = $request->input('ends');

        $sales = $request->input('sales');
        $days = $request->input('days');

        $ships = $request->input('ships');

        $counts = count($starts);
        for ($i = 0; $i < $counts; $i++) {
            $newProductSale = null;
            if (!$starts[$i]) {
                $starts[$i] = $product->min;
            }
            if (!$ends[$i]) {
                $quantity = $starts[$i];
            } else {
                $quantity = $starts[$i] . '-' . $ends[$i];
            }
            $newProductSale = [
                'user_id' => $product->user_id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'sales' => $sales[$i],
                'days' => $days[$i],
                'ship' => $ships[$i],
            ];
            ProductSale::create($newProductSale);
        }


        $arrayProduct = [];
        if ($number) {
            for ($i = 1; $i < $number + 1; $i++) {
                $newVariationData = [];

                if ($request->hasFile('thumbnail' . $i)) {
                    $thumbnail = $request->file('thumbnail' . $i);
                    $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                    $newVariationData['thumbnail'] = $thumbnailPath;
                }

                $newVariationData['price'] = $request->input('price' . $i);
                $newVariationData['old_price'] = $request->input('old_price' . $i);
                $attPro = $request->input('attribute_property' . $i);
                $newVariationData['variation'] = $attPro;

                $newVariationData['product_id'] = $product->id;
                $newVariationData['user_id'] = Auth::user()->id;
                $newVariationData['status'] = VariationStatus::ACTIVE;
                $newVariationData['description'] = $request->input('description' . $i);
                $newVariationData['quantity'] = $request->input('quantity' . $i);

                if (!$request->input('price' . $i) || $request->input('old_price' . $i) < $request->input('price' . $i)) {
                    $newVariationData['price'] = $request->input('old_price' . $i);
                }

                $arrayProduct[] = $newVariationData;
            }
            Variation::insert($arrayProduct);
            $sourceArray = session()->get('sourceArray');
            $this->createAttributeProduct($product, $sourceArray[0]);
        }

        return $success;
    }

    private function getCategory(Request $request)
    {
        $listIDs = null;
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        $listCategoryName[] = null;
        foreach ($categories as $category) {
            $name = 'category-' . $category->id;
            $listCategoryName[] = $name;
        }
        if ($listCategoryName != null) {
            $listValues = null;
            for ($i = 0; $i < count($listCategoryName); $i++) {
                $listValues[] = $request->input($listCategoryName[$i]);
            }
            if ($listValues != null) {
                $arrayIds = null;
                for ($i = 1; $i < count($listValues); $i++) {
                    if ($listValues[$i] != null) {
                        $arrayIds[] = $listValues[$i];
                    }
                }
                if ($arrayIds != null) {
                    $listIDs = $arrayIds;
                }
            }
        }
        return $listIDs;
    }

    private function createAttributeProduct($product, $newArray)
    {
        if ($newArray != null) {
            for ($i = 0; $i < count($newArray); $i++) {
                $myArray = array();
                $arraySplit = explode('-', $newArray[$i]);
                for ($j = 1; $j < count($arraySplit); $j++) {
                    $myArray[] = $arraySplit[$j];
                }

                $attribute_property = [
                    'product_id' => $product->id,
                    'attribute_id' => $arraySplit[0],
                    'value' => implode(",", $myArray),
                    'status' => AttributeProductStatus::ACTIVE
                ];
                DB::table('product_attribute')->insert($attribute_property);
            }
        }
    }

    private function updateProduct($product, $request, $number)
    {
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
            $product->thumbnail = $thumbnailPath;
        }

        $arrayIDs = $this->getCategory($request);
        if (!$arrayIDs || count($arrayIDs) == 0) {
            $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
            $category = $categories[0];
            $arrayIDs[] = $category->id;
        }
        $listIDs = implode(',', $arrayIDs);
        $product->category_id = $arrayIDs[0];

        $product->list_category = $listIDs;

        if ($number) {
            if ($number > 1) {
                for ($i = 1; $i < $number + 1; $i++) {
                    $id = $request->input('id' . $i);

                    $newVariationData = Variation::find($id);

                    $newVariationData->quantity = $request->input('quantity' . $id);

                    if ($request->hasFile('thumbnail' . $id)) {
                        $thumbnail = $request->file('thumbnail' . $id);
                        $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                        $newVariationData->thumbnail = $thumbnailPath;
                    }

                    $newVariationData->price = $request->input('price' . $id);
                    $newVariationData->old_price = $request->input('old_price' . $id);

                    if (!$request->input('price' . $id) || $request->input('old_price' . $id) < $request->input('price' . $id)) {
                        $newVariationData->price = $request->input('old_price' . $id);
                    }

                    $newVariationData->description = $request->input('description' . $id);

                    $newVariationData->save();
                }
            } else {
                $newVariationData = Variation::where([['product_id', $product->id], ['status', VariationStatus::ACTIVE]])->first();

                if (!$newVariationData) {
                    $newVariationData = new Variation();
                    $newVariationData->product_id = $product->id;
                    $newVariationData->user_id = Auth::user()->id;
                    $newVariationData->variation = 0;
                    $newVariationData->quantity = 100;
                }

                $newVariationData->quantity = $request->input('quantity' . $newVariationData->id);

                if ($request->hasFile('thumbnail' . $newVariationData->id)) {
                    $thumbnail = $request->file('thumbnail' . $newVariationData->id);
                    $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                    $newVariationData->thumbnail = $thumbnailPath;
                }

                $newVariationData->price = $request->input('price' . $newVariationData->id);
                $newVariationData->old_price = $request->input('old_price' . $newVariationData->id);

                if (!$request->input('price' . $newVariationData->id) || $request->input('old_price' . $newVariationData->id) < $request->input('price' . $newVariationData->id)) {
                    $newVariationData->price = $request->input('old_price' . $newVariationData->id);
                }

                $newVariationData->description = $request->input('description' . $newVariationData->id);

                $newVariationData->save();
            }
        }

        $success = $product->save();

        return $success;
    }
}