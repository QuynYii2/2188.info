<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\BannerStatus;
use App\Enums\NotificationStatus;
use App\Enums\ProductStatus;
use App\Enums\PromotionStatus;
use App\Enums\StatisticStatus;
use App\Enums\TopSellerConfigLocation;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PermissionRankController;
use App\Http\Controllers\TranslateController;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\Promotion;
use App\Models\StatisticAccess;
use App\Models\StatisticShop;
use App\Models\TopSellerConfig;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Libraries\GeoIP;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $this->getLocale($request);
        $locale = app()->getLocale();
        if ($locale == 'vn') {
            $locale = 'vi';
        }

        $currencies = [
            'vi' => 'VND',
            'kr' => 'KRW',
            'cn' => 'CNY',
            'jp' => 'JPY',
            'en' => "USD"
        ];

        $currentProducts = Product::where([['location', $locale], ['status', ProductStatus::ACTIVE]])->get();

        if (array_key_exists($locale, $currencies)) {
            $currency = $currencies[$locale];
        }


        $categories = Category::get()->toTree();

        $locations = ['vi', 'kr', 'jp', 'cn'];

        $locations = array_diff($locations, [$locale]);

        $productByLocal = Product::whereIn('location', array_slice($locations, 0, 3))
            ->limit(10)
            ->get();

        $productByVi = Product::where([['location', 'vi'], ['status', ProductStatus::ACTIVE]])->limit(10)->get();
        $productByKr = Product::where([['location', 'kr'], ['status', ProductStatus::ACTIVE]])->limit(10)->get();
        $productByJp = Product::where([['location', 'jp'], ['status', ProductStatus::ACTIVE]])->limit(10)->get();
        $productByCn = Product::where([['location', 'cn'], ['status', ProductStatus::ACTIVE]])->limit(10)->get();

        $arrayProducts = [
            'vi' => $productByVi,
            'kr' => $productByKr,
            'cn' => $productByCn,
            'jp' => $productByJp
        ];

        $newProducts = Product::where('status', ProductStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(10)->get();
        $newProducts = $newProducts->unique('slug');

        $permissionHot = Permission::where('name', 'Nâng cấp sản phẩm hot')->first();
        $permissionSellerHots = DB::table('permission_user')->where('permission_id', $permissionHot->id)->get();
        $productHots = [];
        foreach ($permissionSellerHots as $permissionSellerHot) {
            $products = Product::where([
                ['status', ProductStatus::ACTIVE],
                ['user_id', $permissionSellerHot->user_id]
            ])->orderBy('hot', 'desc')->get();
            $products = $products->unique('slug');
            $productHots[] = $products;
        }
//        dd($productHots);
        $permissionFeature = Permission::where('name', 'Nâng cấp sản phẩm nổi bật')->first();
        $permissionSellerFeatures = DB::table('permission_user')->where('permission_id', $permissionFeature->id)->get();
        $productFeatures = [];
        foreach ($permissionSellerFeatures as $permissionSellerFeature) {
            $products = Product::where([
                ['status', ProductStatus::ACTIVE],
                ['user_id', $permissionSellerFeature->user_id]
            ])->orderBy('feature', 'desc')->get();
            $products = $products->unique('slug');
            $productFeatures[] = $products;
        }
//        $productFeatures = Product::where('feature', 1)->get();

        $configsTop1 = TopSellerConfig::where('local', TopSellerConfigLocation::OptionOne)->orderBy('created_at', 'desc')->limit(3)->get();
        $configsTop2 = TopSellerConfig::where('local', TopSellerConfigLocation::OptionTwo)->orderBy('created_at', 'desc')->limit(3)->get();
        $configsTop3 = TopSellerConfig::where('local', TopSellerConfigLocation::OptionThree)->orderBy('created_at', 'desc')->limit(3)->get();
        $configsTop4 = TopSellerConfig::where('local', TopSellerConfigLocation::OptionFour)->orderBy('created_at', 'desc')->limit(3)->get();
        $configsTop5 = TopSellerConfig::where('local', TopSellerConfigLocation::OptionFive)->orderBy('created_at', 'desc')->limit(3)->get();

        $vouchers = Voucher::where([
            ['status', '!=', VoucherStatus::DELETED],
            ['endDate', '<', Carbon::now()->addHours(7)]
        ])->update(['status' => VoucherStatus::INACTIVE]);

        $vouchers = Voucher::where([
            ['status', '!=', VoucherStatus::DELETED],
            ['quantity', 0]
        ])->update(['status' => VoucherStatus::INACTIVE]);

        $vouchers = Voucher::where([
            ['status', '!=', VoucherStatus::DELETED],
            ['startDate', '>=', Carbon::now()->addHours(7)]
        ])->update(['status' => VoucherStatus::ACTIVE]);

        $promotion = Promotion::where([
            ['status', PromotionStatus::ACTIVE],
            ['endDate', '<', Carbon::now()->addHours(7)]
        ])->update(['status' => PromotionStatus::INACTIVE]);

        $promotion = DB::table('promotions')->where([
            ['status', '!=', PromotionStatus::DELETED],
            ['startDate', '<', Carbon::now()->addHours(7)]
        ])->update(['status' => PromotionStatus::ACTIVE]);

        $banner = Banner::where('status', BannerStatus::ACTIVE)->orderBy('created_at', 'desc')->first();

        return view('frontend/index', [
            'productByLocal' => $productByLocal,
            'currency' => $currency,
            'countryCode' => $locale,
            'categories' => $categories,
            'productByVi' => $productByVi,
            'productByKr' => $productByKr,
            'productByJp' => $productByJp,
            'productByCn' => $productByCn,
            'productHots' => $productHots,
            'productFeatures' => $productFeatures,
            'configsTop1' => $configsTop1,
            'configsTop2' => $configsTop2,
            'configsTop3' => $configsTop3,
            'configsTop4' => $configsTop4,
            'configsTop5' => $configsTop5,
            'banner' => $banner,
            'newProducts' => $newProducts,
            'currentProducts' => $currentProducts,
            'arrayProducts' => $arrayProducts,
            'locale' => $locale,
        ]);
    }

    public function shop()
    {
        return view('frontend/pages/product-list');
    }

    public function register(Request $request)
    {
        $this->getLocale($request);
        $permissions = DB::table('permissions')->where([['name', '!=', 'view_all_products'], ['name', '!=', 'view_profile']])->get();
        $categories = Category::get()->toTree();
        return view('frontend/pages/register', compact('permissions', 'categories'));
    }

    public function getLocale(Request $request)
    {
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            app()->setLocale($request->session()->get('locale'));
        } else {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip($ipAddress);
            if ($locale !== null && is_array($locale)) {
                $locale = $locale['countryCode'];
            }
        }
        app()->setLocale($locale);
    }

    public function notifiCreate($id, $content, $desc)
    {
        $noti = [
            'user_id' => $id,
            'content' => $content,
            'description' => $desc,
            'status' => NotificationStatus::UNSEEN,
        ];

        Notification::create($noti);

        return $noti;
    }

    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function checkAdmin()
    {
        $user = Auth::user()->id;
        $role_id = DB::table('role_user')->where('user_id', $user)->get();
        $isAdmin = false;
        foreach ($role_id as $item) {
            if ($item->role_id == 1) {
                $isAdmin = true;
            }
        }
        return $isAdmin;
    }

    public function createStatistic()
    {
        if (!isset($_COOKIE["access"])) {
            $statisticAccess = StatisticAccess::where([
                ['datetime', '<', Carbon::now()->addHours(7)->copy()->endOfDay()],
                ['datetime', '>', Carbon::now()->addHours(7)->copy()->startOfDay()],
                ['status', StatisticStatus::ACTIVE],
            ])->first();

            if ($statisticAccess) {
                $statisticAccess->numbers = $statisticAccess->numbers + 1;
                $statisticAccess->save();
            } else {
                $statisticAccess = [
                    'numbers' => 1,
                    'datetime' => Carbon::now()->addHours(7),
                ];

                StatisticAccess::create($statisticAccess);
            }
            setcookie("access", "SHOPPING MALL", time() + 600, "/");
        }
    }

    public function createStatisticShopDetail($value, $id)
    {
        $this->createStatisticShop($value, $id);
    }

    public function setLocale($locale)
    {
        if (!$locale || $locale == 'vn') {
            $locale = 'vi';
        }
        // Chưa tìm được giải pháp
//        session()->put('locale', $locale);
//        app()->setLocale($locale);
    }

    private function createStatisticShop($value, $id)
    {
        $statisticShop = StatisticShop::where([
            ['user_id', $id],
            ['datetime', '<', Carbon::now()->addHours(7)->copy()->endOfDay()],
            ['datetime', '>', Carbon::now()->addHours(7)->copy()->startOfDay()]
        ])->first();

        if ($value == 'access') {
            if ($statisticShop) {
                $statisticShop->access = $statisticShop->access + 1;
                $statisticShop->save();
            } else {
                $statisticShop = [
                    'access' => 1,
                    'user_id' => $id,
                    'datetime' => Carbon::now()->addHours(7),
                ];

                StatisticShop::create($statisticShop);
            }
        } elseif ($value == 'views') {
            if ($statisticShop) {
                $statisticShop->views = $statisticShop->views + 1;
                $statisticShop->save();
            } else {
                $statisticShop = [
                    'views' => 1,
                    'user_id' => $id,
                    'datetime' => Carbon::now()->addHours(7),
                ];

                StatisticShop::create($statisticShop);
            }
        } else {
            if ($statisticShop) {
                $statisticShop->orders = $statisticShop->orders + 1;
                $statisticShop->save();
            } else {
                $statisticShop = [
                    'orders' => 1,
                    'user_id' => $id,
                    'datetime' => Carbon::now()->addHours(7),
                ];

                StatisticShop::create($statisticShop);
            }
        }
    }
}
