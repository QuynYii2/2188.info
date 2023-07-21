<?php

namespace App\Http\Controllers\Backend_v2;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController_v2 extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('backend-v2.categories.index', compact('categories'));

    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_name' => 'required',
                'category_parentID' => 'nullable',
            ]);

            $categoryOld = DB::table('categories')->where([['name', $validatedData['category_name']], ['parent_id', $validatedData['category_parentID']]])->first();
            if ($categoryOld) {
                alert()->error('Error', 'Tên chuyên mục tồn tại');
                return back();
            }

            $slug = $request->input('category_slug');
            $name = $validatedData['category_name'];
            if (!$slug) {
                $slug = \Str::slug($name);
            }

            $category = new Category();
            $category->name = $name;
            $category->user_id = Auth::user()->id;
            $category->slug = $slug;
            $category->description = $request->input('category_description');

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailPath = $thumbnail->store('categories', 'public');
                $category->thumbnail = $thumbnailPath;
            }

            if ($validatedData['category_parentID']) {
                $parentCategory = Category::find($validatedData['category_parentID']);
                if ($parentCategory) {
                    $updateCategory = $category->appendToNode($parentCategory)->save();
                } else {
                    $updateCategory = $category->saveAsRoot();
                }
            } else {
                $updateCategory = $category->saveAsRoot();
            }

            if ($updateCategory) {
                alert()->success('Success', 'Tạo mới chuyên mục thành công');
                return redirect()->route('categories.v2.show');
            }
            alert()->error('Error', 'Tạo mới không thành công.');
            return back();

        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return back();
        }
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('backend-v2.categories.detail', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return back();
            }

            $validatedData = $request->validate([
                'category_name' => 'required',
                'category_parentID' => 'nullable',
            ]);

            $slug = $request->input('category_slug');
            $name = $validatedData['category_name'];
            if (!$slug) {
                $slug = \Str::slug($name);
            }

            $categoryOld = DB::table('categories')->where([
                ['name', $validatedData['category_name']],
                ['parent_id', $validatedData['category_parentID']]
            ])->first();

            if ($categoryOld) {
                alert()->error('Error', 'Tên chuyên mục tồn tại');
                return back();
            }

            $category->name = $name;
            $category->slug = $slug;
            $category->description = $request->input('category_description');

            if (!$validatedData['category_parentID']){
                $category->parent_id = $validatedData['category_parentID'];
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailPath = $thumbnail->store('categories', 'public');
                $category->thumbnail = $thumbnailPath;
            }

            $updateCategory = $category->save();

            if ($updateCategory) {
                alert()->success('Success', 'Category đã được cập nhật thành công!');
                return redirect()->route('categories.v2.show');
            }
            alert()->error('Error', 'Cập nhật không thành công.');
            return redirect()->route('categories.v2.show');
        } catch (\Exception $exception) {
            dd($exception);
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return back();
            }
            if ($category->user_id != Auth::user()->id) {
                alert()->error('Error', 'Không thể xoá, Vui lòng thử lại');
                return redirect()->route('seller.categories.index');
            }
            $category->delete();
            alert()->success('Success', 'Category đã được xóa thành công!');
            return redirect()->route('categories.v2.show');
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }
}
