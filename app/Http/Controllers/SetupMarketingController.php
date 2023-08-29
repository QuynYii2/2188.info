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
        $item->save();
        alert()->success('Success', 'Tạo thành công');
        return redirect(route('setup-marketing.show'));
    }

    public function delete($id)
    {
        SetupMarketing::where('id', $id)->delete();
        alert()->success('Success', 'Delete thành công');
        return redirect(route('setup-marketing.show'));
    }
}
