<?php

namespace App\Http\Controllers\Backend_v2;

use App\Enums\AttributeProductStatus;
use App\Enums\AttributeStatus;
use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\StaffUsers;
use App\Models\StorageProduct;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('backend-v2.products.create', compact('categories', 'attributes', 'storages'));
    }

    public function store(Request $request)
    {
        try {
            $product = new Product();
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

            $qty_in_storage = DB::table('storage_products')->where([['id', '=', $request->input('storage-id')]])->first('quantity');

            $product->storage_id = $request->input('storage-id');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->product_code = $request->input('product_code');
            $product->qty = $qty_in_storage->quantity;
            $product->price = $request->input('price');
            $product->category_id = $request->input('category_id');
            $product->user_id = Auth::user()->id;
            $product->location = Auth::user()->region;
            $product->old_price = $request->input('old_price');

            if (!$request->input('price') || $request->input('old_price') < $request->input('price')) {
                $product->price = $request->input('old_price');
            }

            $hot = $request->input('hot_product');
            $feature = $request->input('feature_product');

            if ($hot) {
                $product->hot = 1;
            }

            if ($feature) {
                $product->feature = 1;
            }

            $createProduct = $product->save();

            $newArray = $this->getAttributeProperty($request);

            $product = Product::where('user_id', Auth::user()->id)->orderByDesc('id')->first();

            $this->createAttributeProduct($product, $newArray);

            if ($createProduct) {
                alert()->success('Success', 'Tạo mới sản phẩm thành công.');
                return redirect()->route('seller.products.index');
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
}
