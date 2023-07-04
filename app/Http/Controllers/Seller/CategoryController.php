<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('backend/categories/index', [
            'categories' => $categories
        ]);

    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('backend/categories/create', [
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $name = DB::table('categories')->where('name', $validatedData['name'])->first();
        if ($name) {
            alert()->error('Error', 'Tên chuyên mục tồn tại');
            return back();
        }

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->user_id = Auth::user()->id;

        if ($validatedData['parent_id']) {
            $parentCategory = Category::find($validatedData['parent_id']);
            $category->appendToNode($parentCategory)->save();
        } else {
            $category->saveAsRoot();
        }
        alert()->success('Success', 'Tạo mới chuyên mục thành công');

        return redirect()->route('seller.categories.index')->with('success', 'Danh mục đã được tạo thành công.');
    }


    public function show(Category $category)
    {
        return view('backend/categories/edit', compact('category'));
    }


    public function edit(Category $category)
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('backend/categories/edit', compact('category', 'categories'));
    }


    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $updateCategory = $category->save();
        alert()->success('Success', 'Category đã được cập nhật thành công!');

        if ($updateCategory) {
            $request->session()->flash('success_update_cat', 'Cập nhật thành công.');
            return redirect()->route('seller.categories.index')->with('success', 'Category đã được cập nhật thành công!');
        } else {
            $request->session()->flash('error_update_cat', 'Cập nhật không thành công.');
            return redirect()->route('seller.categories.edit');
        }
    }


    public function destroy(Category $category)
    {
        if ($category->user_id != Auth::user()->id) {
            alert()->error('Error', 'Không thể xoá, Vui lòng thử lại');
            return redirect()->route('seller.categories.index');
        }
        $category->delete();
        alert()->success('Success', 'Category đã được xóa thành công!');
        return redirect()->route('seller.categories.index')->with('success', 'Category đã được xóa thành công!');
    }
}
