<?php
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Breadcrumbs;

Breadcrumbs::for('product', function ($trail, $product) {
    // Thêm breadcrumb cho trang chủ
    $trail->push('Home', route('home'));

    // Thêm breadcrumb cho danh mục sản phẩm (nếu có)
    if ($product->category) {
        Breadcrumbs::for('category', function ($trail, $category) {
            while ($category) {
                $trail->push($category->name, route('category.show', $category));
                $category = $category->parent;
            }
        });
    }

    // Thêm breadcrumb cho sản phẩm
    $trail->push($product->name, route('product.show', $product));
});

