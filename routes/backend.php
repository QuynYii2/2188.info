<?php

use App\Http\Controllers\Backend_v2\AttributesController_v2;
use App\Http\Controllers\Backend_v2\CategoriesController_v2;
use App\Http\Controllers\Backend_v2\CommentsController_v2;
use App\Http\Controllers\Backend_v2\ProductController_v2;
use App\Http\Controllers\Backend_v2\PropertyController_v2;

// Product
Route::prefix('products')->group(function () {
    Route::get('/index-v2', [ProductController_v2::class, 'index'])->name('product.v2.show');
    Route::get('/edit-v2', [ProductController_v2::class, 'edit'])->name('product.v2.edit');
    Route::get('/create-v2', [ProductController_v2::class, 'create'])->name('product.v2.create');
    Route::get('/index-v2', [ProductController_v2::class, 'index'])->name('product.v2.show');
});

// Categories
Route::prefix('categories')->group(function () {
    Route::get('/index-v2', [CategoriesController_v2::class, 'index'])->name('categories.v2.show');
    Route::get('/edit-v2', [CategoriesController_v2::class, 'edit'])->name('categories.v2.edit');
    Route::get('/create-v2', [CategoriesController_v2::class, 'create'])->name('categories.v2.create');
});

// Attributes
Route::prefix('attributes')->group(function () {
    Route::get('/index-v2', [AttributesController_v2::class, 'index'])->name('attributes.v2.show');
    Route::get('/detail-v2/{id}', [AttributesController_v2::class, 'edit'])->name('attributes.v2.edit');
    Route::post('/create-v2', [AttributesController_v2::class, 'store'])->name('attributes.v2.create');
    Route::post('/update-v2/{id}', [AttributesController_v2::class, 'update'])->name('attributes.v2.update');
    Route::post('/delete-v2/{id}', [AttributesController_v2::class, 'delete'])->name('attributes.v2.delete');
});

// Properties
Route::prefix('properties')->group(function () {
    Route::get('/index-v2/{attributeID}', [PropertyController_v2::class, 'index'])->name('properties.v2.show');
    Route::get('/detail-v2/{id}', [PropertyController_v2::class, 'show'])->name('properties.v2.edit');
    Route::post('/create-v2', [PropertyController_v2::class, 'store'])->name('properties.v2.create');
    Route::post('/update-v2/{id}', [PropertyController_v2::class, 'update'])->name('properties.v2.update');
    Route::post('/delete-v2/{id}', [PropertyController_v2::class, 'destroy'])->name('properties.v2.delete');
});

// Comments
Route::prefix('comments')->group(function () {
    Route::get('/index-v2', [CommentsController_v2::class, 'index'])->name('comments.v2.show');
});