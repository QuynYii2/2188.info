<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductControllerBackup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('backend/products/index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();

        return view('backend/products/create', [
            'categories' => $categories,
            'attributes' => $attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

        $variationsArray = [];
        $variations = $request->input('variations');

        dd($variations);

//        foreach ($variations as $variationId) {
//            $variation = Variation::find($variationId);
//            if ($variation) {
//                $variationsArray[] = $variation->name;
//            }
//        }

        $variationsString = implode(', ', $variationsArray);


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
        if ($createProduct) {
            $request->session()->flash('success_create_product', 'Tạo mới sản phẩm thành công.');
            return redirect()->route('seller.products.index')->with('success', 'Category đã được cập nhật thành công!');
        } else {
            $request->session()->flash('error_create_product', 'Tạo mới sản phẩm không thành công.');
            return redirect()->route('seller.products.edit');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::all();
        $att_of_product = DB::table('product_attribute')->where('product_id', $product->id)->get();

        return view('backend.products.edit', compact('product', 'categories', 'attributes', 'att_of_product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Product đã được xóa thành công!');
    }
}
