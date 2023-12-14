<?php

namespace App\Http\Controllers;

use App\Enums\CategoryStatus;
use App\Enums\PostRFQStatus;
use App\Models\Category;
use App\Models\PostRFQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRFQController extends Controller
{
    public function processCreate(Request $request)
    {
        $categories_no_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', null]
        ])->get();
        return view('frontend.pages.create-post-rfq', compact('categories_no_parent'));
    }

    public function create(Request $request)
    {
        try {
            $new_post = new PostRFQ();

            $new_post = $this->save($request, $new_post);

            $new_post->create_by = Auth::user()->id;
            $new_post->status = PostRFQStatus::PENDING;

            $success = $new_post->save();
            if ($success) {
                return redirect(route('homepage'));
            }
            return back();
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function save($request, $post)
    {
        $ld = new TranslateController();
        $nameValue = $request->input('product_name');

        $post->product_name = $nameValue;
        $post->product_name_vi = $ld->translateText($nameValue, 'vi');
        $post->product_name_ja = $ld->translateText($nameValue, 'ja');
        $post->product_name_ko = $ld->translateText($nameValue, 'ko');
        $post->product_name_en = $ld->translateText($nameValue, 'en');
        $post->product_name_zh = $ld->translateText($nameValue, 'zh-CN');

        $descriptionValue = $request->input('description');

        $post->description = $descriptionValue;
        $post->description_vi = $ld->translateText($descriptionValue, 'vi');
        $post->description_ja = $ld->translateText($descriptionValue, 'ja');
        $post->description_ko = $ld->translateText($descriptionValue, 'ko');
        $post->description_en = $ld->translateText($descriptionValue, 'en');
        $post->description_zh = $ld->translateText($descriptionValue, 'zh-CN');

        $arrayThumbnailsPath = null;
        if ($request->hasFile('thumbnails')) {
            $thumbnails = $request->file('thumbnails');
            foreach ($thumbnails as $file) {
                $thumbnailsPath = $file->store('post', 'public');
                $arrayThumbnailsPath[] = $thumbnailsPath;
            }
        }
        if ($arrayThumbnailsPath) {
            $post->thumbnails = implode(',', $arrayThumbnailsPath);
        }

        $code_1 = $request->input('code_1');
        $code_2 = $request->input('code_2');
        $code_3 = $request->input('code_3');
        $post->code_1 = $code_1;
        $post->code_2 = $code_2;
        $post->code_3 = $code_3;

        $purchase_quantity = $request->input('purchase_quantity');
        $unit_quantity = $request->input('unit_quantity');
        $post->purchase_quantity = $purchase_quantity;
        $post->unit_quantity = $unit_quantity;

        $business_terms = $request->input('business_terms');
        $post->business_terms = $business_terms;

        $target_price = $request->input('target_price');
        $unit_price = $request->input('unit_price');
        $post->target_price = $target_price;
        $post->unit_price = $unit_price;

        $max_budget = $request->input('max_budget');
        $post->max_budget = $max_budget;

        $shipping_method = $request->input('shipping_method');
        $destination_port = $request->input('destination_port');
        $ship_in = $request->input('ship_in');
        $post->shipping_method = $shipping_method;
        $post->destination_port = $destination_port;
        $post->ship_in = $ship_in;

        $payment_terms = $request->input('payment_terms');
        $post->payment_terms = $payment_terms;

        return $post;
    }
}
