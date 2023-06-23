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

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->thumbnail = $thumbnailPath;
        $galleryString = implode(',', $galleryPaths);
        $product->gallery = $galleryString;
        $product->user_id = $userInfo->id;
        $product->location = $userInfo->region;
        $createProduct = $product->save();

        $proAtt = $request->input('attribute_property');
//        $arrayProAtt = explode(',', $proAtt);
//        $result = array();
//        $object = new StdClass;
//        for ($i = 0; $i < count($arrayProAtt); $i++) {
//            $text = $arrayProAtt[$i];
//            $value = explode('-', $text);
//            $object->attribute = $value[0];
//            $object->property = $value[1];
//            $result[] = $object;
//        }
//        dd($result);

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

        $product = Product::where('user_id', $userInfo->id)->orderByDesc('id')->first();

        for ($i = 0; $i < count($newArray); $i++) {
//            dd($newArray[$i]);
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
//            dd($attribute_property);
            DB::table('product_attribute')->insert($attribute_property);
        }

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
        $attributes = Attribute::all();
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
