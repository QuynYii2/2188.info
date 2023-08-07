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
        try {
            $request->validate([
                'attribute_name' => 'required'
            ]);

            $name = $request->attribute_name;

            $slug = $request->input('attribute_slug');
            if (!$slug) {
                $slug = \Str::slug($name);
            }
            $attribute = Attribute::create([
                'name' => $name,
                'slug' => $slug,
                'user_id' => Auth::user()->id,
            ]);

            if ($attribute) {
                alert()->success('Success', 'Attribute created successfully.');
                return redirect(route('attributes.index'));
            } else {
                alert()->error('Error', 'Attribute created erro!.');
                return redirect(route('attributes.index'));
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
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
        try {
            $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
            if ($attribute == null) {
                return redirect()->route('attributes.index');
            }
            $request->validate([
                'attribute_name' => 'required'
            ]);

            $name = $request->attribute_name;

            $slug = $request->input('attribute_slug');
            if (!$slug) {
                $slug = \Str::slug($name);
            }

            $attribute->name = $name;
            $attribute->slug = $slug;
            $success = $attribute->save();
            if ($success) {
                alert()->success('Success', 'Attribute updated successfully.');
                return redirect(route('attributes.index'));
            }
            alert()->error('Error', 'Attribute updated error!.');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            return back();
        }
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
        alert()->success('Success', 'Attribute Delete successfully.');
        return redirect()->route('attributes.index');
    }
}
