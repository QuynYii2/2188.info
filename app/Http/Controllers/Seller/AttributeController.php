<?php

namespace App\Http\Controllers\Seller;

use App\Enums\AttributeStatus;
use App\Enums\PropertiStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\TranslateController;
use App\Models\Attribute;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $attributes = Attribute::where([['status', '!=', AttributeStatus::DELETED], ['user_id', Auth::user()->id]])->get();
        return view('backend.attributes.index', compact('attributes'));

    }

    public function create()
    {
        return view('backend.attributes.create');
    }

    public function store(Request $request)
    {
        (new HomeController())->getLocale($request);

        try {
            $request->validate([
                'attribute_name' => 'required'
            ]);

            $name = $request->attribute_name;

            $ld = new TranslateController();

            $name_vi = $ld->translateText($name, 'vi');
            $name_ja = $ld->translateText($name, 'ja');
            $name_ko = $ld->translateText($name, 'ko');
            $name_en = $ld->translateText($name, 'en');
            $name_zh = $ld->translateText($name, 'zh-CN');

            $slug = $request->input('attribute_slug');
            if (!$slug) {
                $slug = \Str::slug($name);
            }
            $attribute = Attribute::create([
                'name' => $name,
                'name_vi' => $name_vi,
                'name_ja' => $name_ja,
                'name_ko' => $name_ko,
                'name_en' => $name_en,
                'name_zh' => $name_zh,
                'slug' => $slug,
                'user_id' => Auth::user()->id,
            ]);
            if ($attribute) {
                alert()->success('Success', 'Attribute created successfully.');
                return redirect(route('attributes.index'));
            } else {
                alert()->error('Error', 'Attribute created error!.');
                return redirect(route('attributes.index'));
            }
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function show(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
        if ($attribute == null) {
            return redirect()->route('attributes.index');
        }
        return view('backend.attributes.detail', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
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

            $ld = new TranslateController();

            $name_vi = $ld->translateText($name, 'vi');
            $name_ja = $ld->translateText($name, 'ja');
            $name_ko = $ld->translateText($name, 'ko');
            $name_en = $ld->translateText($name, 'en');
            $name_zh = $ld->translateText($name, 'zh-CN');

            $attribute->name = $name;
            $attribute->name_vi = $name_vi;
            $attribute->name_ko = $name_ko;
            $attribute->name_ja = $name_ja;
            $attribute->name_zh = $name_zh;
            $attribute->name_en = $name_en;
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

    public function toggle(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
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

    public function destroy(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $attribute = Attribute::where([['status', AttributeStatus::ACTIVE], ['id', $id], ['user_id', Auth::user()->id]])->first();
        if ($attribute == null) {
            return redirect()->route('attributes.index');
        }
        $attribute->status = AttributeStatus::DELETED;
        $attribute->save();
        alert()->success('Success', 'Attribute Delete successfully.');
        return redirect()->route('attributes.index');
    }

    public function getPropertyByAttribute($id)
    {
        $attribute = Attribute::find($id);
        $properties = Properties::where([['attribute_id', $id], ['status', PropertiStatus::ACTIVE]])->get();
        return view('backend.products.property.property', compact('properties', 'attribute'));
    }

    public function getAllAttribute()
    {
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();
        return view('backend.products.attribute.attribute', compact('attributes'));
    }

    public function storeAttribute(Request $request)
    {
        try {
            $request->validate([
                'attribute_name' => 'required'
            ]);

            $name = $request->attribute_name;

            $ld = new TranslateController();

            $name_vi = $ld->translateText($name, 'vi');
            $name_ja = $ld->translateText($name, 'ja');
            $name_ko = $ld->translateText($name, 'ko');
            $name_en = $ld->translateText($name, 'en');
            $name_zh = $ld->translateText($name, 'zh-CN');
            $slug = \Str::slug($name);
            $attribute = Attribute::create([
                'name' => $name,
                'name_vi' => $name_vi,
                'name_ja' => $name_ja,
                'name_ko' => $name_ko,
                'name_en' => $name_en,
                'name_zh' => $name_zh,
                'slug' => $slug,
                'user_id' => Auth::user()->id,
            ]);
            if ($attribute) {
                return response($attribute, 200);
            } else {
                return response('Bad request', 400);
            }
        } catch (\Exception $exception) {
            return response($exception, 500);
        }
    }

    public function storeProperty(Request $request)
    {
        try {
            $request->validate([
                'property_name' => 'required',
                'attribute_id' => 'required',
            ]);

            $name = $request->property_name;
            $attributeID = $request->attribute_id;
            $slug = \Str::slug($name);

            $ld = new TranslateController();
            $name_vi = $ld->translateText($name, 'vi');
            $name_ja = $ld->translateText($name, 'ja');
            $name_ko = $ld->translateText($name, 'ko');
            $name_en = $ld->translateText($name, 'en');
            $name_zh = $ld->translateText($name, 'zh-CN');

            $property = Properties::create([
                'name' => $name,
                'slug' => $slug,
                'name_vi' => $name_vi,
                'name_ja' => $name_ja,
                'name_ko' => $name_ko,
                'name_en' => $name_en,
                'name_zh' => $name_zh,
                'description' => '',
                'attribute_id' => $attributeID,
            ]);

            if ($property) {
                $attribute = Attribute::find($attributeID);
                $properties = Properties::where([['attribute_id', $attributeID], ['status', PropertiStatus::ACTIVE]])->get();
                return view('backend.products.property.call-property', compact('properties', 'attribute'));
            } else {
                return response('Bad request', 400);
            }
        } catch (\Exception $exception) {
            return response($exception, 500);
        }
    }

    public function callAttribute(Request $request)
    {
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();
        return view('backend.products.attribute.call-attribute', compact('attributes'));
    }
}
