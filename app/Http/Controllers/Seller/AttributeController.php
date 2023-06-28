<?php

namespace App\Http\Controllers\Seller;

use App\Enums\AttributeStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::where([['status', '!=', AttributeStatus::DELETED], ['user_id', Auth::user()->id]])->get();
        return view('backend.attributes.index', compact('attributes'));

    }

    public function create()
    {
        return view('backend.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $attribute = Attribute::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('attributes.index')->with('success', 'Attribute created successfully.');
    }

    public function show($id)
    {
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
        if ($attribute == null) {
            return redirect()->route('attributes.index');
        }
        return view('backend.attributes.detail', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
        if ($attribute == null) {
            return redirect()->route('attributes.index');
        }
        $request->validate([
            'name' => 'required',
        ]);

        $attribute->name = $request->name;
        $attribute->save();

        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function toggle($id)
    {
        $attribute = Attribute::where([['id', $id], ['user_id', Auth::user()->id]])->first();
        if ($attribute == null) {
            return back([400], ['Error']);
        }
        if ($attribute->status == AttributeStatus::ACTIVE) {
            $attribute->status = AttributeStatus::INACTIVE;
        } elseif ($attribute->status == AttributeStatus::INACTIVE) {
            $attribute->status = AttributeStatus::ACTIVE;
        }
        $attribute->save();
        return $attribute;
//        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function destroy($id)
    {
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
        if ($attribute == null) {
            return redirect()->route('attributes.index');
        }
        $attribute->status = AttributeStatus::DELETED;
        $attribute->save();
        return redirect()->route('attributes.index')->with('success', 'Delete');
    }
}
