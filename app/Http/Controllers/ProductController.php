<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail_product() {
        return view('frontend/pages/detail-product');
    }

    public function store(Request $request)
    {
        // Kiểm tra và lưu ảnh thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
        }

        // Kiểm tra và lưu ảnh gallery
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $galleryPaths = [];
            foreach ($gallery as $image) {
                $galleryPath = $image->store('gallery', 'public');
                $galleryPaths[] = $galleryPath;
            }
        }

        // Lưu thông tin sản phẩm vào cơ sở dữ liệu
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->thumbnail = $thumbnailPath;
        $product->gallery = $galleryPaths;
        $product->save();

        // Redirect hoặc xử lý tiếp theo
    }
}
