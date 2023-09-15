<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\SetupMarketing;
use Illuminate\Http\Request;

class SetupMarketingController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $setups = SetupMarketing::all();
        return view('admin.setup-marketing.list', compact('setups'));
    }

    public function create(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('admin.setup-marketing.create');
    }

    public function store(Request $request)
    {
        (new HomeController())->getLocale($request);
        $item = new SetupMarketing();
        $item->stt = $request->input('location');
        $item->name = $request->input('name');
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
            $newVariationData['thumbnail'] = $thumbnailPath;
        }

        $nameValue = $request->input('name');
        $ld = new TranslateController();

        $item->name_vi = $ld->translateText($nameValue, 'vi');
        $item->name_ja = $ld->translateText($nameValue, 'ja');
        $item->name_ko = $ld->translateText($nameValue, 'ko');
        $item->name_en = $ld->translateText($nameValue, 'en');
        $item->name_zh = $ld->translateText($nameValue, 'zh-CN');

        $item->thumbnail = $thumbnailPath;
        $item->save();
        alert()->success('Success', 'Tạo thành công');
        return redirect(route('setup-marketing.show'));
    }

    public function edit(Request $request,$id)
    {
        (new HomeController())->getLocale($request);
        $edit_setup = SetupMarketing::find($id);
        return view('admin.setup-marketing.edit', compact('edit_setup'));

    }

    public function update( Request $request,$id)
    {
        (new HomeController())->getLocale($request);
        $edit_setup = SetupMarketing::find($id);
        $edit_setup->stt = $request->input('location');
        $edit_setup->name = $request->input('name');
        $thumbnailPath = $edit_setup->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
        }
        $nameValue = $request->input('name');
        $ld = new TranslateController();

        $edit_setup->name_vi = $ld->translateText($nameValue, 'vi');
        $edit_setup->name_ja = $ld->translateText($nameValue, 'ja');
        $edit_setup->name_ko = $ld->translateText($nameValue, 'ko');
        $edit_setup->name_en = $ld->translateText($nameValue, 'en');
        $edit_setup->name_zh = $ld->translateText($nameValue, 'zh-CN');
        $edit_setup->thumbnail = $thumbnailPath;
        $edit_setup->save();
        alert()->success('Success', 'Sửa thành công');
        return redirect(route('setup-marketing.show'));
    }

    public function delete(Request $request,$id)
    {
        (new HomeController())->getLocale($request);
        SetupMarketing::where('id', $id)->delete();
        alert()->success('Success', 'Delete thành công');
        return redirect(route('setup-marketing.show'));
    }
}
