<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ConfigProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\EvaluateProductController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Member\RegisterMemberController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\PermissionRankController;
use App\Http\Controllers\ProductInterestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RevenusController;
use App\Http\Controllers\Seller\AttributeController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\ExportFileController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\PropertiesController;
use App\Http\Controllers\Seller\RankUserSellerController;
use App\Http\Controllers\Seller\SellerEvaluateProductController;
use App\Http\Controllers\Seller\SettingShopController;
use App\Http\Controllers\Seller\StaffController;
use App\Http\Controllers\Seller\StorageController;
use App\Http\Controllers\Seller\TopSellerConfigController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\StatisticShopController;
use App\Http\Controllers\UpdateRankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
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

Route::get('/set-locale/{locale}', [HomeController::class, 'setLocale'])->name('app.set.locale');

Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login/{locale}', [AuthController::class, 'showLoginForm'])->name('login.local');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
//

// Google Sign In
Route::get('/login-google', [AuthController::class, 'getGoogleSignInUrl'])->name('login.google');
Route::post('/login-google', [AuthController::class, 'getGoogleSignInUrl'])->name('login.google.post');
Route::get('/callback', [AuthController::class, 'loginCallback'])->name('login.google.callback');
// Facebook Sign In
Route::get('/login-facebook', [SocialController::class, 'getFacebookSignInUrl'])->name('login.facebook');
Route::post('/login-facebook', [SocialController::class, 'getFacebookSignInUrl'])->name('login.facebook.post');
Route::get('/callback/facebook', [SocialController::class, 'callback'])->name('login.facebook.callback');
// Kakao sign in
Route::get('/login-kakaotalk', [SocialController::class, 'getKakaoSignUrl'])->name('login.kakaotalk');
Route::post('/login-kakaotalk', [SocialController::class, 'getFacebookSignInUrl'])->name('login.kakaotalk.post');
Route::get('/callback/kakaotalk', [SocialController::class, 'callbackKakaotalk'])->name('login.kakaotalk.callback');
//
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register/', [HomeController::class, 'register'])->name('register.show');
Route::post('/file/img/store', [FileController::class, 'saveImgByUser'])->name('file.img.save');
Route::get('/file/img/get', [FileController::class, 'getListImgByUser'])->name('file.img.get');


// Start register member
Route::get(
    '/register-member',
    [AuthController::class, 'processRegisterMember']
)->name('process.register.member');
Route::get(
    '/register-member/{registerMember}',
    [AuthController::class, 'showRegisterMember']
)->name('show.register.member');
Route::get(
    '/register-member-info/{registerMember}',
    [AuthController::class, 'showRegisterMemberInfo']
)->name('show.register.member.info');
Route::get(
    '/register-member-person-source/{member_id}/{registerMember}',
    [AuthController::class, 'showRegisterMemberPerson']
)->name('show.register.member.person.source');
Route::get(
    '/verify-register-member-person-source/{email}',
    [AuthController::class, 'processVerifyEmail']
)->name('show.verify.register.member');
Route::get(
    '/register-member-person-source-represent/{person_id}/{registerMember}',
    [AuthController::class, 'showRegisterMemberPersonRepresent']
)->name('show.register.member.person.represent');
Route::get(
    '/payment-register-member/{registerMember}',
    [AuthController::class, 'showPaymentMember']
)->name('show.payment.member');
Route::get(
    '/payment-register-member-success/{registerMember}',
    [AuthController::class, 'successRegisterMember']
)->name('show.success.payment.member');
//Route::get('/register-member/{registerMember}', [AuthController::class, 'showRegisterMember'])->name('show.register.member');
Route::post(
    '/register-member-info',
    [AuthController::class, 'registerMemberInfo']
)->name('register.member.info');
Route::post(
    '/register-member-source',
    [AuthController::class, 'registerMemberPerson']
)->name('register.member.source');
Route::post(
    '/verify-register-member-person-source',
    [AuthController::class, 'verifyEmail']
)->name('verify.register.member');
Route::post(
    '/register-member-person-source-represent',
    [AuthController::class, 'registerMemberPersonRepresent']
)->name('register.member.represent');
Route::post(
    '/payment-register-member',
    [AuthController::class, 'paymentMember']
)->name('payment.member');

Route::get('/location-nation', [AuthController::class, 'getListNation'])->name('location.nation.get');
Route::get('/location-state/{id}', [AuthController::class, 'getListStateByNation'])->name('location.state.get');
Route::get('/location-city/{id}/{code}', [AuthController::class, 'getListCityByState'])->name('location.city.get');
Route::get('/location-ward/{id}/{code}', [AuthController::class, 'getListWardByCity'])->name('location.ward.get');

// End register member

Route::middleware('auth.product')->group(function () {
    // Các tuyến đường sản phẩm ở đây
    Route::get('/product/{id}', 'ProductController@show')->name('product.show');
});

//
Route::post('/insert-multil-user', [HomeController::class, 'createMultilNewUser'])->name('insert.multil.user');

Route::get('/product-detail/{id}', [\App\Http\Controllers\ProductController::class, 'detail_product'])->name('detail_product.show');
Route::get('/shop/information/{id}', [\App\Http\Controllers\ShopInformationController::class, 'index'])->name('shop.information.show');
Route::get('/shop/product/{id}', [\App\Http\Controllers\ShopInformationController::class, 'index'])->name('shop.product.show');
Route::post('/shop/product/filter/{id}', [\App\Http\Controllers\ShopInformationController::class, 'filterProductBySeller'])->name('shop.product.filter');
Route::get('/product/detail/{slug}', [\App\Http\Controllers\ProductController::class, 'findBySlug'])->name('find.by.slug.product');
Route::get('/detail-product/{id}', [\App\Http\Controllers\ProductController::class, 'detailProduct'])->name('detail_product.api');
Route::get('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'category'])->name('category.show');
Route::post('/category/filter/{id}', [\App\Http\Controllers\CategoryController::class, 'filterInCategory'])->name('category.filter');
// Products by location
Route::get('/products/location/{locale}', [\App\Http\Controllers\ProductController::class, 'listProductsByLanguage'])->name('list.products.show.location');
// Config
Route::get('/products-shop/{id}', [\App\Http\Controllers\Frontend\ProductController::class, 'getListByShops'])->name('list.products.shop.show');
Route::get('/products-shop-category/{category}/{shop}', [\App\Http\Controllers\Frontend\ProductController::class, 'getListByCategoryAndShops'])->name('list.products.shop.category.show');

Route::middleware(['auth'])->group(function () {
    //View member
    Route::get('/member-registered', [UpdateRankController::class, 'detail'])->name('member.registered.detail');
    Route::post('/member-registered', [UpdateRankController::class, 'updateMember'])->name('member.registered.update');
    //
    Route::get('/info/', [ProfileController::class, 'info'])->name('profile.show');
//    Route::get('/my-notification/', [\App\Http\Controllers\ProfileController::class, 'my_notification']);
//    Route::get('/order-management/', [\App\Http\Controllers\ProfileController::class, 'order_management']);
    Route::get('/return-management/', [ProfileController::class, 'return_management']);
//    Route::get('/address-book/', [\App\Http\Controllers\ProfileController::class, 'address_book']);
    Route::get('/payment-information/', [ProfileController::class, 'payment_information']);
    Route::get('/product-evaluation/', [ProfileController::class, 'product_evaluation']);
    Route::get('/favorite-product/', [ProfileController::class, 'favorite_product']);
    Route::get('/product-viewed/', [ProfileController::class, 'product_viewed']);
    Route::get('/my-review/', [ProfileController::class, 'my_review']);
    // Đánh giá sản phẩm
    Route::post('/evaluate', [EvaluateProductController::class, 'store'])->name('create.evaluate');
    // Address Controller
    Route::get('/address-book', [AddressController::class, 'index'])->name('address.show');
    Route::post('/address', [AddressController::class, 'store'])->name('address.create');
    Route::get('/address/delete/{id}', [AddressController::class, 'destroy'])->name('address.delete');
    Route::post('/address-update/{id}', [AddressController::class, 'update'])->name('address.update');
//    Route::get('/address', [\App\Http\Controllers\Frontend\AddressController::class, 'index']);
    // Permission
    Route::get('/permission-user', [PermissionRankController::class, 'index'])->name('permission.user.show');
    Route::get('/permission-list', [PermissionRankController::class, 'list'])->name('permission.list.show');
    Route::post('/permission', [PermissionRankController::class, 'store'])->name('permission.create');
    Route::post('/delete-payment/{id}', [PermissionRankController::class, 'deletePermission'])->name('permission.delete');
    //
    Route::get('create-transaction', [PaypalPaymentController::class, 'createTransaction'])->name('createTransaction');
//    Route::post('update-permission', [\App\Http\Controllers\PermissionRankController::class, 'updateRank'])->name('permission.update.rank');
//    Route::post('down-permission', [\App\Http\Controllers\PermissionRankController::class, 'downRank'])->name('permission.down.rank');
    Route::post('payment', [PaypalPaymentController::class, 'processTransaction'])->name('create.payment');
    Route::get('get-payment', [PaypalPaymentController::class, 'index'])->name('payment.show');
    //
    Route::get('process-transaction', [PaypalPaymentController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [PaypalPaymentController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PaypalPaymentController::class, 'cancelTransaction'])->name('cancelTransaction');
    //
    Route::get('/my-notification/', [\App\Http\Controllers\Frontend\NotificationController::class, 'index'])->name('notification.show');
    Route::post('/all-notification/', [\App\Http\Controllers\Frontend\NotificationController::class, 'checkAll'])->name('notification.checkAll');
    Route::post('/delete-notification/{id}', [\App\Http\Controllers\Frontend\NotificationController::class, 'delete'])->name('notification.delete');
    //
    Route::get('/buy-coin', [CoinController::class, 'index'])->name('buy.coin.show');
    Route::post('/buy-coin', [CoinController::class, 'store'])->name('buy.coin.create');
//    Route::get('/buy-coin-success?price={price}&quantity={quantity}', [\App\Http\Controllers\CoinController::class, 'successPayment'])->name('buy.coin.success');
    Route::get('/buy-coin-success/{price}/{quantity}', [CoinController::class, 'successPayment'])->name('buy.coin.success');
    // thông tin cá nhân
    Route::post('change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('change-email', [UserController::class, 'changeEmail'])->name('user.changeEmail');
    Route::post('change-phone-number', [UserController::class, 'changePhoneNumber'])->name('user.changePhoneNumber');
    Route::post('update-info', [UserController::class, 'updateInfo'])->name('user.updateInfo');
    //
    Route::get('/my-vouchers', [UserController::class, 'myVoucher'])->name('my.voucher.show');
    //
    Route::get('/wish-list', [App\Http\Controllers\WishListController::class, 'wishListIndex'])->name('wish.list.index');
    Route::post('/wish-list-store', [App\Http\Controllers\WishListController::class, 'wishListStore'])->name('user.wish.lists');
    Route::post('/wish-list-delete/{id}', [App\Http\Controllers\WishListController::class, 'wishListSoftDelete'])->name('wish.list.delete');
});


Route::group(['middleware' => 'role.admin'], function () {
    // Các route dành cho super admin
    Route::get('/admin/dashboard', 'AdminController@dashboard');
//    Route::post('down-permission', [\App\Http\Controllers\PermissionRankController::class, 'downRank'])->name('permission.down.rank');
    // Admin Config
    Route::get('/admin/configs', [ConfigProjectController::class, 'index'])->name('admin.configs.show');
    Route::get('/admin/configs/create', [ConfigProjectController::class, 'processCreate'])->name('admin.configs.processCreate');
    Route::post('/admin/configs', [ConfigProjectController::class, 'create'])->name('admin.configs.create');
    Route::get('/admin/configs/{id}', [ConfigProjectController::class, 'detail'])->name('admin.configs.detail');
    Route::put('/admin/configs/{id}', [ConfigProjectController::class, 'update'])->name('admin.configs.update');
    Route::delete('/admin/configs/{id}', [ConfigProjectController::class, 'delete'])->name('admin.configs.delete');
    // Admin banner
    Route::get('/admin/banners', [BannerController::class, 'index'])->name('admin.banners.show');
    Route::get('/admin/banners/create', [BannerController::class, 'processCreate'])->name('admin.banners.processCreate');
    Route::post('/admin/banners', [BannerController::class, 'create'])->name('admin.banners.create');
    Route::post('/admin/banners/{id}', [BannerController::class, 'update'])->name('admin.banners.update');
    Route::delete('/admin/banners/{id}', [BannerController::class, 'delete'])->name('admin.banners.delete');
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('seller.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('seller.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('seller.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('seller.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('seller.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('seller.categories.destroy');
    //
    Route::post('/toggle-products-all/{id}', [ProductController::class, 'toggleProduct'])->name('admin.toggle.products');

});

Route::group(['middleware' => 'role.seller-or-admin'], function () {
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
    Route::get('/properties/create', [Propertientroller::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertiesController::class, 'store'])->name('properties.store');
    //
    Route::get('/properties/{id}', [PropertiesController::class, 'show'])->name('properties.detail');
    Route::post('/properties/{id}', [PropertiesController::class, 'update'])->name('properties.update');
    Route::post('/delete-properties/{id}', [PropertiesController::class, 'destroy'])->name('properties.delete');
    Route::post('/toggle-properties/{id}', [PropertiesController::class, 'toggle'])->name('properties.toggle');
    //
    Route::get('/products', [ProductController::class, 'index'])->name('seller.products.index');
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
//    // Categories
//    Route::get('/categories', [CategoryController::class, 'index'])->name('seller.categories.index');
//    Route::get('/categories/create', [CategoryController::class, 'create'])->name('seller.categories.create');
//    Route::post('/categories', [CategoryController::class, 'store'])->name('seller.categories.store');
//    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('seller.categories.edit');
//    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('seller.categories.update');
//    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('seller.categories.destroy');

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
    Route::get('/export-pdf', [ExportFileController::class, 'exportToPDF'])->name('storage.manage.export.pdf');

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
    // Top seller config
    Route::get('/seller-configs', [TopSellerConfigController::class, 'index'])->name('seller.config.show');
    Route::get('/seller-config/create', [TopSellerConfigController::class, 'processCreate'])->name('seller.config.processCreate');
    Route::post('/seller-config', [TopSellerConfigController::class, 'create'])->name('seller.config.create');
    Route::delete('/seller-config/{id}', [TopSellerConfigController::class, 'delete'])->name('seller.config.delete');
    // Order
    Route::get('/order-managers', [\App\Http\Controllers\Seller\OrderController::class, 'index'])->name('seller.order.list');
    Route::get('/order-managers-search', [\App\Http\Controllers\Seller\OrderController::class, 'search'])->name('seller.search.order.list');
    Route::get('/order-managers/{id}', [\App\Http\Controllers\Seller\OrderController::class, 'detail'])->name('seller.order.detail');
    Route::post('/export-excel', [ExportFileController::class, 'exportExcelOrder'])->name('order.manage.export.excel');
    Route::post('/export-excel-detail', [ExportFileController::class, 'exportExcelOrderDetail'])->name('order.manage.export.excel.detail');
    // Statistic
    Route::get('/statistic-access', [StatisticController::class, 'getStatisticAccess'])->name('admin.statistic.access');
    Route::get('/statistic-revenues', [StatisticController::class, 'getStatisticRevenue'])->name('admin.statistic.revenues');
    Route::get('/statistic-users', [StatisticController::class, 'getStatisticUser'])->name('admin.statistic.users');
    Route::get('/statistic-shop', [StatisticShopController::class, 'getStatisticShops'])->name('shop.statistic.index');
    // Register member
    Route::get('/products-register-member', [RegisterMemberController::class, 'index'])->name('products.register.member.index');
    Route::post('/products-register-member', [RegisterMemberController::class, 'saveProduct'])->name('products.register.member.create');
});

Route::group(['middleware' => 'role.buyer'], function () {
    // Các route dành cho người mua
    Route::get('/buyer/dashboard', 'BuyerController@dashboard');
    Route::get('/buyer/orders', 'BuyerController@orders');
    // ...
});

// Product
Route::get('/product', [\App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('product.index');
Route::get('/product-variable/{id}/{value}', [\App\Http\Controllers\ProductController::class, 'getVariable']);
// Cart
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::delete('/cart-clear', [CartController::class, 'clearCart'])->name('cart.clear');
    // Checkout Controller
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.show');
    Route::get('/checkout-success/{name}/{email}/{phone}/{address}/{idVoucher}', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success.paypal');
    Route::post('/checkout-imm', [CheckoutController::class, 'checkoutByImme'])->name('checkout.create.imm');
    Route::post('/checkout-coin', [CheckoutController::class, 'checkoutByCoin'])->name('checkout.create.coin');
    Route::post('/checkout-paypal', [CheckoutController::class, 'checkoutByPaypal'])->name('checkout.create.paypal');
    // Order Controller
    Route::get('/order-management/', [OrderController::class, 'index'])->name('order.show');
    Route::delete('/order-delete/{id}', [OrderController::class, 'cancel'])->name('order.cancel');
    // Product Interest
    Route::get('/product-interest', [ProductInterestController::class, 'index'])->name('product.interest.index');
    Route::post('/product-interest/{id}', [ProductInterestController::class, 'delete'])->name('product.interest.delete');
    //
    Route::post('/product-viewed', [ProductController::class, 'productViewed'])->name('product.viewed');
    Route::post('/vouchers-item', [VoucherController::class, 'createVoucherItems'])->name('vouchers.item.create');
    Route::post('/promotions-item', [PromotionController::class, 'createPromotionItems'])->name('promotions.item.create');
    Route::get('/promotion', [PromotionController::class, 'index'])->name('promotions.index');
    Route::post('/add-cart/{product}/{percent}', [CartController::class, 'addToCartPromotion'])->name('cart.add.promotion');
    //
    Route::get('/product-views', [\App\Http\Controllers\Frontend\ProductController::class, 'getListByViews'])->name('product.views');
});

// Backend v2
Route::group(['prefix' => 'seller', 'middleware' => 'role.seller-or-admin'], function () {
    require_once __DIR__ . '/backend.php';
});