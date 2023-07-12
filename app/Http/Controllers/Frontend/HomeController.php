<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\NotificationStatus;
use App\Enums\ProductStatus;
use App\Enums\PromotionStatus;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PermissionRankController;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\Promotion;
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
        $locale = '';
        $currency = '';
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            app()->setLocale($request->session()->get('locale'));
        } else {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip('183.80.130.4');
            if ($locale !== null && is_array($locale)) {
                $locale = $locale['countryCode'];
            } else {
                $locale = 'vi';
            }
        }
        app()->setLocale($locale);

        $currencies = [
            'vi' => 'VND',
            'kr' => 'KRW',
            'cn' => 'CNY',
            'jp' => 'JPY',
        ];

        if (array_key_exists($locale, $currencies)) {
            $currency = $currencies[$locale];
        }

        $productByLocal = Product::where('location', $locale)->limit(10)->get();

        $categories = Category::get()->toTree();

        $locations = ['vi', 'kr', 'jp', 'cn'];

        $locations = array_diff($locations, [$locale]);

        $productByLocal = Product::whereIn('location', array_slice($locations, 0, 3))
            ->limit(10)
            ->get();
        $productByKr = Product::where('location', 'kr')->limit(10)->get();
        $productByJp = Product::where('location', 'jp')->limit(10)->get();
        $productByCn = Product::where('location', 'cn')->limit(10)->get();

        $permissionHot = Permission::where('name', 'Nâng cấp sản phẩm hot')->first();
        $permissionSellerHots = DB::table('permission_user')->where('permission_id', $permissionHot->id)->get();
        $productHots = [];
        foreach ($permissionSellerHots as $permissionSellerHot) {
            $products = Product::where([
                ['status', ProductStatus::ACTIVE],
                ['user_id', $permissionSellerHot->user_id]
            ])->orderBy('hot', 'desc')->get();
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
            $productFeatures[] = $products;
        }
//        $productFeatures = Product::where('feature', 1)->get();

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

        return view('frontend/index', [
            'productByLocal' => $productByLocal,
            'currency' => $currency,
            'countryCode' => $locale,
            'categories' => $categories,
            'productByKr' => $productByKr,
            'productByJp' => $productByJp,
            'productByCn' => $productByCn,
            'productHots' => $productHots,
            'productFeatures' => $productFeatures
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
        $locale = '';
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            app()->setLocale($request->session()->get('locale'));
        } else {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip('183.80.130.4');
            if ($locale !== null && is_array($locale)) {
                $locale = $locale['countryCode'];
            } else {
                $locale = 'vi';
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
}
