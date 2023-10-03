<?php

namespace App\Http\Controllers\Backend_v2;

use App\Enums\AttributeProductStatus;
use App\Enums\AttributeStatus;
use App\Enums\CartStatus;
use App\Enums\ProductStatus;
use App\Enums\VariationStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\StaffUsers;
use App\Models\StorageProduct;
use App\Models\Variation;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Mockery\Exception;
use stdClass;

class ProductController_v2 extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $check_ctv_shop = StaffUsers::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
        if ($check_ctv_shop) {
            $products = Product::where([
                ['user_id', $check_ctv_shop->parent_user_id],
                ['status', '!=', ProductStatus::DELETED]
            ])->orderByDesc('id')->get();
        } else {
            $products = Product::where([
                ['user_id', Auth::user()->id],
                ['status', '!=', ProductStatus::DELETED]
            ])->orderByDesc('id')->get();
        }
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', \Illuminate\Support\Facades\Auth::user()->id]])->get();
        return view('backend-v2.products.index', compact('products', 'categories', 'attributes'));
    }

    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', \Illuminate\Support\Facades\Auth::user()->id]])->get();

        $id = Auth::user()->id;
        $roles = DB::table('role_user')->where('user_id', $id)->get('role_id');
        $storages = StorageProduct::where('create_by', Auth::user()->id)->orderByDesc('id')->get();
        foreach ($roles as $role) {
            if ($role->role_id == 1) {
                $storages = StorageProduct::all();
                break;
            }
        }

        return view('backend-v2.products.processCreate', compact('categories', 'attributes', 'storages'));
    }

    public function showGenerateProduct()
    {
        $product = session()->get('product');
        $testArray = session()->get('testArray');
        if (!$product) {
            return back();
        }
        $product = $product[0];
        $testArray = $testArray[0];
        return view('backend-v2.products.create', compact('product', 'testArray'));
    }

    public function generateProduct(Request $request)
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
            session()->forget(['product', 'testArray', 'sourceArray']);
            session()->push('product', $product);
            session()->push('sourceArray', $newArray);
            session()->push('testArray', $testArray);
            return redirect(route('product.v2.select'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            $product = new Product();

            $qty_in_storage = DB::table('storage_products')->where([['id', '=', $request->input('storage_id')]])->first('quantity');

            $product->gallery = $request->input('gallery');
            $product->storage_id = $request->input('storage_id');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->product_code = $request->input('product_code');
            $product->qty = $qty_in_storage->quantity;
            $product->category_id = $request->input('category_id');
            $product->user_id = Auth::user()->id;
            $product->location = Auth::user()->region;

            $product->slug = \Str::slug($request->input('name'));

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

            $count = $request->input('count');

            $createProduct = $this->createProduct($product, $request, $count);
            if ($createProduct) {
                alert()->success('Success', 'Tạo mới sản phẩm thành công.');
                return redirect()->route('product.v2.show');
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

    public function createNewProduct(Request $request)
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
                return redirect()->route('product.v2.show');
            } else {
                alert()->error('Error', 'Tạo mới sản phẩm không thành công.');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
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
                return view('backend-v2.products.none-attribute');
            }
            return view('backend-v2.products.attribute');
        } catch (Exception $exception) {
            return response($exception, 400);
        }
    }

    public function none()
    {
        try {
            return view('backend-v2.products.none-attribute');
        } catch (Exception $exception) {
            return response($exception, 400);
        }
    }

    public function handleGallery($input)
    {
        $arrGallery = json_decode($input);
        $pattern = '/\/storage\/([^,]+),?/';
        $matches = array();
        $arrResult = array();
        foreach ($arrGallery as $item) {
            preg_match_all($pattern, $item, $matches);
            array_push($arrResult, $matches[1][0]);
        }
        return implode(',', $arrResult);
    }

    public function quickUpdateProduct($id, Request $request)
    {
        try {
            $product = Product::findOrFail($id);
            $number = $request->input('countBegin');
            $success = $this->updateProduct($product, $request, $number);
            if ($success) {
                alert()->success('Success', 'Cập nhật thành công.');
                return redirect()->route('product.v2.show');
            } else {
                alert()->error('Error', 'Cập nhật không thành công.');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again');
            return back();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', \Illuminate\Support\Facades\Auth::user()->id]])->get();
        $att_of_product = DB::table('product_attribute')->where('product_id', $product->id)->get();
        $productDetails = Variation::where('product_id', $id)->get();

        return view('backend-v2.products.edit', compact(
            'categories',
            'att_of_product',
            'attributes',
            'product',
            'productDetails'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

//            $product->gallery = $this->handleGallery($request->input('imgGallery'));
            $number = $request->input('count');
            $isNew = $request->input('isNew');

            if ($isNew > 10) {
                $newArray = $this->getAttributeProperty($request);
                $product->name = $request->input('name');
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

                Variation::where('product_id', $product->id)->delete();
                Variation::insert($arrayProduct);
                DB::table('product_attribute')->where('product_id', $product->id)->delete();
                $this->createAttributeProduct($product, $newArray);

                $updateProduct = $product->save();
            } else {
                $updateProduct = $this->updateProduct($product, $request, $number);
            }

            if ($updateProduct) {
                alert()->success('Success', 'Cập nhật thành công.');
                return redirect()->route('product.v2.show');
            } else {
                alert()->error('Error', 'Cập nhật không thành công.');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->status = ProductStatus::DELETED;
            $success = $product->save();
            if ($success) {
                alert()->success('Success', 'Product đã được xóa thành công!');
                return redirect()->route('product.v2.show');
            }
            alert()->error('Error', 'Không thể xoá sản phẩm!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error please try again!');
            return back();
        }
    }

    public function removeVariation($id)
    {
        try {
            $variable = Variation::where('id', $id)->first();
            $carts = Cart::where('product_id', $variable->product_id)->where('values', $variable->variation)->get();
            foreach ($carts as $cart) {
                $cart->status = CartStatus::DELETED;
                $cart->save();
            }
            $variable->status = VariationStatus::DELETED;
            $success = $variable->save();
            if ($success) {
                alert()->success('Success', 'Variable đã được xóa thành công!');
                return back();
            }
            alert()->error('Error', 'Không thể xoá variable!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error please try again!');
            return back();
        }
    }

    private function updateProduct($product, $request, $number)
    {
        $product->name = $request->input('name');
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

        if ($number > 1) {
            for ($i = 1; $i < $number + 1; $i++) {
                $id = $request->input('id' . $i);

                $newVariationData = Variation::find($id);

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

                $newVariationData->save();
            }
        } else {
            $newVariationData = Variation::where('product_id', $product->id)->first();

            if ($request->hasFile('thumbnail1')) {
                $thumbnail = $request->file('thumbnail1');
                $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                $newVariationData->thumbnail = $thumbnailPath;
            }

            $newVariationData->price = $request->input('price1');
            $newVariationData->old_price = $request->input('old_price1');

            if (!$request->input('price1') || $request->input('old_price1') < $request->input('price')) {
                $newVariationData->price = $request->input('old_price1');
            }

            $newVariationData->save();
        }

        $success = $product->save();

        return $success;
    }

    private function getAttributeProperty(Request $request)
    {
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
