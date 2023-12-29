<?php

use App\Http\Controllers\Admin\AdminAddressController;
use App\Http\Controllers\Admin\AdminPostRFQController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ConfigProjectController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\TopSellerConfigController;
use App\Http\Controllers\SetupMarketingController;
use Illuminate\Support\Facades\Route;

// Admin
// Route User
// Các route dành cho super admin
Route::get('/dashboard', 'AdminController@dashboard');
//User
Route::prefix('user')->group(function () {
    Route::get('/list-users', [AdminUserController::class, 'listUser'])->name('admin.list.users');
    Route::get('/detail-users/{id}', [AdminUserController::class, 'detail'])->name('admin.detail.users');
    Route::put('/edit-users/{id}', [AdminUserController::class, 'edit'])->name('admin.edit.users');
    Route::get('/private-update-users/{id}', [AdminUserController::class, 'processUpdate'])->name('admin.private.update.users');
    Route::put('/update-users/{id}', [AdminUserController::class, 'update'])->name('admin.update.users');

    Route::get('/create-users', [AdminUserController::class, 'processCreate'])->name('admin.processCreate.users');
    Route::post('/create-users', [AdminUserController::class, 'create'])->name('admin.create.users');

    Route::delete('/delete-users/{id}', [AdminUserController::class, 'delete'])->name('admin.delete.users');
    Route::get('/detail-users-company/{id}', [AdminUserController::class, 'showCompany'])->name('admin.detail.users.company');
    Route::put('/edit-users-company/{id}', [AdminUserController::class, 'updateCompany'])->name('admin.edit.users.company');
    Route::get('/search-users', [AdminUserController::class, 'searchUser'])->name('admin.search.users');
});
//    Route::post('down-permission', [\App\Http\Controllers\PermissionRankController::class, 'downRank'])->name('permission.down.rank');
// Admin Config
Route::prefix('configs')->group(function () {
    Route::get('/list', [ConfigProjectController::class, 'index'])->name('admin.configs.show');
    Route::get('/create', [ConfigProjectController::class, 'processCreate'])->name('admin.configs.processCreate');
    Route::post('/create', [ConfigProjectController::class, 'create'])->name('admin.configs.create');
    Route::get('/detail/{id}', [ConfigProjectController::class, 'detail'])->name('admin.configs.detail');
    Route::put('/update/{id}', [ConfigProjectController::class, 'update'])->name('admin.configs.update');
    Route::delete('/delete/{id}', [ConfigProjectController::class, 'delete'])->name('admin.configs.delete');
});
// Top seller config
Route::get('/seller-configs', [TopSellerConfigController::class, 'index'])->name('seller.config.show');
Route::get('/seller-config/create', [TopSellerConfigController::class, 'processCreate'])->name('seller.config.processCreate');
Route::post('/seller-config', [TopSellerConfigController::class, 'create'])->name('seller.config.create');
Route::delete('/seller-config/{id}', [TopSellerConfigController::class, 'delete'])->name('seller.config.delete');
// Admin banner
Route::get('/banners', [BannerController::class, 'index'])->name('admin.banners.show');
Route::get('/banners/create', [BannerController::class, 'processCreate'])->name('admin.banners.processCreate');
Route::post('/banners', [BannerController::class, 'create'])->name('admin.banners.create');
Route::post('/banners/{id}', [BannerController::class, 'update'])->name('admin.banners.update');
Route::delete('/banners/{id}', [BannerController::class, 'delete'])->name('admin.banners.delete');
// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('seller.categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('seller.categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('seller.categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('seller.categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('seller.categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('seller.categories.destroy');
//
Route::post('/toggle-products-all/{id}', [ProductController::class, 'toggleProduct'])->name('admin.toggle.products');
//
Route::get('/setup-marketing/', [SetupMarketingController::class, 'index'])->name('setup-marketing.show');
Route::get('/setup-marketing/create', [SetupMarketingController::class, 'create'])->name('create-setup-marketing');
Route::post('/setup-marketing/create', [SetupMarketingController::class, 'store'])->name('store-setup-marketing');
Route::delete('/setup-marketing/create/{id}', [SetupMarketingController::class, 'delete'])->name('setup-marketing.delete');
Route::get('/setup-marketing/edit/{id}', [SetupMarketingController::class, 'edit'])->name('setup-marketing.edit');
Route::post('/setup-marketing/update/{id}', [SetupMarketingController::class, 'update'])->name('setup-marketing.update');
//
Route::get('/address/list', [AdminAddressController::class, 'index'])->name('admin.address.index');
Route::get('/address/detail/{code}', [AdminAddressController::class, 'show'])->name('admin.address.show');
Route::get('/address/detail-region/{code}', [AdminAddressController::class, 'showRegion'])->name('admin.address.show.region');
Route::post('/address/modify', [AdminAddressController::class, 'modifyAddress'])->name('admin.address.modify');
Route::get('/address/get-by-id/{id}', [AdminAddressController::class, 'getById'])->name('admin.address.get.by.id');

Route::delete('/address/delete/{id}', [AdminAddressController::class, 'delete'])->name('admin.address.delete');
Route::post('/address/change-status/{id}', [AdminAddressController::class, 'changeStatus'])->name('admin.address.change.status');
Route::get('/address/change-show/{id}', [AdminAddressController::class, 'changeShow'])->name('admin.address.change.show');
/* Admin route postRFQ*/
Route::prefix('post-rfq')->group(function () {
    Route::get('/list', [AdminPostRFQController::class, 'index'])->name('admin.post.rfq.show');
    Route::get('/detail/{id}', [AdminPostRFQController::class, 'detail'])->name('admin.post.rfq.detail');
    Route::put('/update/{id}', [AdminPostRFQController::class, 'update'])->name('admin.post.rfq.update');
    Route::delete('/delete/{id}', [AdminPostRFQController::class, 'delete'])->name('admin.post.rfq.delete');
});