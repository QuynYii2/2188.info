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
    public function index()
    {
        $properties = DB::table('properties')
            ->join('attributes', 'attributes.id', '=', 'properties.attribute_id')
            ->where([
                ['attributes.user_id', '=', Auth::user()->id],
                ['attributes.status', '!=', AttributeStatus::DELETED],
                ['properties.status', '!=', PropertiStatus::DELETED]
                ])
            ->select('properties.*')
            ->get();

        return view('backend.properties.index', compact('properties'));

    }

    public function create()
    {
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();
        return view('backend.properties.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'attribute_id' => 'required',
        ]);

        $properties = Properties::create([
            'name' => $request->name,
            'attribute_id' => $request->attribute_id
        ]);

        return redirect()->route('properties.index')->with('success', 'Properties created successfully.');
    }

    public function show($id)
    {
        $propertie = Properties::where([['status', PropertiStatus::ACTIVE], ['id', $id]])->first();
        $attributes = Attribute::where([['status', AttributeStatus::ACTIVE], ['user_id', Auth::user()->id]])->get();
        if ($propertie == null) {
            return redirect()->route('properties.index');
        }
        return view('backend.properties.detail', compact('propertie', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $propertie = Properties::where([['status', PropertiStatus::ACTIVE], ['id', $id]])->first();
        if ($propertie == null) {
            return redirect()->route('properties.index');
        }
        $request->validate([
            'name' => 'required',
            'attribute_id' => 'required',
        ]);

        $propertie->name = $request->name;
        $propertie->attribute_id = $request->attribute_id;
        $propertie->save();

        return redirect()->route('properties.index')->with('success', 'Properties updated successfully.');
    }

    public function toggle($id)
    {
//        $property = Properties::where([['status', PropertiStatus::ACTIVE], ['id', $id]])->first();
//        if ($property == null) {
//            return redirect()->route('properties.index');
//        }
//
//        $property->status = PropertiStatus::DELETED;
//        $property->save();
//
//        return redirect()->route('properties.index')->with('success', 'Delete property success!');
    }

    public function destroy($id)
    {
        $property = Properties::where([['status', PropertiStatus::ACTIVE], ['id', $id]])->first();
        if ($property == null) {
            return redirect()->route('properties.index');
        }

        $property->status = PropertiStatus::DELETED;
        $property->save();

        return redirect()->route('properties.index')->with('success', 'Delete property success!');
    }
}
