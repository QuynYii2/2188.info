<?php

namespace App\Http\Controllers\Seller;

use App\Enums\AttributeProductStatus;
use App\Enums\AttributeStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::user()->id)->orderByDesc('id')->get();
        return view('backend/products/index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();

        return view('backend/products/create', [
            'categories' => $categories,
            'attributes' => $attributes
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
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');

        }

        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galleryPaths = [];
            foreach ($gallery as $image) {
                $galleryPath = $image->store('gallery', 'public');
                $galleryPaths[] = $galleryPath;
            }
        }

        $userLogin = $request->session()->get('login');
        $userInfo = User::where('email', $userLogin)->first();

        $price = $request->input('price');
        $pricePercent = $request->input('price-percent');
        if ($pricePercent != null || $pricePercent > 0) {
            $price = $pricePercent;
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $price;
        $product->category_id = $request->input('category_id');
        $product->thumbnail = $thumbnailPath;
        $galleryString = implode(',', $galleryPaths);
        $product->gallery = $galleryString;
        $product->user_id = $userInfo->id;
        $product->location = $userInfo->region;
        $createProduct = $product->save();

        $newArray = $this->getAttributeProperty($request);

        $product = Product::where('user_id', $userInfo->id)->orderByDesc('id')->first();

        $this->createAttributeProduct($product, $newArray);

        if ($createProduct) {
            $request->session()->flash('success_create_product', 'Tạo mới sản phẩm thành công.');
            return redirect()->route('seller.products.index')->with('success', 'Category đã được cập nhật thành công!');
        } else {
            $request->session()->flash('error_create_product', 'Tạo mới sản phẩm không thành công.');
            return redirect()->route('seller.products.edit');
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
            $product->gallery = $galleryPaths;
        }

        $newArray = $this->getAttributeProperty($request);

        $product_attributes = DB::table('product_attribute')->where('product_id', $product->id)->get();

        foreach ($product_attributes as $item) {
            DB::table('product_attribute')->where('product_id', $product->id)->delete($item->id);
        }

        $this->createAttributeProduct($product, $newArray);

        $updateProduct = $product->save();

        if ($updateProduct) {
            $request->session()->flash('success_update_product', 'Cập nhật thành công.');
            return redirect()->route('seller.products.index')->with('success', 'Category đã được cập nhật thành công!');
        } else {
            $request->session()->flash('error_update_product', 'Cập nhật không thành công.');
            return redirect()->route('seller.products.edit');
        }

    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Product đã được xóa thành công!');
    }
}
