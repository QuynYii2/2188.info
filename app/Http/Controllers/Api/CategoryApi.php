<?php

namespace App\Http\Controllers\Api;

use App\Enums\CategoryStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryApi extends Controller
{
    public function getAllCategories(Request $request)
    {
        $order = $request->input('sort_by');
        if (!$order) {
            $order = 'desc';
        }
        $categories = Category::where('status', CategoryStatus::ACTIVE)->orderBy('id', $order)->get();
        return response()->json($categories);
    }

    public function getAllCategoriesNoParent(Request $request)
    {
        $order = $request->input('sort_by');
        if (!$order) {
            $order = 'desc';
        }
        $categories_no_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', null]
        ])->orderBy('id', $order)->get();
        return response()->json($categories_no_parent);
    }

    public function getAllCategoriesByParent($id, Request $request)
    {
        $order = $request->input('sort_by');
        if (!$order) {
            $order = 'desc';
        }
        $categories_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', $id]
        ])->orderBy('id', $order)->get();
        return response()->json($categories_parent);
    }

    public function getListCategoriesSameParent($id, Request $request)
    {
        $order = $request->input('sort_by');
        if (!$order) {
            $order = 'desc';
        }
        $category_two = Category::find($id);
        $category_one = Category::find($category_two->parent_id);
        $category = Category::find($category_one->parent_id);
        $categories = null;
        $categories['category'] = $category;
        $categories_one = DB::table('categories')
            ->where('status', CategoryStatus::ACTIVE)
            ->where('parent_id', $category->id)
            ->orderBy('id', $order)
            ->cursor()
            ->map(function ($item) use ($order) {
                $categories_two = Category::where('status', CategoryStatus::ACTIVE)
                    ->where('parent_id', $item->id)
                    ->orderBy('id', $order)
                    ->get();
                $category = (array)$item;
                $category['total_child'] = $categories_two->count();
                $category['child'] = $categories_two->toArray();
                return $category;
            });
        $categories['total_child'] = $categories_one->count();
        $categories['child'] = $categories_one->toArray();
        return response()->json($categories);
    }
}
