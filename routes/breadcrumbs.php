<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;



Breadcrumbs::for('category', function ($trail, $category) {
    switch (locationHelper()) {
        case 'kr';
            $categoryName = $category->name_ko;
        break;
        case 'cn';
            $categoryName = $category->name_zh;
        break;
        case 'jp';
            $categoryName = $category->name_ja;
        break;
        case 'vi';
            $categoryName = $category->name_vi;
        break;
    }

    $trail->push(__('home.Home'), route('homepage'));

    while ($category) {
        $trail->push($categoryName, route('category.show', $category));
        $category = $category->parent;
    }
});
Breadcrumbs::for('product', function ($trail, $product) {
    switch (locationHelper()) {
        case 'kr':
            $productName = $product->name_ko;
            $categoryName = $product->category->name_ko;
            break;
        case 'cn':
            $productName = $product->name_zh;
            $categoryName = $product->category->name_zh;
            break;
        case 'jp':
            $productName = $product->name_ja;
            $categoryName = $product->category->name_ja;
            break;
        case 'vi':
            $productName = $product->name_vi;
            $categoryName = $product->category->name_vi;
            break;
    }

    $trail->push(__('home.Home'), route('homepage'));
    $trail->push($categoryName, route('category.show', $product->category));
    $trail->push($productName, route('product.show', $product));
});
