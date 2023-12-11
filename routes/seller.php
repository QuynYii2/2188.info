<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Member\RegisterMemberSuccessController;
use App\Http\Controllers\MemberPartnerController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RevenusController;
use App\Http\Controllers\Seller\AttributeController;
use App\Http\Controllers\Seller\ExportFileController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\PropertiesController;
use App\Http\Controllers\Seller\RankUserSellerController;
use App\Http\Controllers\Seller\SellerEvaluateProductController;
use App\Http\Controllers\Seller\SettingShopController;
use App\Http\Controllers\Seller\StaffController;
use App\Http\Controllers\Seller\StorageController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\StatisticShopController;
use App\Http\Controllers\VoucherController;

// Seller
//Setting shop
Route::get('/setting-shop', [SettingShopController::class, 'index'])->name('setting.shop.index');
Route::get('/profile-shop', [SettingShopController::class, 'profileShop'])->name('profile.shop.index');
Route::post('/profile-shop/update', [SettingShopController::class, 'updateProfileShop'])->name('profile.shop.update');
Route::post('/profile-shop/store', [SettingShopController::class, 'saveProfileShop'])->name('profile.shop.store');
Route::post('/setting-shop/pm', [SettingShopController::class, 'savePaymentMethod'])->name('setting.shop.payment.save');
Route::post('/setting-shop/tm', [SettingShopController::class, 'saveTransportMethod'])->name('setting.shop.transport.save');

Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes.index');
//
Route::get('/attributes/create', [AttributeController::class, 'create'])->name('attributes.create');
Route::get('/attributes/edit', [AttributeController::class, 'edit'])->name('attributes.edit');
Route::post('/attributes', [AttributeController::class, 'store'])->name('attributes.store');
//
Route::get('/attributes/{id}', [AttributeController::class, 'show'])->name('attributes.detail');
Route::post('/attributes/{id}', [AttributeController::class, 'update'])->name('attributes.update');
Route::post('/delete-attributes/{id}', [AttributeController::class, 'destroy'])->name('attributes.delete');
Route::post('/toggle-attributes/{id}', [AttributeController::class, 'toggle'])->name('attributes.toggle');
//
//
Route::get('/attributes/properties/{attributeID}', [PropertiesController::class, 'index'])->name('properties.index');
Route::get('/properties/create', [PropertiesController::class, 'create'])->name('properties.create');
Route::post('/properties', [PropertiesController::class, 'store'])->name('properties.store');
//
Route::get('/properties/{id}', [PropertiesController::class, 'show'])->name('properties.detail');
Route::post('/properties/{id}', [PropertiesController::class, 'update'])->name('properties.update');
Route::post('/delete-properties/{id}', [PropertiesController::class, 'destroy'])->name('properties.delete');
Route::post('/toggle-properties/{id}', [PropertiesController::class, 'toggle'])->name('properties.toggle');
//
Route::get('/products', [ProductController::class, 'index'])->name('seller.products.index');
Route::get('/products-search', [ProductController::class, 'search'])->name('seller.products.search');
Route::get('/products_home', [ProductController::class, 'home'])->name('seller.products.home');
Route::get('/list/products-views', [ProductController::class, 'getProductsViews'])->name('seller.products.views');
Route::post('/filter/products-views', [ProductController::class, 'getProductsViews'])->name('seller.products.views.filter');
Route::get('/products/create', [ProductController::class, 'create'])->name('seller.products.create');
Route::post('/products', [ProductController::class, 'store'])->name('seller.products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('seller.products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
Route::post('/products/{product}', [ProductController::class, 'update'])->name('seller.products.update');
// Add, remove hot and feature product
Route::post('/toggle-products-hot/{id}', [ProductController::class, 'setHotProduct'])->name('seller.products.hot');
Route::post('/toggle-products-feature/{id}', [ProductController::class, 'setFeatureProduct'])->name('seller.products.feature');
// End
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');
//Revenue
Route::get('/revenues', [RevenusController::class, 'index'])->name('revenues.index');
Route::post('/revenues', [RevenusController::class, 'index'])->name('revenues.filter');
Route::get('/revenue/export-excel', [ExportFileController::class, 'exportExcelRevenue'])->name('revenues.excel');

// Evaluate Product
Route::get('/evaluates', [SellerEvaluateProductController::class, 'index'])->name('seller.evaluates.index');
Route::get('/evaluates/{id}', [SellerEvaluateProductController::class, 'detail'])->name('seller.evaluates.detail');
Route::put('/evaluates/{id}', [SellerEvaluateProductController::class, 'update'])->name('seller.evaluates.update');
Route::delete('/evaluates/{id}', [SellerEvaluateProductController::class, 'delete'])->name('seller.evaluates.delete');

// Voucher
Route::get('/vouchers', [VoucherController::class, 'getListSeller'])->name('seller.vouchers.list');
Route::get('/process-vouchers', [VoucherController::class, 'processCreate'])->name('seller.vouchers.create.process');
Route::post('/vouchers', [VoucherController::class, 'create'])->name('seller.vouchers.create');
Route::get('/vouchers/{id}', [VoucherController::class, 'detail'])->name('seller.vouchers.detail');
Route::post('/vouchers/{id}', [VoucherController::class, 'update'])->name('seller.vouchers.update');
Route::delete('/vouchers/{id}', [VoucherController::class, 'delete'])->name('seller.vouchers.delete');
// Voucher
Route::get('/promotions', [PromotionController::class, 'getList'])->name('seller.promotion.list');
Route::get('/process-promotion', [PromotionController::class, 'processCreate'])->name('seller.promotion.create.process');
Route::post('/promotion', [PromotionController::class, 'create'])->name('seller.promotion.create');
Route::get('/promotion/{id}', [PromotionController::class, 'detail'])->name('seller.promotion.detail');
Route::post('/promotion/{id}', [PromotionController::class, 'update'])->name('seller.promotion.update');
Route::delete('/promotion/{id}', [PromotionController::class, 'delete'])->name('seller.promotion.delete');
//quản lý tài khoản
Route::get('/account-manage', [AccountController::class, 'index'])->name('account.manage.show');
Route::get('/account-manage/lock/{id}', [AccountController::class, 'update'])->name('account.lock');
Route::get('/account-manage/delete/{id}', [AccountController::class, 'destroy'])->name('account.delete');
Route::get('/account-manage/view/{id}', [AccountController::class, 'show'])->name('account.show.shop');
Route::get('/account-manage/view-cart/{id}', [AccountController::class, 'viewCart'])->name('account.show.order');

//quản lý tài khoản cấp dưới
Route::get('/staff-manage', [StaffController::class, 'index'])->name('staff.manage.show');
Route::get('/staff-manage/create', [StaffController::class, 'create'])->name('staff.manage.create');
Route::get('/staff-manage/edit/{id}', [StaffController::class, 'edit'])->name('staff.manage.edit');
Route::post('/staff-manage/update/{id}', [StaffController::class, 'update'])->name('staff.manage.update');
Route::post('/staff-manage/store', [StaffController::class, 'store'])->name('staff.manage.store');
Route::get('/staff-manage/delete/{id}', [StaffController::class, 'destroy'])->name('staff.manage.delete');

//Quản lý kho hàng
Route::get('/storage-manage-user', [StorageController::class, 'index'])->name('storage.manage.show.user');
Route::get('/storage-manage-all', [StorageController::class, 'allStorage'])->name('storage.manage.show.all');
Route::get('/storage-manage/create', [StorageController::class, 'create'])->name('storage.manage.create');
Route::get('/storage-manage/edit/{id}', [StorageController::class, 'edit'])->name('storage.manage.edit');
Route::post('/storage-manage/update/{id}', [StorageController::class, 'update'])->name('storage.manage.update');
Route::post('/storage-manage/store', [StorageController::class, 'store'])->name('storage.manage.store');
Route::get('/storage-manage/search', [StorageController::class, 'searchStorage'])->name('storage.manage.search');
Route::post('/warehouse-export-excel', [ExportFileController::class, 'exportExcel'])->name('storage.manage.export.excel');
//Route::get('/export-pdf', [ExportFileController::class, 'exportToPDF'])->name('storage.manage.export.pdf');

// Rank setup
Route::get('/rank-setups', [RankUserSellerController::class, 'index'])->name('seller.rank.setup.show');
Route::get('/rank-setups/create', [RankUserSellerController::class, 'processCreate'])->name('seller.rank.setup.processCreate');
Route::post('/rank-setup', [RankUserSellerController::class, 'create'])->name('seller.rank.setup.create');
Route::get('/rank-setup/{id}', [RankUserSellerController::class, 'detail'])->name('seller.rank.setup.detail');
Route::post('/rank-setup/{id}', [RankUserSellerController::class, 'update'])->name('seller.rank.setup.update');
Route::delete('/rank-delete/{id}', [RankUserSellerController::class, 'delete'])->name('seller.rank.setup.delete');
// Setup
Route::get('/seller-setups', [RankUserSellerController::class, 'indexSetup'])->name('seller.setup.show');
Route::get('/seller-setups/create', [RankUserSellerController::class, 'processSetupCreate'])->name('seller.setup.processCreate');
Route::post('/seller-setup', [RankUserSellerController::class, 'createSetup'])->name('seller.setup.create');
Route::get('/seller-setup/{id}', [RankUserSellerController::class, 'detailSetup'])->name('seller.setup.detail');
Route::post('/seller-setup/{id}', [RankUserSellerController::class, 'updateSetUp'])->name('seller.setup.update');
// Order
Route::get('/order-managers', [OrderController::class, 'index'])->name('seller.order.list');
Route::get('/order-managers-search', [OrderController::class, 'search'])->name('seller.search.order.list');
Route::get('/order-managers/{id}', [OrderController::class, 'detail'])->name('seller.order.detail');
Route::post('/export-excel', [ExportFileController::class, 'exportExcelOrder'])->name('order.manage.export.excel');
Route::post('/export-excel-detail', [ExportFileController::class, 'exportExcelOrderDetail'])->name('order.manage.export.excel.detail');
// Statistic
Route::get('/statistic-access', [StatisticController::class, 'getStatisticAccess'])->name('admin.statistic.access');
Route::get('/statistic-revenues', [StatisticController::class, 'getStatisticRevenue'])->name('admin.statistic.revenues');
Route::get('/statistic-users', [StatisticController::class, 'getStatisticUser'])->name('admin.statistic.users');
Route::get('/statistic-shop', [StatisticShopController::class, 'getStatisticShops'])->name('shop.statistic.index');
// Product Shop
Route::get('/list-products-shop', [\App\Http\Controllers\ProductController::class, 'getListProductShop'])->name('shop.list.products');
// Register member
//    Route::get('/products-register-member', [RegisterMemberSuccessController::class, 'index'])->name('products.register.member.index');
Route::get('/stands-register-member/{id}', [RegisterMemberSuccessController::class, 'memberStand'])->name('stand.register.member.index');
Route::get('/staff-member-info/{memberId}', [RegisterMemberSuccessController::class, 'staffInfo'])->name('staff.member.info');

Route::get('/parents-register-member', [RegisterMemberSuccessController::class, 'memberPartner'])->name('partner.register.member.index');
Route::get('/parents-register-member/{locale}', [RegisterMemberSuccessController::class, 'memberPartnerLocale'])->name('parent.register.member.locale');
Route::post('/products-register-member', [RegisterMemberSuccessController::class, 'saveProduct'])->name('products.register.member.create');
Route::post('/add-to-cart-register-member/{product}', [CartController::class, 'addToCartApi'])->name('cart.api');
Route::post('/stands-register-member', [MemberPartnerController::class, 'store'])->name('stands.register.member');
Route::post('/stands-unregister-member/{id}', [MemberPartnerController::class, 'delete'])->name('stands.unregister.member');
//
Route::post('/product-viewed', [\App\Http\Controllers\ProductController::class, 'productViewed'])->name('product.viewed');
Route::post('/vouchers-item', [VoucherController::class, 'createVoucherItems'])->name('vouchers.item.create');
Route::post('/promotions-item', [PromotionController::class, 'createPromotionItems'])->name('promotions.item.create');
Route::get('/promotion', [PromotionController::class, 'index'])->name('promotions.index');
Route::post('/add-cart/{product}/{percent}', [CartController::class, 'addToCartPromotion'])->name('cart.add.promotion');

// Property
Route::get('/get-property-by-attribute/{id}', [AttributeController::class, 'getPropertyByAttribute'])->name('get.property.by.attribute');
Route::get('/get-all-attribute', [AttributeController::class, 'getAllAttribute'])->name('get.all.attribute');
Route::get('/call-attribute', [AttributeController::class, 'callAttribute'])->name('call.attribute');
Route::post('/create-attribute', [AttributeController::class, 'storeAttribute'])->name('create.attribute');
Route::post('/create-property', [AttributeController::class, 'storeProperty'])->name('create.property');
Route::post('/create-product-attribute', [ProductController::class, 'saveAttribute'])->name('product.create.attribute');

//Register More Category
//Route::get('/categories/register_process', [\App\Http\Controllers\RegisterCategoryController::class, 'registerProcess'])->name('categories.register.process');
Route::get('/categories/register_process', [\App\Http\Controllers\RegisterCategoryController::class, 'index'])->name('categories.register.process');
Route::get('products/categories/register/{id}', [\App\Http\Controllers\RegisterCategoryController::class, 'registerCategory'])->name('categories.register');
