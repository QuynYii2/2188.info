<?php

namespace App\Http\Controllers\Seller;

use App\Enums\AttributeStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::where('status', '!=', AttributeStatus::DELETED)->get();
        return view('backend.attributes.index', compact('attributes'));

    }

    public function create()
    {
        return view('backend.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:attributes',
        ]);

        $attribute = Attribute::create([
            'name' => $request->name,
        ]);

        return redirect()->route('attributes.index')->with('success', 'Attribute created successfully.');
    }

    public function show($id)
    {
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id]])->first();
        if ($attribute == null) {
            return redirect()->route('attributes.index');
        }
        return view('backend.attributes.detail', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id]])->first();
        if ($attribute == null) {
            return redirect()->route('attributes.index');
        }
        $request->validate([
            'name' => 'required|unique:attributes',
        ]);

        $attribute->name = $request->name;
        $attribute->save();

        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
