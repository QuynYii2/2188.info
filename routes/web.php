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

//Route::middleware('auth.product')->group(function () {
//    // Các tuyến đường sản phẩm ở đây
//    Route::get('/products/{id}', 'ProductController@show')->name('product.show');
//});

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
//Route::get('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'category'])->name('category.show');
Route::get('/detail/{id}', [\App\Http\Controllers\ProductController::class, 'detail_product'])->name('detail_product.show');


Route::group(['middleware' => 'role.admin'], function () {
    // Các route dành cho super admin
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    // ...
});

Route::group(['middleware' => 'role.seller'], function () {
    Route::get('/products', [\App\Http\Controllers\Seller\ProductController::class, 'index'])->name('seller.products.index');
    Route::get('/products/create', [\App\Http\Controllers\Seller\ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [\App\Http\Controllers\Seller\ProductController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{product}', [\App\Http\Controllers\Seller\ProductController::class, 'show'])->name('seller.products.show');
    Route::get('/products/{product}/edit', [\App\Http\Controllers\Seller\ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{product}', [\App\Http\Controllers\Seller\ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [\App\Http\Controllers\Seller\ProductController::class, 'destroy'])->name('seller.products.destroy');
    // Categories
    Route::get('/categories', [\App\Http\Controllers\Seller\CategoryController::class, 'index'])->name('seller.categories.index');
    Route::get('/categories/create', [\App\Http\Controllers\Seller\CategoryController::class, 'create'])->name('seller.categories.create');
    Route::post('/categories', [\App\Http\Controllers\Seller\CategoryController::class, 'store'])->name('seller.categories.store');
    Route::get('/categories/{category}/edit', [\App\Http\Controllers\Seller\CategoryController::class, 'edit'])->name('seller.products.edit');
    Route::put('/categories/{category}', [\App\Http\Controllers\Seller\CategoryController::class, 'update'])->name('seller.products.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\Seller\CategoryController::class, 'destroy'])->name('seller.products.destroy');
});

Route::group(['middleware' => 'role.buyer'], function () {
    // Các route dành cho người mua
    Route::get('/buyer/dashboard', 'BuyerController@dashboard');
    Route::get('/buyer/orders', 'BuyerController@orders');
    // ...
});
