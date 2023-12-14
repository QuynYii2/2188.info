<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DetailMarketingController;
use App\Http\Controllers\EvaluateProductController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\UserMailSendSellerLogController;
use App\Http\Controllers\MailSendSellerLogController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Member\RegisterMemberController;
use App\Http\Controllers\Member\TrustMemberController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\PermissionRankController;
use App\Http\Controllers\PostRFQController;
use App\Http\Controllers\ProductInterestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopInformationController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UpdateRankController;
use App\Http\Controllers\UserController;
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
//
//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});

Route::get('/lang/en', function ($locale) {
    session()->put('locale', 'en');
    return redirect()->back();
})->name('language');

Route::get('/set-locale/en', [HomeController::class, 'setLocale'])->name('app.set.locale');
Route::post('/change-locale', [HomeController::class, 'changeLanguage'])->name('app.change.locale');

Route::post('/register', [UserController::class, 'store'])->name('register.store');

Route::get('/', [AuthController::class, 'showLogin'])->name('home.login');
Route::get('/home', [HomeController::class, 'index'])->name('homepage');

Route::get('/get-all-products', [\App\Http\Controllers\ProductController::class, 'getAllProduct'])->name('get-all-product');

Route::prefix('/login')->group(function () {
    Route::get('', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/{locale}', [AuthController::class, 'showLoginForm'])->name('login.local');
    Route::post('', [AuthController::class, 'login'])->name('login.submit');
});

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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register/', [HomeController::class, 'register'])->name('register.show');
Route::post('/file/img/store', [FileController::class, 'saveImgByUser'])->name('file.img.save');
Route::get('/file/img/get', [FileController::class, 'getListImgByUser'])->name('file.img.get');

Route::middleware('auth.product')->group(function () {
    // Các tuyến đường sản phẩm ở đây
    Route::get('/product/{id}', 'ProductController@show')->name('product.show');
});

// Convert currency
Route::get('/convert-currency/{total}', [HomeController::class, 'convertCurrency'])->name('convert.currency');

// Start register member

Route::get(
    '/register-member',
    [RegisterMemberController::class, 'processRegisterMember']
)->name('process.register.member');
Route::get(
    '/register-member/{registerMember}',
    [RegisterMemberController::class, 'showRegisterMember']
)->name('show.register.member');
Route::get(
    '/register-member-info/{registerMember}',
    [RegisterMemberController::class, 'showRegisterMemberInfo']
)->name('show.register.member.info');
Route::get(
    '/register-member-person-source/{member_id}/{registerMember}',
    [RegisterMemberController::class, 'showRegisterMemberPerson']
)->name('show.register.member.person.source');

Route::get(
    '/subscription-options-member-person/{member_id}',
    [RegisterMemberController::class, 'showSubscriptionOptions']
)->name('subscription.options.member.person');

Route::get(
    '/verify-register-member-person-source/{email}',
    [RegisterMemberController::class, 'processVerifyEmail']
)->name('show.verify.register.member');
Route::get(
    '/register-member-person-source-represent/{person_id}/{registerMember}',
    [RegisterMemberController::class, 'showRegisterMemberPersonRepresent']
)->name('show.register.member.person.represent');
Route::get(
    '/payment-register-member/{registerMember}',
    [RegisterMemberController::class, 'showPaymentMember']
)->name('show.payment.member');
Route::get(
    '/payment-register-member-success/{registerMember}',
    [RegisterMemberController::class, 'successRegisterMember']
)->name('show.success.payment.member');
Route::get(
    '/register-member-ship/{member}',
    [RegisterMemberController::class, 'registerMemberShip']
)->name('show.register.member.ship');
Route::post('/register-member-ship/create-staff/{id}', [RegisterMemberController::class, 'createNewStaff']
)->name('create.staff.register');
Route::get(
    '/congratulation-register-member/{member}',
    [RegisterMemberController::class, 'congratulationRegisterMember']
)->name('show.register.member.congratulation');

Route::get(
    '/congratulation-register-member-logistic/{member}',
    [RegisterMemberController::class, 'congratulationRegisterMemberLogistic']
)->name('show.register.member.logistic.congratulation');
//Route::get('/register-member/{registerMember}', [RegisterMemberController::class, 'showRegisterMember'])->name('show.register.member');
Route::post(
    '/register-member-buyer',
    [RegisterMemberController::class, 'registerMemberBuyer']
)->name('register.member.buyer');
Route::post(
    '/register-member-info',
    [RegisterMemberController::class, 'registerMemberInfo']
)->name('register.member.info');
Route::post(
    '/register-member-source',
    [RegisterMemberController::class, 'registerMemberPerson']
)->name('register.member.source');
Route::post(
    '/verify-register-member-person-source',
    [RegisterMemberController::class, 'verifyEmail']
)->name('verify.register.member');
Route::post(
    '/register-member-person-source-represent',
    [RegisterMemberController::class, 'registerMemberPersonRepresent']
)->name('register.member.represent');
Route::post(
    '/payment-register-member',
    [RegisterMemberController::class, 'paymentMember']
)->name('payment.member');
// End register member

Route::get('/location-nation', [AuthController::class, 'getListNation'])->name('location.nation.get');
Route::get('/location-state/{id}', [AuthController::class, 'getListStateByNation'])->name('location.state.get');
Route::get('/location-city/{id}/{code}', [AuthController::class, 'getListCityByState'])->name('location.city.get');
Route::get('/location-ward/{id}/{code}', [AuthController::class, 'getListWardByCity'])->name('location.ward.get');
Route::post('/location-create', [AuthController::class, 'createLocation'])->name('location.create');
Route::get('/location-state-by-nation/{id}',
    [AuthController::class, 'getListRegionByNation'])->name('location.state.get.by.nation');

Route::get('/convert-currency/{amount}', [CurrencyController::class, 'getCurrency'])->name('convert.getCurrency.get');
Route::get('/get-products-sale/{id}',
    [\App\Http\Controllers\ProductController::class, 'getProductSale'])->name('get.products.sale');

Route::get('/product-detail/{id}',
    [\App\Http\Controllers\ProductController::class, 'detail_product'])->name('detail_product.show');
Route::get('/product-attribute/{id}',
    [\App\Http\Controllers\ProductController::class, 'orderProduct'])->name('order_product.attribute');
Route::get('/product/att/{id}',
    [\App\Http\Controllers\ProductController::class, 'getDataToModalAtt'])->name('detail_product.data.modal');
Route::get('/shop/information/{id}', [ShopInformationController::class, 'index'])->name('shop.information.show');
Route::get('/shop/product/{id}', [ShopInformationController::class, 'index'])->name('shop.product.show');
Route::post('/shop/product/filter/{id}',
    [ShopInformationController::class, 'filterProductBySeller'])->name('shop.product.filter');
Route::get('/product/detail/{slug}',
    [\App\Http\Controllers\ProductController::class, 'findBySlug'])->name('find.by.slug.product');
Route::get('/detail-product/{id}',
    [\App\Http\Controllers\ProductController::class, 'detailProduct'])->name('detail_product.api');
Route::get('/category/{id}', [CategoryController::class, 'category'])->name('category.show');
Route::post('/category/filter/{id}', [CategoryController::class, 'filterInCategory'])->name('category.filter');
// Products by location
Route::get('/products/location/{locale}',
    [\App\Http\Controllers\ProductController::class, 'listProductsByLanguage'])->name('list.products.show.location');
// Config
Route::get('/products-shop/{id}', [ProductController::class, 'getListByShops'])->name('list.products.shop.show');
Route::get('/products-shop-category/{category}/{shop}',
    [ProductController::class, 'getListByCategoryAndShops'])->name('list.products.shop.category.show');

Route::get('/chat-message/{from}/{to}', [SampleController::class, 'findAllMessage'])->name('chat.message.show.to.way');
Route::post('get-number-phone-by-email', [UserController::class, 'getNumberPhoneByEmail'])->name('user.get.number.phone');

// Product
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product-variable/{id}/{value}', [\App\Http\Controllers\ProductController::class, 'getVariable']);
Route::post('/get-category-one-parent',
    [RegisterMemberController::class, 'getCategoryOneParent'])->name('get.category.one.parent');
Route::post('/get-category-two-parent',
    [RegisterMemberController::class, 'getCategoryTwoParent'])->name('get.category.two.parent');

/* Auth validate route*/
Route::middleware(['auth'])->group(function () {
    //Chat message
    Route::get('/chat-message', [SampleController::class, 'chat'])->name('chat.message.show');
    Route::get('/chat-message-sent', [SampleController::class, 'getListMessageSent'])->name('chat.message.sent');
    Route::get('/chat-message-received',
        [SampleController::class, 'getListMessageReceived'])->name('chat.message.received');
    // Post RFQ
    Route::get('/post-rfq', [PostRFQController::class, 'processCreate'])->name('processCreate.post.rfq');
    Route::post('/post-rfq', [PostRFQController::class, 'create'])->name('create.post.rfq');
    /* Post mail seller */
    Route::get('/list-mail-seller', [UserMailSendSellerLogController::class, 'index'])->name('user.list.mail.seller');
    Route::delete('/delete-mail-seller/{id}', [UserMailSendSellerLogController::class, 'delete'])->name('user.send.mail.delete');
    Route::post('/send-mail-seller', [MailSendSellerLogController::class, 'create'])->name('user.send.mail.seller');
    //Detail marketing
    Route::get('/detail-marketing/{id}', [DetailMarketingController::class, 'index'])->name('detail-marketing.show');
    Route::delete('/detail-marketing/{id}/{product}', [DetailMarketingController::class, 'delete'])->name('detail-marketing.delete');
    // Product member
    Route::get('/member/product-buy-lot/attribute/{id}',
        [ProductController::class, 'detailProduct'])->name('detail_product.member.attribute');
    Route::post('/member-add-to-cart/{product}',
        [ProductController::class, 'orderMemberProduct'])->name('member.add.cart');
    Route::get('/member-get-all-cart', [CartController::class, 'getAllCarts'])->name('member.all.cart');

    //Start update member
    Route::get('/member-info', [ProfileController::class, 'memberInfo'])->name('member.info');
    Route::get('/member-detail-company/{id}',
        [MemberController::class, 'detailCompany'])->name('member.detail.company');
    Route::put('/member-update-company/{id}',
        [MemberController::class, 'updateCompany'])->name('member.update.company');
    //End update member

    //View member
    Route::get('/member-registered', [UpdateRankController::class, 'detail'])->name('member.registered.detail');
    Route::post('/member-registered', [UpdateRankController::class, 'updateMember'])->name('member.registered.update');
    //
    Route::get('/info/', [ProfileController::class, 'info'])->name('profile.show');

    Route::get('/info-member-person', [ProfileController::class, 'memberPerson'])->name('profile.member.person');
    Route::get('/info-member-represent',
        [ProfileController::class, 'memberRepresent'])->name('profile.member.represent');
    Route::get('/info-member-ship/{member}',
        [ProfileController::class, 'memberShip'])->name('profile.member.ship');
//    Route::get('/my-notification/', [\App\Http\Controllers\ProfileController::class, 'my_notification']);
//    Route::get('/order-management/', [\App\Http\Controllers\ProfileController::class, 'order_management']);
    Route::get('/return-management/', [ProfileController::class, 'return_management']);
//    Route::get('/address-book/', [\App\Http\Controllers\ProfileController::class, 'address_book']);
    Route::get('/payment-information/', [ProfileController::class, 'payment_information']);
    Route::get('/product-evaluation/', [ProfileController::class, 'product_evaluation'])->name('my.product.evaluation');
    Route::get('/product-evaluation/delete/{id}',
        [EvaluateProductController::class, 'destroy'])->name('product_evaluation.delete');
    Route::get('/favorite-product/', [ProfileController::class, 'favorite_product']);
    Route::get('/product-viewed/', [ProfileController::class, 'product_viewed'])->name('my.product.viewed');
    Route::get('/my-review/', [ProfileController::class, 'my_review']);
    // Đánh giá sản phẩm
    Route::post('/evaluate', [EvaluateProductController::class, 'store'])->name('create.evaluate');
    Route::get('/evaluate/{id}', [EvaluateProductController::class, 'show'])->name('find.evaluate.id');
    Route::post('/evaluate/update', [EvaluateProductController::class, 'update'])->name('update.evaluate.id');
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
    Route::post('/delete-payment/{id}',
        [PermissionRankController::class, 'deletePermission'])->name('permission.delete');
    //
    Route::get('create-transaction', [PaypalPaymentController::class, 'createTransaction'])->name('createTransaction');
//    Route::post('update-permission', [\App\Http\Controllers\PermissionRankController::class, 'updateRank'])->name('permission.update.rank');
//    Route::post('down-permission', [\App\Http\Controllers\PermissionRankController::class, 'downRank'])->name('permission.down.rank');
    Route::post('payment', [PaypalPaymentController::class, 'processTransaction'])->name('create.payment');
    Route::get('get-payment', [PaypalPaymentController::class, 'index'])->name('payment.show');
    //
    Route::get('process-transaction',
        [PaypalPaymentController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction',
        [PaypalPaymentController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PaypalPaymentController::class, 'cancelTransaction'])->name('cancelTransaction');
    //
    Route::get('/my-notification/', [NotificationController::class, 'index'])->name('notification.show');
    Route::post('/all-notification/', [NotificationController::class, 'checkAll'])->name('notification.checkAll');
    Route::post('/delete-notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
    //
    Route::get('/buy-coin', [CoinController::class, 'index'])->name('buy.coin.show');
    Route::post('/buy-coin', [CoinController::class, 'store'])->name('buy.coin.create');
//    Route::get('/buy-coin-success?price={price}&quantity={quantity}', [\App\Http\Controllers\CoinController::class, 'successPayment'])->name('buy.coin.success');
    Route::get('/buy-coin-success/{price}/{quantity}',
        [CoinController::class, 'successPayment'])->name('buy.coin.success');
    // thông tin cá nhân
    Route::post('change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('change-email', [UserController::class, 'changeEmail'])->name('user.changeEmail');
    Route::post('change-phone-number', [UserController::class, 'changePhoneNumber'])->name('user.changePhoneNumber');
    Route::post('update-info', [UserController::class, 'updateInfo'])->name('user.updateInfo');
    //
    Route::get('/my-vouchers', [UserController::class, 'myVoucher'])->name('my.voucher.show');
    //
    Route::get('/wish-list',
        [App\Http\Controllers\WishListController::class, 'wishListIndex'])->name('wish.list.index');
    Route::post('/wish-list-store',
        [App\Http\Controllers\WishListController::class, 'wishListStore'])->name('user.wish.lists');
    Route::post('/wish-list-delete/{id}',
        [App\Http\Controllers\WishListController::class, 'wishListSoftDelete'])->name('wish.list.delete');
    // Search products
    Route::get('/search-products/category={id}',
        [SearchController::class, 'searchByCategory'])->name('search.products.category');
    Route::get('/search-products/name',
        [SearchController::class, 'searchByNameProducts'])->name('search.products.name');
    // Member trust
    Route::get('/trusts-register-member',
        [TrustMemberController::class, 'memberStand'])->name('trust.register.member.index');
    Route::get('/trusts-register-member/{locale}',
        [TrustMemberController::class, 'memberPartnerLocale'])->name('trust.register.member.locale');
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::delete('/cart-clear', [CartController::class, 'clearCart'])->name('cart.clear');
    // Checkout Controller
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.show');
    Route::get('/checkout-success/{name}/{email}/{phone}/{address}/{idVoucher}',
        [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success.paypal');
    Route::post('/checkout-imm', [CheckoutController::class, 'checkoutByImme'])->name('checkout.create.imm');
    Route::post('/checkout-coin', [CheckoutController::class, 'checkoutByCoin'])->name('checkout.create.coin');
    Route::post('/checkout-paypal', [CheckoutController::class, 'checkoutByPaypal'])->name('checkout.create.paypal');
    Route::post('/checkout-vnpay', [CheckoutController::class, 'checkoutByVNPay'])->name('checkout.create.vnpay');
    Route::post('/payment-methods', [CheckoutController::class, 'paymentMethods'])->name('checkout.payment.methods');
    Route::get('/return-checkout', [CheckoutController::class, 'returnCheckout'])->name('return.checkout.payment');
    // Order Controller
    Route::get('/order-management/', [OrderController::class, 'index'])->name('order.show');
    Route::delete('/order-delete/{id}', [OrderController::class, 'cancel'])->name('order.cancel');
    // Product Interest
    Route::get('/product-interest', [ProductInterestController::class, 'index'])->name('product.interest.index');
    Route::post('/product-interest/{id}',
        [ProductInterestController::class, 'delete'])->name('product.interest.delete');
    //
    Route::get('/product-views', [ProductController::class, 'getListByViews'])->name('product.views');
    // Member
    Route::get('/member-view-carts', [ProductController::class, 'cartMemberProduct'])->name('member.view.carts');
    Route::get('/member-get-product-sales', [ProductController::class, 'getPriceSale'])->name('member.product.sales');
});

// Backend v2
Route::group(['prefix' => 'seller', 'middleware' => 'role.seller-or-admin'], function () {
    require_once __DIR__ . '/backend.php';
});

// Admin
Route::group(['prefix' => 'admin', 'middleware' => 'role.admin'], function () {
    require_once __DIR__ . '/admin.php';
});

Route::prefix('address')->group(function () {
    Route::get('index', [\App\Http\Controllers\Seller\AddressController::class, 'index'])->name('address.manage.index');
    Route::get('detail/{id}', [\App\Http\Controllers\Seller\AddressController::class, 'detail'])->name('address.manage.detail');
    Route::get('add', [\App\Http\Controllers\Seller\AddressController::class, 'create'])->name('address.manage.add');
    Route::post('update-star-nation/{id}', [\App\Http\Controllers\Seller\AddressController::class, 'updateStarNation'])->name('address.manage.update.star.nation');
    Route::post('update-star-state/{id}', [\App\Http\Controllers\Seller\AddressController::class, 'updateStarState'])->name('address.manage.update.star.state');
    Route::post('update-star-city/{id}', [\App\Http\Controllers\Seller\AddressController::class, 'updateStarCity'])->name('address.manage.update.star.city');
});

// Seller
Route::group(['prefix' => 'seller', 'middleware' => 'role.seller-or-admin'], function () {
    require_once __DIR__ . '/seller.php';
});

// Buyer
Route::group(['prefix' => 'buyer', 'middleware' => 'role.buyer'], function () {
    require_once __DIR__ . '/buyer.php';
});

//showCart
Route::get('/showCart', [CartController::class, 'showCart'])->name('showCart');
Route::get('/renderCart', [CartController::class, 'renderCart'])->name('renderCart');
Route::post('deleteCart/{id}', [CartController::class, 'deleteCart'])->name('deleteCart');
// CheckID
Route::post('/checkID', [RegisterMemberController::class, 'checkID'])->name('member.checkId');

Route::get('/address/list', [\App\Http\Controllers\AddressController::class, 'index'])->name('address.index');
Route::get('/address/detail/{code}', [\App\Http\Controllers\AddressController::class, 'show'])->name('address.detail');
Route::get('/address/detail-region/{code}', [\App\Http\Controllers\AddressController::class, 'showRegion'])->name('address.show.region');
