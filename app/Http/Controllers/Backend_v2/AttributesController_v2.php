<?php

namespace App\Http\Controllers\Backend_v2;

use App\Enums\AttributeStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributesController_v2 extends Controller
{
    public function index()
    {
        $attributes = Attribute::where([['status', '!=', AttributeStatus::DELETED], ['user_id', Auth::user()->id]])->get();
        return view('backend-v2.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('backend-v2.attributes.index');
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
                return redirect(route('attributes.v2.show'));
            } else {
                alert()->error('Error', 'Attribute created erro!.');
                return redirect(route('attributes.v2.show'));
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

    public function edit($id)
    {
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
        if ($attribute == null) {
            return redirect(route('attributes.v2.show'));
        }
        return view('backend-v2.attributes.detail', compact('attribute'));
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
                return redirect(route('attributes.v2.show'));
            }
            alert()->error('Error', 'Attribute updated error!.');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
            if ($attribute == null) {
                return redirect()->route('attributes.index');
            }
            $attribute->status = AttributeStatus::DELETED;
            $attribute->save();
            alert()->success('Success', 'Attribute was delete successfully!');
            return redirect(route('attributes.v2.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Please try again');
            return back();
        }
    }
}
