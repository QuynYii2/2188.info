<?php

namespace App\Http\Controllers\Backend_v2;

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
use App\Models\Variation;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                $gallery = $request->file('gallery');
                $galleryPaths = [];
                foreach ($gallery as $image) {
                    $galleryPath = $image->store('gallery', 'public');
                    $galleryPaths[] = $galleryPath;
                }
                $galleryString = implode(',', $galleryPaths);
                $product->gallery = $galleryString;
            }
            $qty_in_storage = DB::table('storage_products')->where([['id', '=', $request->input('storage-id')]])->first('quantity');

            $product->storage_id = $request->input('storage-id');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->product_code = $request->input('product_code');
            $product->qty = $qty_in_storage->quantity;
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
            session()->remove('product');
            session()->remove('testArray');
            session()->remove('sourceArray');
            session()->push('product', $product);
            session()->push('sourceArray', $newArray);
            session()->push('testArray', $testArray);
            return redirect(route('product.v2.select'));
        } catch (\Exception $exception) {
            dd($exception);
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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', \Illuminate\Support\Facades\Auth::user()->id]])->get();
        $att_of_product = DB::table('product_attribute')->where('product_id', $product->id)->get();

        return view('backend-v2.products.edit', compact(
            'categories',
            'att_of_product',
            'attributes',
            'product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', \Illuminate\Support\Facades\Auth::user()->id]])->get();
        $att_of_product = DB::table('product_attribute')->where('product_id', $product->id)->get();

        return view('backend-v2.products.edit', compact(
            'categories',
            'att_of_product',
            'attributes',
            'product'));
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
            if ($request->hasFile('gallery')) {
                $gallery = $request->file('gallery');
                $galleryPaths = [];
                foreach ($gallery as $image) {
                    $galleryPath = $image->store('gallery', 'public');
                    $galleryPaths[] = $galleryPath;
                }
                $galleryString = implode(',', $galleryPaths);
                $product->gallery = $galleryString;
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

    private function createProduct($product, $request, $number)
    {
        $newProduct = null;
        $newProduct['storage_id'] = $product->storage_id;
        $newProduct['name'] = $product->name;
        $newProduct['description'] = $product->description;
        $newProduct['product_code'] = $product->product_code;
        $newProduct['qty'] = $product->qty;
        $newProduct['category_id'] = $product->category_id;
        $newProduct['user_id'] = Auth::user()->id;
        $newProduct['location'] = Auth::user()->region;
        $newProduct['feature'] = $product->feature;
        $newProduct['hot'] = $product->hot;
        $newProduct['slug'] = $product->slug;

        $newProduct['price'] = 0;
        $newProduct['old_price'] = 0;

        $success = Product::create($newProduct);
        $product = Product::where('user_id', Auth::user()->id)->orderByDesc('id')->first();

        $arrayProduct = null;
        $newVariation = null;
        for ($i = 1; $i < $number + 1; $i++) {
            if ($request->hasFile('thumbnail' . $i)) {
                $thumbnail = $request->file('thumbnail' . $i);
                $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                $newVariation['thumbnail'] = $thumbnailPath;
            }

            $newVariation['price'] = $request->input('price' . $i);
            $newVariation['old_price'] = $request->input('old_price' . $i);
            $attPro = $request->input('attribute_property' . $i);
            $newVariation['variation'] = $attPro;

            $newVariation['product_id'] = $product->id;
            $newVariation['user_id'] = Auth::user()->id;
            $newVariation['status'] = VariationStatus::ACTIVE;
            $newVariation['description'] = $request->input('description' . $i);
//            $newVariation['quantity'] = $product->qty;
            $newVariation['quantity'] = $request->input('quantity' . $i);

            if (!$request->input('price' . $i) || $request->input('old_price' . $i) < $request->input('price' . $i)) {
                $newVariation['price'] = $request->input('old_price' . $i);
            }

            $arrayProduct[] = $newVariation;
        }

        for ($j = 0; $j < count($arrayProduct); $j++) {
            Variation::create($arrayProduct[$j]);
        }
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
