<?php

namespace App\Http\Controllers;

use App\Enums\MemberRegisterInfoStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\RegisterMember;
use App\Enums\StatisticStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Libraries\GeoIP;
use App\Models\Category;
use App\Models\MemberRegisterInfo;
use App\Models\Permission;
use App\Models\StatisticAccess;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            //
            $statisticAccess = StatisticAccess::where([
                ['user_id', Auth::user()->id],
                ['datetime', '<', Carbon::now()->addHours(7)->copy()->endOfDay()],
                ['datetime', '>', Carbon::now()->addHours(7)->copy()->startOfDay()],
                ['status', StatisticStatus::ACTIVE],
            ])->first();

            if ($statisticAccess) {
                $statisticAccess->numbers = $statisticAccess->numbers + 1;
                $statisticAccess->save();
            } else {
                $statisticRevenue = [
                    'user_id' => Auth::user()->id,
                    'numbers' => 1,
                    'datetime' => Carbon::now()->addHours(7),
                ];

                StatisticAccess::create($statisticRevenue);
            }
            // nếu đăng nhập thàng công thì
            return redirect()->route('home');
        } else {
            return view('frontend/pages/login');
        }
    }

    public function showLoginForm($locale)
    {
        app()->setLocale($locale);
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('frontend/pages/login');
        }
    }

    public function login(Request $request)
    {
        $loginField = $request->input('login_field');
        $isEmail = filter_var($loginField, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            $credentials = [
                'email' => $loginField,
                'password' => $request->input('password'),
            ];
        } else {
            $credentials = [
                'phone' => $loginField,
                'password' => $request->input('password'),
            ];
        }

        $user = User::where($isEmail ? 'email' : 'phone', $loginField)->first();

        if ($user && $user->status !== UserStatus::ACTIVE) {
            toast('Tài khoản của bạn đã bị khóa.', 'error', 'top-right');
            return redirect()->route('login');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->put('login', $loginField);
            $login = $request->session()->get('login');
            return redirect()->route('home');
        } else {
            toast('Tên đăng nhập hoặc mật khẩu không chính xác', 'error', 'top-right');
        }

        return redirect()->route('login');
    }

    public function getGoogleSignInUrl()
    {
        try {
            $url = Socialite::driver('google')->stateless()
                ->redirect()->getTargetUrl();
            return redirect($url);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function loginCallback(Request $request)
    {
        try {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip('183.80.130.4');

            $googleUser = Socialite::driver('google')->stateless()->user();

            if ($googleUser->getEmail() == null || $googleUser->getName() == null) {
                return redirect()->route('login')->with('error', 'Error');
            }

            $existingUser = User::where('email', $googleUser->email)->first();

            $password = (new HomeController())->generateRandomString(8);
            $passwordHash = Hash::make($password);

            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                $newUser = new User;
                $newUser->provider_name = "google";
                $newUser->provider_id = $googleUser->getId();
                $newUser->name = $googleUser->getName();
                $newUser->email = $googleUser->getEmail();
                $newUser->phone = "null";
                $newUser->address = "null";
                $newUser->region = $locale;
                $newUser->password = $passwordHash;
                $newUser->type_account = "null";
                $newUser->email_verified_at = now();
                $newUser->image = $googleUser->getAvatar();

                $newUser->save();
                auth()->login($newUser, true);

                $defaultPermission1 = Permission::where('name', 'view_all_products')->first();
                $defaultPermission2 = Permission::where('name', 'view_profile')->first();

                $permissionUser1 = [
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now()->addHours(7),
                    'permission_id' => $defaultPermission1->id,
                    'status' => PermissionUserStatus::ACTIVE
                ];

                $permissionUser2 = [
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now()->addHours(7),
                    'permission_id' => $defaultPermission2->id,
                    'status' => PermissionUserStatus::ACTIVE
                ];

                DB::table('permission_user')->insert($permissionUser1);
                DB::table('permission_user')->insert($permissionUser2);

                $email = $googleUser->getEmail();
                $data = array('mail' => $email, 'name' => $email, 'password' => $password);

                Mail::send('frontend/widgets/mailWelcome', $data, function ($message) use ($email) {
                    $message->to($email, 'Welcome mail!')->subject
                    ('Welcome mail');
                    $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
                });

                (new HomeController())->notifiCreate(Auth::user()->id, 'Đăng kí tài khoản thành công', 'Đăng kí tài khoản');
                (new HomeController())->notifiCreate(Auth::user()->id, 'Vui lòng cập nhập mật khẩu cho tài khoản', 'Đăng kí tài khoản');
            }

            $request->session()->put('login', $googleUser);
            $login = $request->session()->get('login');

            return redirect()->route('home');

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    //Register member
    public function processRegisterMember(Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/registerMember/member-register');
    }

    public function showRegisterMember($registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/registerMember/show-register-member', compact('registerMember'));
    }

    public function showRegisterMemberInfo($registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::all();
        return view('frontend/pages/registerMember/show-register-member-info', compact(
            'registerMember',
            'categories'
        ));
    }

    public function showRegisterMemberPerson($member, $registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/registerMember/show-register-member-person', compact(
            'registerMember',
            'member'
        ));
    }

    public function registerMemberInfo(Request $request)
    {
        try {
            $companyName = $request->input('companyName');
            $numberBusiness = $request->input('numberBusiness');
            $codeBusiness = $request->input('codeBusiness');
            $phoneNumber = $request->input('phoneNumber');
            $fax = $request->input('fax');
            $type = $request->input('type');
            $address = $request->input('address');
            $registerMember = $request->input('member');

            $arrayIds = $this->getArrayIds($request);
            try {
                $listIDs = implode(',', $arrayIds);
            } catch (\Exception $exception) {
                alert()->error('Error', 'Error, Please choosing your apply!');
                return back();
            }

            $create = [
                'user_id' => Auth::user()->id,
                'name' => $companyName,
                'phone' => $phoneNumber,
                'fax' => $fax,
                'code_fax' => $fax,
                'category_id' => $listIDs,
                'code_business' => $codeBusiness,
                'number_business' => $numberBusiness,
                'type_business' => $type,
                'member' => $registerMember,
                'address' => $address,
                'status' => MemberRegisterInfoStatus::INACTIVE
            ];

            $success = MemberRegisterInfo::create($create);
            $newUser = MemberRegisterInfo::where([
                ['user_id', Auth::user()->id],
                ['member', $registerMember],
            ])->orderBy('created_at', 'desc')->first();
            if ($success) {
                alert()->success('Success', 'Success, Create success! Please continue next steps');
                return redirect(route('show.register.member.person.source', [
                    'member_id' => $newUser->id,
                    'registerMember' => $registerMember
                ]));
            }
            alert()->error('Error', 'Error, Create error!');
            return back();
        } catch (\Exception $exception) {

            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function registerMember(Request $request)
    {

    }

    // End register member
    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('login');

        return redirect('/');
    }

    private function getArrayIds(Request $request)
    {
        $listCategoryName[] = null;
        $arrayIds = null;
        $categories = Category::all();
        foreach ($categories as $category) {
            $name = 'category-' . $category->id;
            $listCategoryName[] = $name;
        }
        if ($listCategoryName != null) {
            $listValues = null;
            for ($i = 0; $i < count($listCategoryName); $i++) {
                $listValues[] = $request->input($listCategoryName[$i]);
            }
            if ($listValues != null) {
                for ($i = 1; $i < count($listValues); $i++) {
                    if ($listValues[$i] != null) {
                        $arrayIds[] = $listValues[$i];
                    }
                }
            }
        }
        if ($arrayIds == null) {
            alert()->error('Error', 'Error, Please choosing your apply!');
            return back();
        }
        return $arrayIds;
    }
}
