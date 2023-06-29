<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend/categories/index', [
            'categories' => $categories
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend/categories/create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = new Category();
        $category->name = $validatedData['name'];

        if ($validatedData['parent_id']) {
            $parentCategory = Category::find($validatedData['parent_id']);
            $category->appendToNode($parentCategory)->save();
        } else {
            $category->saveAsRoot();
        }
        alert()->success('Success', 'Tạo mới địa chỉ thành công');

        return redirect()->route('seller.categories.index')->with('success', 'Danh mục đã được tạo thành công.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('backend/categories/edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('backend/categories/edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category )
    {
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $updateCategory = $category->save();
        alert()->success('Success', 'Tạo mới địa chỉ thành công');

        if ($updateCategory) {
            $request->session()->flash('success_update_cat', 'Cập nhật thành công.');
            return redirect()->route('seller.categories.index')->with('success', 'Category đã được cập nhật thành công!');
        } else{
            $request->session()->flash('error_update_cat', 'Cập nhật không thành công.');
            return redirect()->route('seller.categories.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('seller.categories.index')->with('success', 'Category đã được xóa thành công!');
    }
}
