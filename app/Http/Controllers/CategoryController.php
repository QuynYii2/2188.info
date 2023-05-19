<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get()->toTree();

        return view('frontend.categories.index', compact('categories'));
    }

    public function category() {
        return view('frontend/pages/category');
    }
}
