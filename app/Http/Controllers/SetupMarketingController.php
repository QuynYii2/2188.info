<?php

namespace App\Http\Controllers;

use App\Models\SetupMarketing;
use Illuminate\Http\Request;

class SetupMarketingController extends Controller
{
    public function index()
    {
        $setups = SetupMarketing::all();
        return view('admin.setup-marketing.list', compact('setups'));
    }

    public function create()
    {
        return view('admin.setup-marketing.create');
    }

    public function store(Request $request)
    {
        $item = new SetupMarketing();
        $item->stt = $request->input('location');
        $item->name = $request->input('name');
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
            $newVariationData['thumbnail'] = $thumbnailPath;
        }
        $item->thumbnail =$thumbnailPath;
        $item->save();
        alert()->success('Success', 'Tạo thành công');
        return redirect(route('setup-marketing.show'));
    }

    public function edit($id){
        $edit_setup = SetupMarketing::find($id);
        return view('admin.setup-marketing.edit',compact('edit_setup'));

    }

    public function update($id, Request $request){
        $edit_setup = SetupMarketing::find($id);
        $edit_setup->stt = $request->input('location');
        $edit_setup->name = $request->input('name');
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
            $newVariationData['thumbnail'] = $thumbnailPath;
        }
        $edit_setup->thumbnail =$thumbnailPath;
        $edit_setup->save();
        alert()->success('Success', 'Sửa thành công');
        return redirect(route('setup-marketing.show'));
    }

    public function delete($id)
    {
        SetupMarketing::where('id', $id)->delete();
        alert()->success('Success', 'Delete thành công');
        return redirect(route('setup-marketing.show'));
    }
}
