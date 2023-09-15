<?php
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Breadcrumbs;

Breadcrumbs::for('category', function ($trail, $category) {
    $trail->push('Trang chủ', route('home'));
    $trail->push($category->name, route('category.show', $category));
});
