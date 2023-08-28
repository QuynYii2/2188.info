<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\BannerStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\MemberRegisterPersonSourceStatus;
use App\Enums\MemberRegisterType;
use App\Enums\NotificationStatus;
use App\Enums\ProductStatus;
use App\Enums\PromotionStatus;
use App\Enums\RegisterMember;
use App\Enums\StatisticStatus;
use App\Enums\TopSellerConfigLocation;
use App\Enums\VoucherStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TranslateController;
use App\Libraries\GeoIP;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Member;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\StatisticAccess;
use App\Models\StatisticShop;
use App\Models\TopSellerConfig;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Countries\Package\Countries;


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
            'en' => 'USD'
        ];

        $currentProducts = Product::where([['location', $locale], ['status', ProductStatus::ACTIVE]])->get();

        if (array_key_exists($locale, $currencies)) {
            $currency = $currencies[$locale];
        }


        $categories = Category::get()->toTree();

        $locations = ['vi', 'kr', 'jp', 'cn', 'en'];

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
        $members = Member::where('price', 0)->get();
        return view('frontend/pages/register', compact('permissions', 'categories', 'members'));
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

    public function getLangDisplay()
    {
        $locale = session()->get('locale');
        if (!$locale) {
            $locale = 'vi';
        }
        $locations = ['vi', 'kr', 'jp', 'cn', 'en'];
        $lang = ['vi', 'ko', 'ja', 'zh', 'en'];
        $index = array_search($locale, $locations);

        // Nếu tìm thấy, trả về giá trị tương ứng từ mảng $lang
        if ($index !== false) {
            return '_' . $lang[$index];
        } else {
            return ''; // Xử lý nếu không tìm thấy
        }
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

    public function checkSellerOrAdmin()
    {
        $user = Auth::user();
        $isValid = false;
        $roles = $user->roles;
        $roleNames = $roles->pluck('name');
        if ($roleNames->contains('seller') || $roleNames->contains('super_admin')) {
            $isValid = true;
        }
        return $isValid;
    }

    public function checkMember()
    {
        $user = Auth::user();
        $isMember = false;
        $member = MemberRegisterPersonSource::where([
            ['user_id', $user->id],
            ['status', MemberRegisterPersonSourceStatus::ACTIVE]
        ])->first();
        if ($member) {
            $isMember = true;
        }
        return $isMember;
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

    public function getLocation(Request $request)
    {
        $geoIp = new GeoIP();
        $locale = $geoIp->getCode($request->ip());
        $countries = new Countries();
        dd($countries);
        $country = $countries->all()->pluck('name.common')->toArray();
        $currencies = $countries->all()->pluck('currencies')->toArray();
        $all = $countries->where('name.common', $locale)->first()->hydrate('currencies')->currencies;
        foreach ($all as $items) {
            $currency = $items->iso->code;
        }
        return $currency;
    }

    //Start import user form nn21
    public function createMultilNewUser()
    {
        $listUser = $this->callApi();
        try {
            if (!isset($_COOKIE["cookieInsertUser"])) {
                $passwordHash = Hash::make(env('PASSWORD_DEFAULT', 123456));
                $listUser = trim($listUser);
                if ($listUser) {
                    $arrayUser = explode('!!!', $listUser);
                    foreach ($arrayUser as $company) {
                        if ($company) {
                            $companyArray = null;
                            $companyArray = explode('&&', $company);
                            $email = $companyArray[0];
                            $companyName = $companyArray[1];
                            $companyCode = $companyArray[2];
                            $companyFAX = null;
                            $companyTEL = null;
                            $companyAddress = null;
                            if (count($companyArray) > 3) {
                                $companyTEL = $companyArray[3];
                            }
                            if (count($companyArray) > 4) {
                                $companyFAX = $companyArray[4];
                            }
                            if (count($companyArray) > 5) {
                                $companyAddress = $companyArray[5];
                            }

                            if (!$companyName) {
                                $companyName = 'default';
                            }
                            if (!$companyCode) {
                                $companyCode = 'default';
                            }
                            if (!$companyTEL) {
                                $companyTEL = 'default';
                            }
                            if (!$companyFAX) {
                                $companyFAX = 'default';
                            }
                            if (!$companyAddress) {
                                $companyAddress = 'default';
                            }

                            $language = (new TranslateController())->detectLanguage($companyAddress);
                            if ($language == '') {
                                $language = 'vi';
                            }

                            if ($language == 'zh-CN'){
                                $language = 'cn';
                            }

                            if ($language == 'ko'){
                                $language = 'kr';
                            }

                            if ($language == 'ja'){
                                $language = 'jp';
                            }

                            $oldUser = User::where('email', $email)->first();
                            if (!$oldUser) {
                                $newUser = new User();
                                $newUser->name = 'default name';
                                $newUser->email = $email;
                                $newUser->phone = $companyTEL;
                                $newUser->address = "default address";
                                $newUser->region = $language;
                                $newUser->password = $passwordHash;
                                $newUser->type_account = "seller";
                                $newUser->email_verified_at = now();
                                $newUser->image = 'default image';
                                $newUser->member = RegisterMember::LOGISTIC;
                                $success = $newUser->save();

                                $data = array('mail' => $email, 'name' => $email, 'password' => env('PASSWORD_DEFAULT', 123456));

                                Mail::send('frontend/widgets/mailWelcome', $data, function ($message) use ($email) {
                                    $message->to($email, 'Welcome mail!')->subject
                                    ('Welcome mail');
                                    $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
                                });

                                if ($success) {
                                    $exitUser = null;
                                    $exitUser = User::where('email', $email)->first();

                                    DB::table('role_user')->insert([
                                        'role_id' => 2,
                                        'user_id' => $exitUser->id
                                    ]);

                                    $member = Member::where('name', RegisterMember::LOGISTIC)->first();

                                    $memberInfo = null;
                                    $memberInfo = [
                                        'user_id' => $exitUser->id,
                                        'name' => $companyName,
                                        'phone' => $companyTEL,
                                        'fax' => $companyFAX,
                                        'code_fax' => $companyCode,
                                        'category_id' => '30,31,32',
                                        'code_business' => 'default code business',
                                        'number_business' => 'default number business',
                                        'member' => RegisterMember::LOGISTIC,
                                        'member_id' => $member->id,
                                        'address' => $companyAddress,
                                        'status' => MemberRegisterInfoStatus::ACTIVE
                                    ];
                                    MemberRegisterInfo::create($memberInfo);

                                    $exitMember = null;
                                    $exitMember = MemberRegisterInfo::where('user_id', $exitUser->id)->orderBy('created_at', 'desc')->first();

                                    $exitMemberPersonSource = MemberRegisterPersonSource::where([
                                        ['email', $email],
                                        ['type', MemberRegisterType::SOURCE]
                                    ])->first();

                                    if (!$exitMemberPersonSource) {
                                        $memberPersonSource = null;
                                        $memberPersonSource = [
                                            'user_id' => $exitUser->id,
                                            'name' => $companyName,
                                            'password' => $passwordHash,
                                            'phone' => $companyTEL,
                                            'email' => $email,
                                            'staff' => 'default',
                                            'member_id' => $exitMember->id,
                                            'price' => 0,
                                            'rank' => '0',
                                            'sns_account' => 'default',
                                            'type' => MemberRegisterType::SOURCE,
                                            'verifyCode' => '',
                                            'isVerify' => 0,
                                            'status' => MemberRegisterPersonSourceStatus::ACTIVE
                                        ];
                                        MemberRegisterPersonSource::create($memberPersonSource);
                                    }

                                    $exitMemberPer = null;
                                    $exitMemberPer = MemberRegisterPersonSource::where([
                                        ['user_id', $exitUser->id],
                                        ['email', $email],
                                        ['type', MemberRegisterType::SOURCE]
                                    ])->first();
                                    if ($exitMemberPer) {
                                        $exitMemberPersonRepresent = MemberRegisterPersonSource::where([
                                            ['email', $email],
                                            ['type', MemberRegisterType::REPRESENT]
                                        ])->first();
                                        if (!$exitMemberPersonRepresent) {
                                            $memberPersonRepresent = null;
                                            $memberPersonRepresent = [
                                                'user_id' => $exitUser->id,
                                                'name' => $companyName,
                                                'password' => $passwordHash,
                                                'phone' => $companyTEL,
                                                'email' => $email,
                                                'staff' => 'default',
                                                'person' => $exitMemberPer->id,
                                                'member_id' => $exitMember->id,
                                                'price' => 0,
                                                'rank' => '0',
                                                'sns_account' => 'default',
                                                'type' => MemberRegisterType::REPRESENT,
                                                'verifyCode' => '',
                                                'isVerify' => 0,
                                                'status' => MemberRegisterPersonSourceStatus::ACTIVE
                                            ];

                                            MemberRegisterPersonSource::create($memberPersonRepresent);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            setcookie("cookieInsertUser", "SHOPPING MALL", time() + 24 * 3600, "/");
        } catch (Exception $exception) {
            return $exception;
        }
    }
    //End import user form nn21

    // Private function
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

    // Call API form nn21
    private function callApi()
    {
        try {
            $response = Http::get(env('URL_GET_ALL_USER'));
            $data = $response->body();
            return $data;
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi gọi API'], 500);
        }
    }

}
