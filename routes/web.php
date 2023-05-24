<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/product/{id}', 'ProductController@show')->name('product.show');
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

// Đánh giá sản phẩm
Route::post('/evaluate', [\App\Http\Controllers\EvaluateProductController::class, 'store'])->name('create.evaluate');


Route::group(['middleware' => 'role.admin'], function () {
    // Các route dành cho super admin
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    // ...
});

Route::group(['middleware' => 'role.seller'], function () {

    Route::get('/attributes', [\App\Http\Controllers\Seller\AttributeController::class, 'index'])->name('attributes.index');

    Route::get('/attributes/create', [\App\Http\Controllers\Seller\AttributeController::class, 'create'])->name('attributes.create');
    Route::post('/attributes', [\App\Http\Controllers\Seller\AttributeController::class, 'store'])->name('attributes.store');

    Route::get('/variations/create', [\App\Http\Controllers\Seller\VariationController::class, 'create'])->name('variations.create');
    Route::post('/variations', [\App\Http\Controllers\Seller\VariationController::class, 'store'])->name('variations.store');


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
    Route::get('/categories/{category}/edit', [\App\Http\Controllers\Seller\CategoryController::class, 'edit'])->name('seller.categories.edit');
    Route::put('/categories/{category}', [\App\Http\Controllers\Seller\CategoryController::class, 'update'])->name('seller.categories.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\Seller\CategoryController::class, 'destroy'])->name('seller.categories.destroy');
    // Evaluate Product
    Route::get('/evaluates', [\App\Http\Controllers\Seller\SellerEvaluateProductController::class, 'index'])->name('seller.evaluates.index');
    Route::get('/evaluates/{id}', [\App\Http\Controllers\Seller\SellerEvaluateProductController::class, 'detail'])->name('seller.evaluates.detail');
    Route::put('/evaluates/{id}', [\App\Http\Controllers\Seller\SellerEvaluateProductController::class, 'update'])->name('seller.evaluates.update');
    Route::delete('/evaluates/{id}', [\App\Http\Controllers\Seller\SellerEvaluateProductController::class, 'delete'])->name('seller.evaluates.delete');
});

Route::group(['middleware' => 'role.buyer'], function () {
    // Các route dành cho người mua
    Route::get('/buyer/dashboard', 'BuyerController@dashboard');
    Route::get('/buyer/orders', 'BuyerController@orders');
    // ...
});

// Cart
Route::get('/cart', [\App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{product}', [\App\Http\Controllers\Frontend\CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/{id}', [\App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [\App\Http\Controllers\Frontend\CartController::class, 'delete'])->name('cart.delete');
Route::delete('/cart-clear', [\App\Http\Controllers\Frontend\CartController::class, 'clearCart'])->name('cart.clear');
//Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');