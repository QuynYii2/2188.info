<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TopSellerConfig;
use Auth;
use Illuminate\Http\Request;

class TopSellerConfigController extends Controller
{
    public function index()
    {
        $configs = TopSellerConfig::where('user_id', Auth::user()->id)->first();
        return view('backend.top-seller-config.list', compact('configs'));
    }

    public function processCreate()
    {
        $categories = Category::all();
        return view('backend.top-seller-config.create', compact('categories'));
    }

    public function create(Request $request)
    {
        try {
            $configs = TopSellerConfig::where('user_id', Auth::user()->id)->first();
            if ($configs){
                alert()->error('Error', 'Top seller already exist!');
                return back();
            }
            $config = new TopSellerConfig();
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                $config->thumbnail = $thumbnailPath;
            }
            $url = $request->input('url_tag');
            $local = $request->input('local');
            $config->url = $url;
            $config->local = $local;
            $config->user_id = Auth::user()->id;
            $success = $config->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect(route('seller.config.show'));
            }
            alert()->error('Error', 'Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            TopSellerConfig::where('id', $id)->delete();
            alert()->success('Success', 'Delete success!');
            return redirect(route('seller.config.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            return back();
        }
    }
}
