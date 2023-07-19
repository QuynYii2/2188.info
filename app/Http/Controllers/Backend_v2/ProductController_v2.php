<?php

namespace App\Http\Controllers\Backend_v2;

use App\Enums\AttributeProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController_v2 extends Controller
{
    public function index()
    {
        return view('backend-v2.products.index');
    }

    public function create()
    {
        return view('backend-v2.products.create');
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
        //
    }

    public function edit()
    {
        return view('backend-v2.products.edit');

    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($id)
    {
        //
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
