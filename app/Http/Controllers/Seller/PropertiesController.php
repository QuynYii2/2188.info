<?php

namespace App\Http\Controllers\Seller;

use App\Enums\AttributeStatus;
use App\Enums\PropertiStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    public function index($attributeID)
    {
        try {
            $attribute = Attribute::find($attributeID);
            $properties = Properties::where([['attribute_id', $attributeID], ['status', '!=', PropertiStatus::DELETED]])->get();
            return view('backend.properties.index', compact('properties', 'attribute'));
        } catch (\Exception $exception) {
            return back();
        }
    }

    public function create()
    {
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();
        return view('backend.properties.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'property_name' => 'required',
                'attribute_id' => 'required',
            ]);

            $name = $request->property_name;
            $attributeID = $request->attribute_id;
            $slug = $request->property_slug;
            $description = $request->property_description;

            if (!$slug) {
                $slug = \Str::slug($name);
            }

            $property = Properties::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'attribute_id' => $request->attribute_id,
            ]);
            if ($property) {
                alert()->success('Success', 'Properties created successfully');
                return redirect()->route('properties.index', $attributeID);
            } else {
                alert()->error('Error', 'Error, Properties create error');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }

    public function show($id)
    {
        $property = Properties::where([['status', PropertiStatus::ACTIVE], ['id', $id]])->first();
        if ($property == null) {
            return back();
        }
        return view('backend.properties.detail', compact('property'));
    }

    public function update(Request $request, $id)
    {
        try {
            $property = Properties::where([['status', PropertiStatus::ACTIVE], ['id', $id]])->first();

            if (!$property) {
                return back();
            }

            $request->validate([
                'property_name' => 'required',
            ]);

            $name = $request->property_name;
            $slug = $request->input('property_slug');
            $description = $request->input('property_description');

            if (!$slug) {
                $slug = \Str::slug($name);
            }

            $property->name = $name;
            $property->slug = $slug;
            $property->description = $description;

            $attributeID = $property->attribute_id;
            $success = $property->save();
            if ($success) {
                alert()->success('Success', 'Properties update successfully');
                return redirect()->route('properties.index', $attributeID);
            } else {
                alert()->error('Error', 'Error, Properties update error');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }

    public function toggle($id)
    {
        $property = Properties::where('id', $id)->first();
        if ($property == null) {
            return back([400], ['Error']);
        }
        if ($property->status == PropertiStatus::ACTIVE) {
            $property->status = PropertiStatus::INACTIVE;
        } elseif ($property->status == PropertiStatus::INACTIVE) {
            $property->status = PropertiStatus::ACTIVE;
        }
        $property->save();
        return $property;
    }
    public function destroy($id)
    {
        try {
            $property = Properties::where('id', $id)->first();
            if (!$property) {
                return back();
            }
            $attributeID = $property->attribute_id;
            $property->status = PropertiStatus::DELETED;
            $property->save();
            alert()->success('Success', 'Delete property success!');
            return redirect()->route('properties.index', $attributeID);
        } catch (\Exception $exception){
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }
}
