<?php

namespace App\Http\Controllers\Backend_v2;

use App\Enums\AttributeStatus;
use App\Enums\PropertiStatus;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Properties;
use Illuminate\Http\Request;

class PropertyController_v2 extends Controller
{
    public function index($attributeID)
    {
        try {
            $attribute = Attribute::find($attributeID);
            $properties = Properties::where([['attribute_id', $attributeID], ['status', '!=', PropertiStatus::DELETED]])->get();
            return view('backend-v2.properties.index', compact('properties', 'attribute'));
        } catch (\Exception $exception) {
            return back();
        }
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
                return redirect()->route('properties.v2.show', $attributeID);
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
        return view('backend-v2.properties.detail', compact('property'));
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
                return redirect()->route('properties.v2.show', $attributeID);
            } else {
                alert()->error('Error', 'Error, Properties update error');
                return back();
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
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
            return redirect()->route('properties.v2.show', $attributeID);
        } catch (\Exception $exception){
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }
}
