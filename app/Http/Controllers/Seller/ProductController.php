<?php

namespace App\Http\Controllers\Seller;

use App\Enums\AttributeProductStatus;
use App\Enums\AttributeStatus;
use App\Enums\ProductStatus;
use App\Enums\VariationStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\StaffUsers;
use App\Models\StorageProduct;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        $check_ctv_shop = StaffUsers::where('user_id', Auth::user()->id)->first();
        if ($check_ctv_shop) {
            $products = Product::where([['user_id', $check_ctv_shop->parent_user_id], ['status', '!=', ProductStatus::DELETED]])->orderByDesc('id')->get();
        } else {
            $products = Product::where([['user_id', Auth::user()->id], ['status', '!=', ProductStatus::DELETED]])->orderByDesc('id')->get();
        }
        return view('backend/products/index', ['products' => $products]);
    }

    public function home()
    {
        return view('backend/products/home');
    }


    public function getProductsViews(Request $request)
    {
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
            $products = Product::where('status', '!=', ProductStatus::DELETED)->get();
            foreach ($products as $product) {
                $listUserId[] = $product->user_id;
                $listUserId = array_unique($listUserId);
            }
            if ($sellerID == null && $views == null) {
                $products = Product::where('status', '!=', ProductStatus::DELETED)->get();
            } elseif ($sellerID == null && $views != null) {
                if ($views == 'asc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'ASC')->get();
                } elseif ($views == 'desc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'DESC')->get();
                } else {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->get();
                }
            } elseif ($sellerID != null && $views == null) {
                if ($sellerID == '0') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->get();
                } else {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->get();
                }
            } elseif ($sellerID != null && $views != null) {
                if ($sellerID == '0' && $views == 'asc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'ASC')->get();
                } elseif ($sellerID == '0' && $views == 'desc') {
                    $products = Product::where('status', '!=', ProductStatus::DELETED)->orderBy('views', 'DESC')->get();
                } elseif ($sellerID != '0' && $views == 'asc') {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->orderBy('views', 'ASC')->get();
                } elseif ($sellerID != '0' && $views == 'desc') {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->orderBy('views', 'DESC')->get();
                } else {
                    $products = Product::where([['status', '!=', ProductStatus::DELETED], ['user_id', $sellerID]])->get();
                }
            }
        } else {
            if ($views == 'asc') {
                $products = Product::where([['user_id', $user], ['status', '!=', ProductStatus::DELETED]])->orderBy('views', 'ASC')->get();
            } elseif ($views == 'desc') {
                $products = Product::where([['user_id', $user], ['status', '!=', ProductStatus::DELETED]])->orderBy('views', 'DESC')->get();
            } elseif ($views == 'no' || $views == null) {
                $products = Product::where([['user_id', $user], ['status', '!=', ProductStatus::DELETED]])->get();
            }
        }
        return view('backend/products/views', compact('products', 'isAdmin', 'listUserId'));
    }


    public function create()
    {
        $categories = Category::all();
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
        return view('backend/products/create', [
            'categories' => $categories,
            'attributes' => $attributes,
            'storages' => $storages
        ]);
    }

    private function getAttributeProperty(Request $request)
    {
        $proAtt = $request->input('attribute_property');
        if ($proAtt != null) {
            $newArray = collect(explode(",", $proAtt))
                ->reduce(function ($carry, $item) {
                    $parts = explode('-', $item);
                    $firstValue = $parts[0];
                    $secondValue = $parts[1];
                    if ($carry->isEmpty()) {
                        $carry->push($item);
                    } else {
                        $lastItem = $carry->last();
                        $lastParts = explode('-', $lastItem);
                        $lastFirstValue = $lastParts[0];
                        if ($lastFirstValue == $firstValue) {
                            $newLastItem = $lastFirstValue . '-' . $lastParts[1] . '-' . $secondValue;
                            $carry->pop();
                            $carry->push($newLastItem);
                        } else {
                            $carry->push($item);
                        }
                    }
                    return $carry;
                }, collect())
                ->toArray();
        } else {
            $newArray = null;
        }

        return $newArray;
    }

    private function createAttributeProduct(Product $product, $newArray)
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


    public function store(Request $request)
    {
        try {
            $product = new Product();
            if ($request->hasFile('gallery')) {
                $galleryPaths = array_map(function ($image) {
                    return $image->store('gallery', 'public');
                }, $request->file('gallery'));
                $product->gallery = implode(',', $galleryPaths);
            }

            $qty_in_storage = DB::table('storage_products')->where('id', $request->input('storage-id'))->value('quantity');

            $product->storage_id = $request->input('storage-id');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->product_code = $request->input('product_code');
            $product->qty = $qty_in_storage;
            $product->category_id = $request->input('category_id');
            $product->user_id = Auth::user()->id;
            $product->location = Auth::user()->region;

            $product->slug = \Str::slug($request->input('name'));

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
            alert()->error('Error', 'Error, Please try again!');
            dd($exception);
            return back();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();
        $att_of_product = DB::table('product_attribute')->where('product_id', $product->id)->get();

        return view('backend.products.edit', compact('product', 'categories', 'attributes', 'att_of_product'));
    }
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->category_id = $request->input('category_id');
            $product->slug = \Str::slug($request->input('name'));

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                $product->thumbnail = $thumbnailPath;
            }

            $product->gallery = $this->handleGallery($request->input('imgGallery'));

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

            $product->old_price = $request->input('old_price');

            if (!$request->input('price') || $request->input('old_price') < $request->input('price')) {
                $product->price = $request->input('old_price');
            }

            $newArray = $this->getAttributeProperty($request);

            $product_attributes = DB::table('product_attribute')->where('product_id', $product->id)->get();

            foreach ($product_attributes as $item) {
                DB::table('product_attribute')->where('product_id', $product->id)->delete($item->id);
            }

            $this->createAttributeProduct($product, $newArray);

            $updateProduct = $product->save();

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
    }

    public function setFeatureProduct($id)
    {
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
    }

    private function createProduct($product, $request, $number)
    {
        $newProductData = [
            'storage_id' => $product->storage_id,
            'name' => $product->name,
            'description' => $product->description,
            'product_code' => $product->product_code,
            'qty' => $product->qty,
            'category_id' => $product->category_id,
            'user_id' => Auth::user()->id,
            'location' => Auth::user()->region,
            'feature' => $product->feature,
            'hot' => $product->hot,
            'slug' => $product->slug,
            'price' => 0,
            'old_price' => 0,
            'gallery' => $product->gallery,
        ];

        $success = Product::create($newProductData);
        $product = Product::where('user_id', Auth::user()->id)->orderByDesc('id')->first();

        $arrayProduct = [];
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

        return $success;
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
