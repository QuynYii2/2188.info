<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('category', function ($trail, $category) {
    $trail->push('Home', route('home'));

    while ($category) {
        $trail->push($category->name, route('category.show', $category));
        $category = $category->parent;
    }
});
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->push('Home', route('home'));
    $trail->push($product->name, route('product.show', $product));
});