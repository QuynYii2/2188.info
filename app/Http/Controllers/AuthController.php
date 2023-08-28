<?php

namespace App\Http\Controllers;

use App\Enums\CoinStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\MemberRegisterPersonSourceStatus;
use App\Enums\MemberRegisterType;
use App\Enums\MemberStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\RegisterMember;
use App\Enums\RegisterMemberPrice;
use App\Enums\UserStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Libraries\GeoIP;
use App\Models\Category;
use App\Models\Coin;
use App\Models\Member;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Permission;
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
//            $statisticAccess = StatisticAccess::where([
//                ['user_id', Auth::user()->id],
//                ['datetime', '<', Carbon::now()->addHours(7)->copy()->endOfDay()],
//                ['datetime', '>', Carbon::now()->addHours(7)->copy()->startOfDay()],
//                ['status', StatisticStatus::ACTIVE],
//            ])->first();
//
//            if ($statisticAccess) {
//                $statisticAccess->numbers = $statisticAccess->numbers + 1;
//                $statisticAccess->save();
//            } else {
//                $statisticRevenue = [
//                    'user_id' => Auth::user()->id,
//                    'numbers' => 1,
//                    'datetime' => Carbon::now()->addHours(7),
//                ];
//
//                StatisticAccess::create($statisticRevenue);
//            }
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
            return back();
        }

        $locale = $this->getLocale($request);

        if ($user) {
            $role_id = DB::table('role_user')->where('user_id', $user->id)->get();

            $isAdmin = false;
            foreach ($role_id as $item) {
                if ($item->role_id == 1) {
                    $isAdmin = true;
                }
            }

            if ($isAdmin == false) {
                if ($locale != 'en') {
                    if ($user->region != $locale) {
                        toast('Tài khoản của bạn không dành cho khu vực này. Vui lòng chọn khu vực khách phù hợp', 'error', 'top-right');
                        return back();
                    }
                }
            }
        }

        if (Auth::attempt($credentials)) {
            $request->session()->put('login', $loginField);
            $login = $request->session()->get('login');
            $token = md5(uniqid());
            User::where('id', Auth::id())->update(['token' => $token]);
            return redirect()->route('home');
        } else {
            toast('Tên đăng nhập hoặc mật khẩu không chính xác', 'error', 'top-right');
        }

        return back();
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
    /*Show all hội viên*/
    public function processRegisterMember(Request $request)
    {
        (new HomeController())->getLocale($request);
        $members1 = Member::where([['status', '=', MemberStatus::ACTIVE]])->get();

        $index = 0;
        foreach ($members1 as $key => $value) {
            if (Auth::user()->member == $value->name) {
                $index = $key + 1;
                break;
            }
        }

        $members = [];
        for ($i = $index; $i < sizeof($members1); $i++) {
            array_push($members, $members1[$i]);
        };

        return view('frontend/pages/registerMember/member-register', compact('members'));
    }

    /*Show form đồng ý điều khoản và điều kiện*/
    public function showRegisterMember($registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        $member = Member::find($registerMember);
        if (!$member || $member->status != MemberStatus::ACTIVE) {
            alert()->error('Error', 'Error, Page not found');
            return back();
        }
        return view('frontend/pages/registerMember/show-register-member', compact('registerMember', 'member'));
    }

    /*Show form đăng kí thông tin hội viên*/
    public function showRegisterMemberInfo($registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        $categories = Category::all();
        $member = Member::find($registerMember);
        if (!$member || $member->status != MemberStatus::ACTIVE) {
            alert()->error('Error', 'Error, Page not found');
            return back();
        }
        $exitsMember = null;
        if (Auth::check()) {
            $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            if ($exitMemberPerson) {
                $exitsMember = MemberRegisterInfo::where([
                    ['id', $exitMemberPerson->member_id],
                    ['status', MemberRegisterInfoStatus::ACTIVE]
                ])->first();
            }
        }
        return view('frontend/pages/registerMember/show-register-member-info', compact(
            'registerMember', 'categories', 'member', 'exitsMember'
        ));
    }

    public function getListNation()
    {
        $listNation = DB::table('countries')->get(['name', 'iso2']);
        return response()->json($listNation);
    }

    public function getListStateByNation($id)
    {
        $listState = DB::table('states')
            ->where([['country_code', '=', $id]])
            ->get(['name', 'state_code']);
        return response()->json($listState);
    }

    public function getListCityByState($id, $code)
    {
        $listCity = DB::table('cities')
            ->where([['state_code', '=', $id], ['country_code', '=', $code]])
            ->get(['name', 'city_code']);
        return response()->json($listCity);
    }

    public function getListWardByCity($id, $code)
    {
        $listWard = DB::table('wards')
            ->where([['city_code', '=', $id], ['country_code', '=', $code]])
            ->get(['name', 'id']);
        return response()->json($listWard);
    }

    /*Show form đăng kí thông tin người đăng kí*/
    public function showRegisterMemberPerson($member, $registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        $exitMemberPerson = null;
        if (Auth::check()) {
            $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        }
        $memberPersonSource = null;
        if ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::REPRESENT) {
            $memberPersonSource = MemberRegisterPersonSource::find($exitMemberPerson->person);
        } elseif ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::SOURCE) {
            $memberPersonSource = $exitMemberPerson;
        }
        $exitsMember = null;
        if ($exitMemberPerson) {
            $exitsMember = MemberRegisterInfo::where([
                ['id', $exitMemberPerson->member_id],
                ['status', MemberRegisterInfoStatus::ACTIVE]
            ])->first();
        }
        return view('frontend/pages/registerMember/show-register-member-person', compact(
            'registerMember',
            'memberPersonSource',
            'exitsMember',
            'member'
        ));
    }

    /*Đăng kí thông tin hội viên*/
    public function registerMemberInfo(Request $request)
    {
        try {
            $memberID = $request->input('member_id');

            $address = $request->input('wards-select') . ', ' . $request->input('provinces-select') . ', ' . $request->input('cities-select') . ', ' . $request->input('countries-select');
            $companyName = $request->input('companyName');
            $numberBusiness = $request->input('numberBusiness');
            $codeBusiness = $request->input('codeBusiness');
            $phoneNumber = $request->input('phoneNumber');
            $fax = $request->input('fax');
            $type = $request->input('type');
            $registerMember = $request->input('member');


            if ($request->hasFile('giay_phep_kinh_doanh')) {
                $gpkd = $request->file('giay_phep_kinh_doanh');
                $gpkdPath = $gpkd->store('giay_phep_kinh_doanh', 'public');
            } else {
                $gpkdPath = '';
            }
            $arrayIds = $this->getArrayIds($request);
            if ($arrayIds) {
                try {
                    $listIDs = implode(',', $arrayIds);
                } catch (\Exception $exception) {
                    alert()->error('Error', 'Error, Please choosing your apply!');
                    return back();
                }
            } else {
                alert()->error('Error', 'Error, Please choosing your apply!');
                return back();
            }

//            $id = Auth::user()->id;
            $id = 0;

            if ($registerMember == RegisterMember::LOGISTIC || $registerMember == RegisterMember::TRUST || $registerMember == RegisterMember::BUYER) {
                $status = MemberRegisterInfoStatus::ACTIVE;
            } else {
                $status = MemberRegisterInfoStatus::INACTIVE;
            }

            $exitMemberPerson = null;
            if (Auth::check()) {
                $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            }

            if ($exitMemberPerson) {
                $exitsMember = MemberRegisterInfo::where([
                    ['id', $exitMemberPerson->member_id],
                    ['status', MemberRegisterInfoStatus::ACTIVE]
                ])->first();

                $exitsMember->user_id = $id;
                $exitsMember->name = $companyName;
                $exitsMember->phone = $phoneNumber;
                $exitsMember->category_id = $listIDs;
                $exitsMember->code_business = $codeBusiness;
                $exitsMember->giay_phep_kinh_doanh = $gpkdPath;
                $exitsMember->address = $address;
                $exitsMember->member_id = $memberID;
                $exitsMember->member = $registerMember;
                $exitsMember->status = $status;

                $success = $exitsMember->save();
                $newUser = $exitsMember;
            } else {
                $create = [
                    'user_id' => $id,
                    'name' => $companyName,
                    'phone' => $phoneNumber,
                    'fax' => 'default',
                    'code_fax' => 'default',
                    'category_id' => $listIDs,
                    'code_business' => $codeBusiness,
                    'number_business' => 'default',
                    'type_business' => 'default',
                    'member' => $registerMember,
                    'address' => $address,
                    'member_id' => $memberID,
                    'status' => $status,
                    'giay_phep_kinh_doanh' => $gpkdPath,
                ];

                $success = MemberRegisterInfo::create($create);
                $newUser = MemberRegisterInfo::where([
                    ['user_id', $id],
                    ['member', $registerMember],
                ])->orderBy('created_at', 'desc')->first();
            }
//            if ($exitsMember) {
//                alert()->error('Error', 'Error, Đã tồn tại hội viên, không thể thêm mới!');
//                return redirect(route('member.registered.detail'));
//            }

//            $user = Auth::user();
//            $user->member = $registerMember;
//            $user->save();
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

    /*Đăng kí thông tin người đăng kí*/
    public function registerMemberPerson(Request $request)
    {
        try {
            $fullName = $request->input('fullName');
            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');
            $phoneNumber = $request->input('phoneNumber');
            $email = $request->input('email');
            $rank = $request->input('rank');
            $sns_account = $request->input('sns_account');
            $member = $request->input('member');

            if ($password !== $passwordConfirm) {
                alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                return back();
            }

            $password = Hash::make($password);

            $code = (new  HomeController())->generateRandomString(6);

            $data = array('mail' => $email, 'name' => $email, 'code' => $code);

//            $id = Auth::user()->id;
            $id = 0;

            $newID = (integer)$member;

            $memberAccount = MemberRegisterInfo::find($newID);
            $typeMember = $memberAccount->member;
            if ($typeMember == RegisterMember::POWER_PRODUCTION) {
                $price = RegisterMemberPrice::POWER_PRODUCTION;
            } elseif ($typeMember == RegisterMember::PRODUCTION) {
                $price = RegisterMemberPrice::PRODUCTION;
            } elseif ($typeMember == RegisterMember::POWER_VENDOR) {
                $price = RegisterMemberPrice::POWER_VENDOR;
            } else {
                $price = RegisterMemberPrice::VENDOR;
            }
            //member

            $exitMemberPerson = null;
            if (Auth::check()) {
                $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            }

            $memberPersonSource = null;
            if ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::REPRESENT) {
                $memberPersonSource = MemberRegisterPersonSource::find($exitMemberPerson->person);
            } elseif ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::SOURCE) {
                $memberPersonSource = $exitMemberPerson;
            }
            $exitsMember = null;
            if ($exitMemberPerson) {
                $exitsMember = MemberRegisterInfo::where([
                    ['id', $exitMemberPerson->member_id],
                    ['status', MemberRegisterInfoStatus::ACTIVE]
                ])->first();
            }

            $create = [
                'user_id' => $id,
                'name' => $fullName,
                'password' => $password,
                'phone' => $phoneNumber,
                'email' => $email,
                'rank' => $rank,
                'member_id' => $member,
                'sns_account' => $sns_account,
                'type' => MemberRegisterType::SOURCE,
                'verifyCode' => $code,
                'isVerify' => 0,
                'price' => $price,
                'status' => MemberRegisterPersonSourceStatus::INACTIVE
            ];

            if ($memberPersonSource) {
                $user = User::where('email', $memberPersonSource->email)->first();
                $memberPersonSource->user_id = $id;
                $memberPersonSource->name = $fullName;
                $memberPersonSource->phone = $phoneNumber;
                $memberPersonSource->rank = $rank;
                $memberPersonSource->member_id = $member;
                $memberPersonSource->sns_account = $sns_account;
                $memberPersonSource->price = $price;
                $memberPersonSource->status = MemberRegisterPersonSourceStatus::INACTIVE;
                if ($email == $memberPersonSource->email) {
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPersonSource->email = $email;
                    $success = $memberPersonSource->save();
                    $register = MemberRegisterInfo::find($member);
                    alert()->success('Success', 'Success, Create success! Please continue next steps');
                    return redirect(route('show.register.member.person.represent', [
                        'person_id' => $memberPersonSource->id,
                        'registerMember' => $register->member
                    ]));
                } else {
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPersonSource->email = $email;
                    $user = User::where('email', Auth::user()->email)->first();
                    $user->email = $email;
                    $this->sendMail($data, $email);
                    $user->save();
                    $memberPersonSource->isVerify = 0;
                    $memberPersonSource->verifyCode = $code;
                    $success = $memberPersonSource->save();
                }
            } else {
                $userOld = User::where('email', $email)->first();
                if ($userOld) {
                    alert()->error('Error', 'Error, Email is user used!');
                    return back();
                }

                $memberOld = MemberRegisterPersonSource::where('email', $email)->first();
                if ($memberOld) {
                    alert()->error('Error', 'Error, Email in member used!');
                    return back();
                }

                $this->sendMail($data, $email);
                $this->createUser($fullName, $email, $phoneNumber, $password, $memberAccount->member);
                $success = MemberRegisterPersonSource::create($create);
            }

            if ($success) {
                alert()->success('Success', 'Success, Create success! Please continue next steps');
                return redirect(route('show.verify.register.member', $email));
            }
            alert()->error('Error', 'Error, Create error!');
            return back();
        } catch (\Exception $exception) {
            dd($exception);
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    /*Show form đăng kí thông tin người đại diện*/
    public function showRegisterMemberPersonRepresent($person, $registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        $exitMemberPerson = null;
        if (Auth::check()) {
            $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
        }
        $memberPerson = null;
        if ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::SOURCE) {
            $memberPerson = MemberRegisterPersonSource::where('person', $exitMemberPerson->id)->first();
        } elseif ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::REPRESENT) {
            $memberPerson = $exitMemberPerson;
        }
        return view('frontend/pages/registerMember/show-register-member-person-repersent', compact(
            'registerMember',
            'memberPerson',
            'person'
        ));
    }

    /*Đăng kí thông tin người đại diện*/
    public function registerMemberPersonRepresent(Request $request)
    {
        try {
            $fullName = $request->input('fullName');
            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');
            $phoneNumber = $request->input('phoneNumber');
            $email = $request->input('email');
            $staff = $request->input('staff');
            $sns_account = $request->input('sns_account');
            $personSource = $request->input('person');

            if ($password !== $passwordConfirm) {
                alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                return back();
            }

            $password = Hash::make($password);

            $code = (new  HomeController())->generateRandomString(6);

            $data = array('mail' => $email, 'name' => $email, 'code' => $code);

//            $id = Auth::user()->id;
            $id = 0;

            $memberBefore = MemberRegisterPersonSource::where('id', $personSource)->first();
            $memberAccount = MemberRegisterInfo::find($memberBefore->member_id);

            $create = [
                'user_id' => $id,
                'name' => $fullName,
                'password' => $password,
                'phone' => $phoneNumber,
                'email' => $email,
                'person' => $personSource,
                'staff' => $staff,
                'member_id' => $memberBefore->member_id,
                'price' => $memberBefore->price,
                'rank' => '0',
                'sns_account' => $sns_account,
                'type' => MemberRegisterType::REPRESENT,
                'verifyCode' => $code,
                'isVerify' => 0,
                'status' => MemberRegisterPersonSourceStatus::INACTIVE
            ];

            $exitMemberPerson = null;
            if (Auth::check()) {
                $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            }
            $memberPerson = null;
            if ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::SOURCE) {
                $memberPerson = MemberRegisterPersonSource::where('person', $exitMemberPerson->id)->first();
            } elseif ($exitMemberPerson && $exitMemberPerson->type == MemberRegisterType::REPRESENT) {
                $memberPerson = $exitMemberPerson;
            }
            $exitsMember = null;
            if ($exitMemberPerson) {
                $exitsMember = MemberRegisterInfo::where([
                    ['id', $exitMemberPerson->member_id],
                    ['status', MemberRegisterInfoStatus::ACTIVE]
                ])->first();
            }

            if ($memberPerson) {
                $user = User::where('email', $memberPerson->email)->first();
                $memberPerson->user_id = $id;
                $memberPerson->name = $fullName;
                $memberPerson->phone = $phoneNumber;
                $memberPerson->member_id = $memberBefore->member_id;
                $memberPerson->sns_account = $sns_account;
                $memberPerson->price = $memberBefore->price;
                $memberPerson->status = MemberRegisterPersonSourceStatus::INACTIVE;
                if ($email == $memberPerson->email) {
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPerson->email = $email;
                    $success = $memberPerson->save();
                    alert()->success('Success', 'Success');
                    return redirect(route('home'));
                } else {
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPerson->email = $email;
                    $user = User::where('email', Auth::user()->email)->first();
                    $user->email = $email;
                    $this->sendMail($data, $email);
                    $user->save();
                    $memberPerson->isVerify = 0;
                    $memberPerson->verifyCode = $code;
                    $success = $memberPerson->save();
                }
            } else {
                $userOld = User::where('email', $email)->first();
                if ($userOld) {
                    alert()->error('Error', 'Error, Email is user used!');
                    return back();
                }

                $memberOld = MemberRegisterPersonSource::where('email', $email)->first();
                if ($memberOld) {
                    alert()->error('Error', 'Error, Email in member used!');
                    return back();
                }
                $this->sendMail($data, $email);
                $this->createUser($fullName, $email, $phoneNumber, $password, $memberAccount->member);

                $success = MemberRegisterPersonSource::create($create);
            }
            if ($success) {
                alert()->success('Success', 'Success, Create success! Please continue next steps');
                return redirect(route('show.verify.register.member', $email));
            }
            alert()->error('Error', 'Error, Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    /*Show form thanh toán đăng ký hội viên*/
    public function showPaymentMember($registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend.pages.registerMember.payment-member', compact('registerMember'));
    }

    /*Thanh toán đăng ký hội viên*/
    public function paymentMember(Request $request)
    {
        try {
            $member = $request->input('member_id');
            $member = MemberRegisterInfo::find($member);
            if ($member->status == MemberRegisterInfoStatus::ACTIVE) {
                alert()->error('Error', 'Error, Member not payment!');
                return back();
            }
            $role = $request->input('role');
            $price = $request->input('price');

            $coin = Coin::where([['user_id', Auth::user()->id], ['status', CoinStatus::ACTIVE]])->first();
            $member->status = MemberRegisterInfoStatus::ACTIVE;

            if ($coin != null) {
                if ($coin->quantity >= $price * 10) {
                    $coin->quantity = $coin->quantity - $price * 10;
                    $coin->save();
                    $success = $member->save();
                    $relaseMember = MemberRegisterPersonSource::where('member_id', $member->id)->get();

                    foreach ($relaseMember as $item) {
                        $item->check = 1;
                        $item->price = 0;
                        $item->save();
                    }

                    if ($success) {
                        alert()->success('Success', 'Payment success!');
                        return redirect(route('show.success.payment.member', $member->id));
                    }
                } else {
                    alert()->error('Error', 'Not enough coin! Buy coin now!!!');
                    return redirect(route('buy.coin.show'));
                }
            }
            alert()->error('Error', 'Error, Payment error! Buy coin now!!!');
            return redirect(route('buy.coin.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    /*Show form success hội viên*/
    public function successRegisterMember($registerMember, Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend.pages.registerMember.success-member', compact('registerMember'));
    }

    /*Show form nhập verify code để send mail*/
    public function processVerifyEmail($email, Request $request)
    {
        (new HomeController())->getLocale($request);
        return view('frontend/pages/registerMember/verify-email', compact(
            'email',
        ));
    }

    /*Verify code*/
    public function verifyEmail(Request $request)
    {
        try {
            $email = $request->input('processEmail');
            $code = $request->input('code');
            $member = MemberRegisterPersonSource::where([
                ['email', $email],
                ['isVerify', 0]
            ])->first();
            if (!$member) {
                alert()->error('Error', 'Error, Member not found!');
                return back();
            }

            if ($member->verifyCode != $code) {
                alert()->error('Error', 'Error, Verify code incorrect!');
                return back();
            }
            $member->verifyCode = '';
            $member->isVerify = 1;
            $member->status = MemberRegisterPersonSourceStatus::ACTIVE;

            $register = MemberRegisterInfo::find($member->member_id);
            $success = $member->save();

            if ($success) {
                if ($member->type == MemberRegisterType::SOURCE) {
                    alert()->success('Success', 'Success, Verify success! Please continue next steps');
                    return redirect(route('show.register.member.person.represent', [
                        'person_id' => $member->id,
                        'registerMember' => $register->member
                    ]));
                } else {
                    alert()->success('Success', 'Success, Verify success! Please login and paid bill');
                    return redirect(route('login'));
                }
            }
            alert()->error('Error', 'Error, Verify error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
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
        if (!$arrayIds) {
            return null;
        }
        return $arrayIds;
    }

    private function sendMail($data, $email)
    {
        Mail::send('frontend/widgets/mailCode', $data, function ($message) use ($email) {
            $message->to($email, 'Verify mail!')->subject
            ('Verify mail');
            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
        });
    }

    private function createUser($fullName, $email, $phoneNumber, $password, $member)
    {
        $locale = app()->getLocale();
        if (!$locale) {
            $locale = 'vi';
        }
        $user = new User;
        $user->name = $fullName;
        $user->email = $email;
        $user->phone = $phoneNumber;
        $user->address = 'Default';
        $user->rental_code = 'Default';
        $user->social_media = 'Default';
        $user->industry = 'Default';
        $user->product_name = 'Default';
        $user->product_code = 'Default';
        $user->password = $password;
        $user->type_account = 'seller';
        $user->region = $locale;
        $user->member = $member;
        $user->image = 'Default';
        $user->save();

        $newUser = User::where('email', $email)->first();
        if ($member != RegisterMember::BUYER) {
            $roleUser = DB::table('role_user')->insert([
                'role_id' => 2,
                'user_id' => $newUser->id
            ]);
        }

//        $currentUser = Auth::user();
//        $seller = (new HomeController())->checkSellerOrAdmin();
//        if ($seller == false) {
//            $roleUser = DB::table('role_user')->insert([
//                'role_id' => 2,
//                'user_id' => $currentUser->id
//            ]);
//        }
    }

    private function getLocale(Request $request)
    {
        $ipAddress = $request->ip();
        $geoIp = new GeoIP();
        $locale = $geoIp->get_country_from_ip($ipAddress);
        if ($locale !== null && is_array($locale)) {
            $locale = $locale['countryCode'];
        }
        return $locale;
    }

    private function updateUser($user, $fullName, $email, $phoneNumber, $member)
    {
        $user->name = $fullName;
        $user->email = $email;
        $user->phone = $phoneNumber;
        $user->member = $member;
        $user->save();
    }
}
