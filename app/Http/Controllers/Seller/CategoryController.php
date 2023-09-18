<?php

namespace App\Http\Controllers\Seller;

use App\Enums\CategoryStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\TranslateController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        return view('backend/categories/index', [
            'categories' => $categories
        ]);

    }

    public function create(Request $request)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        return view('backend/categories/create', [
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $validatedData = $request->validate([
                'category_name' => 'required',
                'category_parentID' => 'nullable',
            ]);

            $categoryOld = DB::table('categories')->where([
                ['name', $validatedData['category_name']],
                ['parent_id', $validatedData['category_parentID']],
                ['status', '!=', CategoryStatus::DELETED],
            ])->first();
            if ($categoryOld) {
                alert()->error('Error', 'Tên chuyên mục tồn tại');
                return back();
            }

            $slug = $request->input('category_slug');
            $name = $validatedData['category_name'];
            if (!$slug) {
                $slug = \Str::slug($name);
            }
            $ld = new TranslateController();

            $category = new Category();
            switch (locationHelper()) {
                case 'kr';
                    $category->name = $name;
                    $category->name_vi = $ld->translateText($name, 'vi');
                    $category->name_ja = $ld->translateText($name, 'ja');
                    $category->name_ko = $name;
                    $category->name_en = $ld->translateText($name, 'en');
                    $category->name_zh = $ld->translateText($name, 'zh-CN');
                    break;
                case 'cn';
                    $category->name = $name;
                    $category->name_vi = $ld->translateText($name, 'vi');
                    $category->name_ja = $ld->translateText($name, 'ja');
                    $category->name_ko = $ld->translateText($name, 'ko');
                    $category->name_en = $ld->translateText($name, 'en');
                    $category->name_zh = $name;
                    break;
                case 'jp';
                    $category->name = $name;
                    $category->name_vi = $ld->translateText($name, 'vi');
                    $category->name_ja = $name;
                    $category->name_ko = $ld->translateText($name, 'ko');
                    $category->name_en = $ld->translateText($name, 'en');
                    $category->name_zh = $ld->translateText($name, 'zh-CN');
                    break;
                case 'vi';
                    $category->name = $name;
                    $category->name_vi = $name;
                    $category->name_ja = $ld->translateText($name, 'ja');
                    $category->name_ko = $ld->translateText($name, 'ko');
                    $category->name_en = $ld->translateText($name, 'en');
                    $category->name_zh = $ld->translateText($name, 'zh-CN');
                    break;
            }

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
                return redirect()->route('seller.categories.index');
            }
            alert()->error('Error', 'Tạo mới không thành công.');
            return back();

        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }


    public function show(Category $request, $category)
    {
        (new HomeController())->getLocale($request);
        return view('backend/categories/edit', compact('category'));
    }


    public function edit(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        $category = Category::find($id);
        if (!$category) {
            return back();
        }
        return view('backend/categories/edit', compact('category', 'categories'));
    }


    public function update(Request $request, $id)
    {
        (new HomeController())->getLocale($request);

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

            if ($category->name != $name) {
                $categoryOld = DB::table('categories')->where([
                    ['name', $validatedData['category_name']],
                    ['parent_id', $validatedData['category_parentID']]
                ])->first();

                if ($categoryOld) {
                    alert()->error('Error', 'Tên chuyên mục tồn tại');
                    return back();
                }
            }

            $category->name = $name;
            $category->slug = $slug;
            $category->description = $request->input('category_description');


            $ld = new TranslateController();

            $category->name_vi = $ld->translateText($name, 'vi');
            $category->name_ja = $ld->translateText($name, 'ja');
            $category->name_ko = $ld->translateText($name, 'ko');
            $category->name_en = $ld->translateText($name, 'en');
            $category->name_zh = $ld->translateText($name, 'zh-CN');

            if (!$validatedData['category_parentID']) {
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
                return redirect()->route('seller.categories.index');
            }
            alert()->error('Error', 'Cập nhật không thành công.');
            return redirect()->route('seller.categories.index');
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }


    public function destroy(Request $request, $id)
    {
        (new HomeController())->getLocale($request);
        try {
            $category = Category::find($id);
            if (!$category) {
                return back();
            }
            $isAdmin = (new HomeController())->checkAdmin();
            if ($isAdmin == false) {
                if ($category->user_id != Auth::user()->id) {
                    alert()->error('Error', 'Không thể xoá, Vui lòng thử lại');
                    return redirect()->route('seller.categories.index');
                }
            }
            $category->status = CategoryStatus::DELETED;
            $categories = Category::where('parent_id', $id)->get();
            $category->save();
            foreach ($categories as $item) {
                $item = Category::where('parent_id', $id)->get();
                $item->save();
            }
            alert()->success('Success', 'Category đã được xóa thành công!');
            return redirect()->route('seller.categories.index');
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }
}
