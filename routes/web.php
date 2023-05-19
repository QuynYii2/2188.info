<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');


Route::post('/register', [\App\Http\Controllers\UserController::class, 'store'])->name('register.store');

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

Route::get('/login/', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/register/', [\App\Http\Controllers\Frontend\HomeController::class, 'register'])->name('register.store');

Route::middleware('auth.product')->group(function () {
    // Các tuyến đường sản phẩm ở đây
    Route::get('/products/{id}', 'ProductController@show')->name('product.show');
});

Route::get('/info/', [\App\Http\Controllers\ProfileController::class, 'info']);
Route::get('/my-notification/', [\App\Http\Controllers\ProfileController::class, 'my_notification']);
Route::get('/order-management/', [\App\Http\Controllers\ProfileController::class, 'order_management']);
Route::get('/return-management/', [\App\Http\Controllers\ProfileController::class, 'return_management']);
Route::get('/address-book/', [\App\Http\Controllers\ProfileController::class, 'address_book']);
Route::get('/payment-information/', [\App\Http\Controllers\ProfileController::class, 'payment_information']);
Route::get('/product-evaluation/', [\App\Http\Controllers\ProfileController::class, 'product_evaluation']);
Route::get('/favorite-product/', [\App\Http\Controllers\ProfileController::class, 'favorite_product']);
Route::get('/product-viewed/', [\App\Http\Controllers\ProfileController::class, 'product_viewed']);
Route::get('/my-review/', [\App\Http\Controllers\ProfileController::class, 'my_review']);
Route::get('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'category'])->name('category.show');
Route::get('/detail/{id}', [\App\Http\Controllers\ProductController::class, 'detail_product'])->name('detail_product.show');


Route::group(['middleware' => 'role.admin'], function () {
    // Các route dành cho super admin
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    // ...
});

Route::group(['middleware' => 'role.seller'], function () {
    // Các route dành cho người bán
    Route::get('/seller/dashboard', 'SellerController@dashboard');
    Route::get('/seller/products', 'SellerController@products');
    // ...
});

Route::group(['middleware' => 'role.buyer'], function () {
    // Các route dành cho người mua
    Route::get('/buyer/dashboard', 'BuyerController@dashboard');
    Route::get('/buyer/orders', 'BuyerController@orders');
    // ...
});
