<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BannerStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index( Request $request)
    {
        (new HomeController())->getLocale($request);
        $banners = Banner::where('status', '!=', BannerStatus::DELETED)->get();
        return view('admin.banner.list', compact('banners'));
    }

    public function processCreate( Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('admin.banner.create');
    }

    public function create(Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $item = new Banner();
            $arrayThumbnails = null;
            $arraySubThumbnails = null;
            if ($request->hasFile('thumbnails')) {
                $thumbnails = $request->file('thumbnails');
                foreach ($thumbnails as $file) {
                    $thumbnailPath = $file->store('banners', 'public');
                    $arrayThumbnails[] = $thumbnailPath;
                }
            }
            if ($request->hasFile('sub_thumbnails')) {
                $subThumbnails = $request->file('sub_thumbnails');
                foreach ($subThumbnails as $file) {
                    $subThumbnailPath = $file->store('banners', 'public');
                    $arraySubThumbnails[] = $subThumbnailPath;
                }
            }
            $listThumbnails = implode(',', $arrayThumbnails);
            $listSubThumbnails = implode(',', $arraySubThumbnails);
            $item->thumbnails = $listThumbnails;
            $item->sub_thumbnails = $listSubThumbnails;
            $item->status = BannerStatus::ACTIVE;
            $success = $item->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect()->route('admin.banners.show');
            }
            alert()->error('Error', 'Create fail!');
            return redirect()->route('admin.banners.show');
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function update( Request $request,$id)
    {
        (new HomeController())->getLocale($request);
        try {
            $banner = Banner::find($id);
            if (!$banner || $banner->status == BannerStatus::DELETED) {
                return response([
                    'message' => 'Not found'
                ], 400);
            }
            if ($banner->status == BannerStatus::ACTIVE) {
                $banner->status = BannerStatus::INACTIVE;
            } else {
                $banner->status = BannerStatus::ACTIVE;
            }
            $banner->save();
            return $banner;
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function delete( Request $request,$id)
    {
        (new HomeController())->getLocale($request);
        try {
            $banner = Banner::find($id);
            if (!$banner || $banner->status == BannerStatus::DELETED) {
                alert()->error('Error', 'Banner not found!');
                return redirect()->route('admin.banners.show');
            }
            $banner->status = BannerStatus::DELETED;
            $banner->save();
            alert()->success('Success', 'Delete success!');
            return redirect()->route('admin.banners.show');
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }
}
