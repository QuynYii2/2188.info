<?php

namespace App\Http\Controllers\Member;

use App\Enums\CategoryStatus;
use App\Enums\CoinStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\MemberRegisterPersonSourceStatus;
use App\Enums\MemberRegisterType;
use App\Enums\MemberStatus;
use App\Enums\RegisterMember;
use App\Enums\RegisterMemberPrice;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\Coin;
use App\Models\Member;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\StaffUsers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterMemberController extends Controller
{
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
        }

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
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
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

        $categories_no_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', null]
        ])->get();

        $categories_one_parent_array = null;
        foreach ($categories_no_parent as $category) {
            $categories_oneparent = Category::where([
                ['status', CategoryStatus::ACTIVE],
                ['parent_id', $category->id]
            ])->get();
            foreach ($categories_oneparent as $item) {
                $categories_one_parent_array[] = $item;
            }
        }

        $categories_one_parent = collect($categories_one_parent_array);

        $categories_two_parent_array = null;
        foreach ($categories_one_parent as $category) {
            $categories_twoparent = Category::where([
                ['status', CategoryStatus::ACTIVE],
                ['parent_id', $category->id]
            ])->get();
            foreach ($categories_twoparent as $item) {
                $categories_two_parent_array[] = $item;
            }
        }

        $categories_two_parent = collect($categories_two_parent_array);
        return view('frontend/pages/registerMember/show-register-member-info', compact(
            'registerMember', 'categories', 'member', 'exitsMember',
            'categories_no_parent', 'categories_one_parent', 'categories_two_parent'
        ));
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

    /*Đăng kí thông tin hội viên BUYER*/
    /*Riêng là hội viên BUYER khi đăng ký sẽ gộp các bước lại làm một bước*/
    public function registerMemberBuyer(Request $request)
    {
        try {
            /* Check user exited*/
            $memberID = $request->input('member_id');
            $address = $request->input('wards-select') . ', ' . $request->input('provinces-select') . ', ' . $request->input('cities-select') . ', ' . $request->input('countries-select');
            $companyName = $request->input('name_en');
            $numberBusiness = 'default';
            $phoneNumber = $request->input('phoneNumber');
            $fax = 'default';
            $registerMember = $request->input('member');
            $datetime_register = Carbon::now()->addHours(7);
            $number_clearance = $request->input('number_clearance');
            $name_kr = $request->input('name_kr');
            $codeItem = $request->input('code');

            $comma = ',';
            $address_en =
                $request->input('countries-select') . $comma .
                $request->input('cities-select') . $comma .
                $request->input('provinces-select') . $comma .
                $request->input('detail-address');
            $address_kr =
                $request->input('countries-select-1') . $comma .
                $request->input('cities-select-1') . $comma .
                $request->input('provinces-select-1') . $comma .
                $request->input('detail-address-1');
            $address = $address_en;

            $certify_business = '';
            $gpkdPath = '';
            /*Thông tin người đăng ký và đăng ký user*/
            // MemberPerson + User
            $fullName = $request->input('name');
            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');
            $email = $request->input('email');
            $sns_account = $request->input('sns_account');
            $member = $request->input('member');
            //
            $name_en = $request->input('name_en');

            $password = Hash::make($password);

            $price = 0;

            $code_1 = $request->input('code_1');
            $code_2 = $request->input('code_2');

            if (is_array($code_2)) {
                $code_2 = implode(',', $code_2);
            } else {
                $code_2 = '';
            }

            if (is_array($code_1)) {
                $code_1 = implode(',', $code_1);
            } else {
                $code_1 = '';
            }

            $categoryIds = $code_1 . ',' . $code_2;

            $arrayCategoryID = explode(',', $categoryIds);
            sort($arrayCategoryID);
            $categoryIds = implode(',', $arrayCategoryID);

            $id = 0;

            $status = MemberRegisterInfoStatus::ACTIVE;

            if (Auth::check()) {
                $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
                $exitMemberInfo = MemberRegisterInfo::where('id', $exitMemberPerson->member_id)->first();

                $exitMemberInfo->name_en = $companyName;
                $exitMemberInfo->name_kr = $name_kr;
                $exitMemberInfo->name = $fullName;

                $exitMemberInfo->number_clearance = $number_clearance;

                $exitMemberInfo->email = $email;
                $exitMemberInfo->phone = $phoneNumber;

                $exitMemberInfo->address = $address;
                $exitMemberInfo->address_en = $address_en;
                $exitMemberInfo->address_kr = $address_kr;

                $exitMemberInfo->category_id = $categoryIds;
                $exitMemberInfo->code_business = $code_2;
                $exitMemberInfo->type_business = $code_1;

                $success = $exitMemberInfo->save();
                if ($success) {
                    alert()->success('Success', 'Update success!');
                } else {
                    alert()->error('Error', 'Update error!');
                }
                return back();
            }
            /*Thông tin công ty đăng ký*/
            // MemberInfo

            $create = [
                'user_id' => $id,
                'name' => $companyName,
                'phone' => $phoneNumber,
                'fax' => $fax,
                'code_fax' => 'default',
                'sns_account' => $sns_account,
                'category_id' => $categoryIds,
                'code_business' => $categoryIds,
                'number_business' => $numberBusiness,
                'type_business' => $categoryIds,
                'member' => $registerMember,
                'address' => $address,
                'member_id' => $memberID,
                'status' => $status,
                'giay_phep_kinh_doanh' => $gpkdPath,
                'email' => $email,
                'datetime_register' => $datetime_register,
                'number_clearance' => $number_clearance,
                'name_en' => $name_en,
                'code' => $codeItem,
                'name_kr' => $name_kr,
                'address_en' => $address_en,
                'address_kr' => $address_kr,
                'certify_business' => $certify_business,
            ];

            if (!Hash::check($passwordConfirm, $password)) {
                alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                return back()->with('create', $create);
            }

            $userOld = User::where('email', $email)->first();
            if ($userOld) {
                alert()->error('Error', 'Error, Email is user used!');
                return back()->with('create', $create);
            }

            $memberOld = MemberRegisterPersonSource::where('email', $email)->first();
            if ($memberOld) {
                alert()->error('Error', 'Error, Email in member used!');
                return back()->with('create', $create);
            }

            $success = MemberRegisterInfo::create($create);

            if (!$success) {
                alert()->error('Error', 'Register error, Please try again!');
                return back()->with('create', $create);
            }

            $newMember = MemberRegisterInfo::where([
                ['phone', $phoneNumber],
                ['name_en', $name_en],
                ['name_kr', $name_kr],
                ['member_id', $memberID],
            ])->first();

            $memberRegister = [
                'user_id' => $id,
                'name' => $fullName,
                'password' => $password,
                'phone' => $phoneNumber,
                'email' => $email,
                'rank' => '',
                'member_id' => $newMember->id,
                'sns_account' => $sns_account,
                'type' => MemberRegisterType::SOURCE,
                'verifyCode' => '',
                'isVerify' => 0,
                'price' => $price,
                'datetime_register' => $datetime_register,
                'name_en' => $name_en,
                'status' => MemberRegisterPersonSourceStatus::ACTIVE
            ];

            $this->createUser($fullName, $email, $phoneNumber, $password, RegisterMember::BUYER, $request);
            $save = MemberRegisterPersonSource::create($memberRegister);

            $member = MemberRegisterPersonSource::where([
                ['email', $email],
                ['isVerify', 0]
            ])->first();

            if ($save) {
                alert()->success('Success', 'Success, Create success! Please continue next steps');
                return redirect(route('show.register.member.congratulation', $member->id));
            }
            alert()->error('Error', 'Error, Create error!');
            return back()->with('create', $create);
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back()->with('create', $create);
        }
    }

    /*Đăng kí thông tin hội viên không phải là hội viên buyer*/
    public function registerMemberInfo(Request $request)
    {
        try {
            $memberID = $request->input('member_id');

            $companyName = $request->input('name_en');
            $email = $request->input('email');
            $homepage = $request->input('homepage');
            $numberBusiness = $request->input('number_business');
            $phoneNumber = $request->input('phone');
            $fax = $request->input('fax');
            if (!$fax) {
                $fax = 'default';
            }
            $registerMember = $request->input('member');
            //
            $datetime_register = Carbon::now()->addHours(7);
            $number_clearance = $request->input('number_clearance');
            $name_en = $request->input('name_en');
            $name_kr = $request->input('name_kr');

            $comma = ',';
            $address_en =
                $request->input('countries-select') . $comma .
                $request->input('cities-select') . $comma .
                $request->input('provinces-select') . $comma .
                $request->input('detail-address');
            $address_kr =
                $request->input('countries-select-1') . $comma .
                $request->input('cities-select-1') . $comma .
                $request->input('provinces-select-1') . $comma .
                $request->input('detail-address-1');
            $address = $address_en;
            //file
            if ($request->hasFile('certify_business')) {
                $gpkd = $request->file('certify_business');
                $certify_business = $gpkd->store('certify_business', 'public');
            } else {
                $certify_business = '';
            }

            $status_business = $request->input('status_business');

            $code_1 = $request->input('code_1');
            $code_2 = $request->input('code_2');
            $code_3 = $request->input('code_3');
            $code_4 = $request->input('code_4');

            if ($request->hasFile('giay_phep_kinh_doanh')) {
                $gpkd = $request->file('giay_phep_kinh_doanh');
                $gpkdPath = $gpkd->store('giay_phep_kinh_doanh', 'public');
            } else {
                $gpkdPath = null;
            }

            $code_business = $request->input('code_business');
            $type_business = $request->input('type_business');

            $updateInfo = $request->input('updateInfo');

            if (is_array($code_1)) {
                $code_1 = implode(',', $code_1);
            }

            if (is_array($code_2)) {
                $code_2 = implode(',', $code_2);
            }

            if (is_array($code_3)) {
                $code_3 = implode(',', $code_3);
            }

            $categoryIds = $code_1 . ',' . $code_2 . ',' . $code_3;
            $arrayCategoryID = explode(',', $categoryIds);
            sort($arrayCategoryID);
            $categoryIds = implode(',', $arrayCategoryID);

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

            $code_1_item = $code_1;
            $code_2_item = $code_2;
            $code_3_item = $code_3;

            $create = [
                'user_id' => $id,
                'name' => $companyName,
                'phone' => $phoneNumber,
                'fax' => $fax,
                'email' => $email,
                'homepage' => $homepage,
                'code_fax' => 'default',
                'category_id' => $categoryIds,
                'code_business' => $code_business,
                'number_business' => $numberBusiness,
                'type_business' => $type_business,
                'member' => $registerMember,
                'address' => $address,
                'member_id' => $memberID,
                'status' => $status,
                'giay_phep_kinh_doanh' => $gpkdPath,

                'datetime_register' => $datetime_register,
                'number_clearance' => $number_clearance,
                'name_en' => $name_en,
                'name_kr' => $name_kr,
                'address_en' => $address_en,
                'address_kr' => $address_kr,
                'certify_business' => $certify_business,
                'status_business' => $status_business,
                'code_1' => $code_1_item,
                'code_2' => $code_2_item,
                'code_3' => $code_3_item,
                'code_4' => $code_4,
            ];

            if ($exitMemberPerson) {
                $exitsMember = MemberRegisterInfo::where([
                    ['id', $exitMemberPerson->member_id],
                    ['status', MemberRegisterInfoStatus::ACTIVE]
                ])->first();

                if (!$gpkdPath) {
                    $gpkdPath = $exitsMember->giay_phep_kinh_doanh;
                }

                $exitsMember->user_id = $id;
                $exitsMember->name = $companyName;
                $exitsMember->email = $email;
                $exitsMember->phone = $phoneNumber;
                $exitsMember->category_id = $categoryIds;
                $exitsMember->number_business = $numberBusiness;
                $exitsMember->type_business = $type_business;
                $exitsMember->code_business = $code_business;
                $exitsMember->giay_phep_kinh_doanh = $gpkdPath;
                $exitsMember->address = $address;
                $exitsMember->member_id = $memberID;
                $exitsMember->member = $registerMember;
                $exitsMember->status = $status;

                $exitsMember->number_clearance = $number_clearance;
                $exitsMember->name_en = $name_en;
                $exitsMember->name_kr = $name_kr;
                $exitsMember->address_en = $address_en;
                $exitsMember->address_kr = $address_kr;
                $exitsMember->certify_business = $certify_business;
                $exitsMember->status_business = $status_business;
                $exitsMember->code_1 = $code_1_item;
                $exitsMember->code_2 = $code_2_item;
                $exitsMember->code_3 = $code_3_item;
                $exitsMember->code_4 = $code_4;
                $exitsMember->homepage = $homepage;

                $success = $exitsMember->save();
                if ($success) {
                    alert()->success('Success', 'Success, Update success!');
                    if ($updateInfo) {
                        return back()->with('createCompany', $create);
                    }
                    return redirect(route('show.register.member.person.source', [
                        'member_id' => $exitsMember->id,
                        'registerMember' => $registerMember
                    ]));
                }
                alert()->error('Error', 'Error, Create error!');
                return back()->with('createCompany', $create);

            } else {
                $memberOld = MemberRegisterPersonSource::where('email', $email)->first();
                if ($memberOld) {
                    alert()->error('Error', 'Error, Email in member used!');
                    return back()->with('createCompany', $create);
                }

                $success = MemberRegisterInfo::create($create);
                $newUser = MemberRegisterInfo::where([
                    ['user_id', $id],
                    ['member', $registerMember],
                ])->orderBy('created_at', 'desc')->first();
            }
            if ($success) {
                alert()->success('Success', 'Success, Create success! Please continue next steps');
                return redirect(route('show.register.member.person.source', [
                    'member_id' => $newUser->id,
                    'registerMember' => $registerMember
                ]));
            }
            alert()->error('Error', 'Error, Create error!');
            return back()->with('createCompany', $create);
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back()->with('createCompany', $create);
        }
    }

    /*Đăng kí thông tin người đăng kí*/
    public function registerMemberPerson(Request $request)
    {
        try {
            $fullName = $request->input('name');
            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');
            $phoneNumber = $request->input('phoneNumber');
            $email = $request->input('email');
            $rank = $request->input('rank');
            $sns_account = $request->input('sns_account');
            $member = $request->input('member');
            //
            $datetime_register = Carbon::now()->addHours(7);
            $name_en = $request->input('name_en');
            $responsibility = $request->input('responsibility');
            $position = $request->input('position');
            $codeItem = $request->input('code');

            $password = Hash::make($password);

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
                'verifyCode' => '',
                'isVerify' => 0,
                'price' => $price,
                'datetime_register' => $datetime_register,
                'name_en' => $name_en,
                'responsibility' => $responsibility,
                'position' => $position,
                'code' => $codeItem,
                'status' => MemberRegisterPersonSourceStatus::ACTIVE
            ];

            if (!Hash::check($passwordConfirm, $password)) {
                alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                return back()->with('create', $create);
            }

            $userOld = User::where('email', $email)->first();
            $memberOld = MemberRegisterPersonSource::where('email', $email)->first();
            $memberOld_v2 = MemberRegisterPersonSource::where('code', $codeItem)->first();

            $url = url()->previous();
            $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

            if ($memberPersonSource) {
                $user = User::where('email', $memberPersonSource->email)->first();
                $memberPersonSource->user_id = $id;
                $memberPersonSource->name = $fullName;
                $memberPersonSource->phone = $phoneNumber;
                $memberPersonSource->rank = $rank;

                $memberPersonSource->sns_account = $sns_account;
                $memberPersonSource->price = $price;

                $memberPersonSource->datetime_register = $datetime_register;
                $memberPersonSource->name_en = $name_en;
                $memberPersonSource->position = $position;
                $memberPersonSource->responsibility = $responsibility;


                if ($email == $memberPersonSource->email) {
                    if ($exitsMember->member != RegisterMember::TRUST) {
                        DB::table('role_user')->insert([
                            'role_id' => 2,
                            'user_id' => $user->id
                        ]);
                    }
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPersonSource->status = MemberRegisterPersonSourceStatus::ACTIVE;
                    $memberPersonSource->email = $email;
                    $memberPersonSource->save();

                    $register = MemberRegisterInfo::find($member);

                    if ($route == 'profile.member.person') {
                        alert()->success('Success', 'Success, Update success!');
                        return back()->with('create', $create);
                    }

                    alert()->success('Success', 'Success, Create success! Please continue next steps');
                    return redirect(route('show.register.member.person.represent', [
                        'person_id' => $memberPersonSource->id,
                        'registerMember' => $register->member
                    ]));
                } else {
                    if ($userOld) {
                        alert()->error('Error', 'Error, Email is user used!');
                        return back()->with('create', $create);
                    }

                    if ($memberOld) {
                        alert()->error('Error', 'Error, Email in member used!');
                        return back()->with('create', $create);
                    }
                    if ($exitsMember->member != RegisterMember::TRUST) {
                        DB::table('role_user')->insert([
                            'role_id' => 2,
                            'user_id' => $user->id
                        ]);
                    }
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPersonSource->status = MemberRegisterPersonSourceStatus::ACTIVE;
                    $memberPersonSource->email = $email;

                    $memberPersonSource->isVerify = 0;
                    $memberPersonSource->verifyCode = '';
                    $success = $memberPersonSource->save();

                    if ($route == 'profile.member.person') {
                        alert()->success('Success', 'Success, Update success!');
                        return back()->with('create', $create);
                    }
                }
            } else {
                if ($userOld) {
                    alert()->error('Error', 'Error, Email is user used!');
                    return back()->with('create', $create);
                }

                if ($memberOld) {
                    alert()->error('Error', 'Error, Email in member used!');
                    return back()->with('create', $create);
                }

                if ($memberOld_v2) {
                    alert()->error('Error', 'Error, Code in member used!');
                    return back()->with('create', $create);
                }

                $this->createUser($fullName, $email, $phoneNumber, $password, $memberAccount->member, $request);
                $success = MemberRegisterPersonSource::create($create);
            }

            $register = MemberRegisterInfo::find($member);
            $member = MemberRegisterPersonSource::where([
                ['email', $email],
                ['isVerify', 0]
            ])->first();

            $checkMember = $request->input('checkMember');

            if ($success) {
                alert()->success('Success', 'Success, Create success! Please continue next steps');
                if ($typeMember == RegisterMember::TRUST) {
                    return redirect(route('show.register.member.person.represent', [
                        'person_id' => $member->id,
                        'registerMember' => $register->member
                    ]));
                }
                if ($checkMember) {
                    return redirect(route('show.register.member.ship', $member->id));
                }
                return redirect(route('subscription.options.member.person', $member->id));
            }
            alert()->error('Error', 'Error, Create error!');
            return back()->with('create', $create);
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back()->with('create', $create);
        }
    }

    public function showSubscriptionOptions(Request $request, $member)
    {
        (new HomeController())->getLocale($request);
        $member = MemberRegisterPersonSource::find($member);
        if (!$member) {
            return back();
        }
        $register = MemberRegisterInfo::find($member->member_id);
        return view('frontend.pages.registerMember.subscription-options', compact('member', 'register'));
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
        $create = null;
        try {
            $fullName = $request->input('name');
            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');
            $phoneNumber = $request->input('phoneNumber');
            $email = $request->input('email');
            $staff = $request->input('rank');
            $sns_account = $request->input('sns_account');
            $personSource = $request->input('person');
            //
            $datetime_register = Carbon::now()->addHours(7);
            $name_en = $request->input('name_en');
            $responsibility = $request->input('responsibility');
            $position = $request->input('position');
            $codeItem = $request->input('code');

            $password = Hash::make($password);

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
                'verifyCode' => '',
                'isVerify' => 0,

                'datetime_register' => $datetime_register,
                'name_en' => $name_en,
                'responsibility' => $responsibility,
                'position' => $position,
                'code' => $codeItem,

                'status' => MemberRegisterPersonSourceStatus::ACTIVE
            ];

            if (!Hash::check($passwordConfirm, $password)) {
                alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                return back()->with('create', $create);
            }

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

            $userOld = User::where('email', $email)->first();
            $memberOld = MemberRegisterPersonSource::where('email', $email)->first();
            $memberOld_v2 = MemberRegisterPersonSource::where('code', $codeItem)->first();

            // Get previous url
            $url = url()->previous();
            $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

            if ($memberPerson) {
                $user = User::where('email', $memberPerson->email)->first();
                $memberPerson->user_id = $id;
                $memberPerson->name = $fullName;
                $memberPerson->phone = $phoneNumber;

                $memberPerson->sns_account = $sns_account;
                $memberPerson->price = $memberBefore->price;

                $memberPerson->datetime_register = $datetime_register;
                $memberPerson->name_en = $name_en;
                $memberPerson->position = $position;
                $memberPerson->responsibility = $responsibility;

                $memberPerson->status = MemberRegisterPersonSourceStatus::ACTIVE;
                if ($email == $memberPerson->email) {
                    $memberPerson->status = MemberRegisterPersonSourceStatus::ACTIVE;
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPerson->email = $email;
                    $memberPerson->save();

                    if ($route == 'profile.member.represent') {
                        alert()->success('Success', 'Success, Update success!');
                        return back()->with('create', $create);
                    }

                    alert()->success('Success', 'Success');
                    return redirect(route('show.register.member.ship', $memberBefore->member_id));
                } else {
                    if ($userOld) {
                        alert()->error('Error', 'Error, Email is user used!');
                        return back()->with('create', $create);
                    }
                    if ($memberOld) {
                        alert()->error('Error', 'Error, Email in member used!');
                        return back()->with('create', $create);
                    }
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPerson->email = $email;
                    $memberPerson->isVerify = 0;
                    $memberPerson->verifyCode = '';
                    $success = $memberPerson->save();
                    if ($route == 'profile.member.represent') {
                        alert()->success('Success', 'Success, Update success!');
                        return back()->with('create', $create);
                    }
                }
            } else {
                if ($userOld) {
                    alert()->error('Error', 'Error, Email is user used!');
                    return back()->with('create', $create);
                }
                if ($memberOld) {
                    alert()->error('Error', 'Error, Email in member used!');
                    return back()->with('create', $create);
                }
                if ($memberOld_v2) {
                    alert()->error('Error', 'Error, Code in member used!');
                    return back()->with('create', $create);
                }
                $this->createUser($fullName, $email, $phoneNumber, $password, $memberAccount->member, $request);
                $success = MemberRegisterPersonSource::create($create);
            }

            $member = MemberRegisterPersonSource::where([
                ['email', $email],
                ['isVerify', 0]
            ])->first();
            $register = MemberRegisterInfo::find($member->member_id);
            if ($success) {
                alert()->success('Success', 'Success, Create success! Please continue next steps');
                if ($register->member == RegisterMember::TRUST) {
                    return redirect(route('show.register.member.congratulation', $member->id));
                }
                return redirect(route('show.register.member.ship', $member->id));
            }
            alert()->error('Error', 'Error, Create error!');
            return back()->with('create', $create);
        } catch (\Exception $exception) {
            dd($exception);
            alert()->error('Error', 'Error, Please try again!');
            if ($create) {
                return back()->with('create', $create);
            } else {
                return back();
            }
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

    /*Show form register membership*/
    public function registerMemberShip($member, Request $request)
    {
        (new HomeController())->getLocale($request);
        $memberRepresent = MemberRegisterPersonSource::find($member);
        if (!$memberRepresent) {
            return back();
        }
        $memberSource = MemberRegisterPersonSource::find($memberRepresent->person);
        $findMember = $memberRepresent->email;
        $userRepresent = User::where('email', $findMember)->first();
        $staffUsers = StaffUsers::where('parent_user_id', $userRepresent->id)->get();
        return view('frontend.pages.registerMember.membership',
            compact('memberRepresent', 'memberSource', 'staffUsers', 'userRepresent'));
    }

    public function createNewStaff(Request $request, $id)
    {
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            toast('Địa chỉ email đã tồn tại.', 'error', 'top-right');
            return back();
        }
        $parent_user = User::find($id);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $parent_user->address;
        $user->rental_code = random_int(00, 999);
        $user->social_media = $request->social_media;
        $user->industry = $parent_user->industry;
        $user->password = Hash::make($request->password);
        $user->type_account = $request->type_account;
        $user->region = $parent_user->region;
        $user->nickname = $request->nickname;

        $success = $user->save();

        $staff_user = new StaffUsers();
        $staff_user->chuc_vu = $request->chuc_vu;
        $staff_user->phu_trach = $request->phu_trach;
        $staff_user->parent_user_id = $parent_user->id;
        $staff_user->user_id = $user->id;

        $staff_user->save();
        if ($success) {
            return back();
        } else {
            alert()->error('Error', 'Error, Please try again!!');
            return back();
        }
    }

    /*Show form register membership*/
    public function congratulationRegisterMember($member, Request $request)
    {
        (new HomeController())->getLocale($request);
        $memberRepresent = MemberRegisterPersonSource::find($member);
        if (!$memberRepresent) {
            return back();
        }
        $memberSource = MemberRegisterPersonSource::find($memberRepresent->person);
        $company = MemberRegisterInfo::find($memberRepresent->member_id);
        $member = Member::find($company->member_id);
        return view('frontend.pages.registerMember.congratulation',
            compact('memberRepresent', 'memberSource', 'company', 'member'));
    }

    public function congratulationRegisterMemberLogistic($member, Request $request)
    {
        (new HomeController())->getLocale($request);
        $memberRepresent = MemberRegisterPersonSource::find($member);
        if (!$memberRepresent) {
            return back();
        }
        $memberSource = MemberRegisterPersonSource::find($memberRepresent->person);
        $company = MemberRegisterInfo::find($memberRepresent->member_id);
        $member = Member::find($company->member_id);
        return view('frontend.pages.registerMember.congratulation-logistic',
            compact('memberRepresent', 'memberSource', 'company', 'member'));
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
                if ($register->member == RegisterMember::BUYER) {
                    alert()->success('Success', 'Success, Verify success!');
                    return redirect(route('show.register.member.congratulation', $member->id));
                } elseif ($member->type == MemberRegisterType::SOURCE) {
                    alert()->success('Success', 'Success, Verify success! Please continue next steps');
                    return redirect(route('show.register.member.person.represent', [
                        'person_id' => $member->id,
                        'registerMember' => $register->member
                    ]));
                } else {
                    if ($register->member == RegisterMember::TRUST) {
                        alert()->success('Success', 'Success, Verify success!');
                        return redirect(route('show.register.member.congratulation', $member->id));
                    }
                    alert()->success('Success', 'Success, Verify success! Please login and paid bill');
                    return redirect(route('show.register.member.ship', $member->id));
                }
            }
            alert()->error('Error', 'Error, Verify error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function getCategoryOneParent(Request $request)
    {
        $listCategoryID = $request->input('listCategoryID');

        $categories_one_parent_array = null;
        foreach ($listCategoryID as $category) {
            $categories_oneparent = Category::where([
                ['status', CategoryStatus::ACTIVE],
                ['parent_id', $category]
            ])->get();
            foreach ($categories_oneparent as $item) {
                $categories_one_parent_array[] = $item;
            }
        }
        $arrayCategory = $request->input('arrayCategory');
        $arrayCategory = explode(',', $arrayCategory);
        $categories_one_parent = collect($categories_one_parent_array);
        return view('frontend.pages.registerMember.category.categories_one_parent', compact('categories_one_parent',
            'arrayCategory'));
    }

    public function getCategoryTwoParent(Request $request)
    {
        $listCategoryID = $request->input('listCategoryID');
        $categories_two_parent_array = null;
        foreach ($listCategoryID as $category) {
            $categories_twoparent = Category::where([
                ['status', CategoryStatus::ACTIVE],
                ['parent_id', $category]
            ])->get();
            foreach ($categories_twoparent as $item) {
                $categories_two_parent_array[] = $item;
            }
        }

        $categories_two_parent = collect($categories_two_parent_array);
        $arrayCategory = $request->input('arrayCategory');
        $arrayCategory = explode(',', $arrayCategory);
        return view('frontend.pages.registerMember.category.categories_two_parent',
            compact('categories_two_parent', 'arrayCategory'));
    }

    public function checkID(Request $request)
    {
        $id = $request->input('memberID');
        $exitMember = MemberRegisterPersonSource::where('code', $id)->first();
        if ($exitMember) {
            return response('ID is already in use!', 400);
        } else {
            return response('This ID is available.', 200);
        }
    }

    /*Private function*/
    private function getArrayIds(Request $request, $input)
    {
        $listCategoryName[] = null;
        $arrayIds = null;
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        foreach ($categories as $category) {
            $name = $input . $category->id;
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

    private function updateUser($user, $fullName, $email, $phoneNumber, $member)
    {
        if ($user) {
            $user->name = $fullName;
            $user->email = $email;
            $user->phone = $phoneNumber;
            $user->member = $member;
            $user->save();
        }
    }

    private function sendMail($data, $email)
    {
        Mail::send('frontend/widgets/mailCode', $data, function ($message) use ($email) {
            $message->to($email, 'Verify mail!')->subject
            ('Verify mail');
            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
        });
    }

    private function createUser($fullName, $email, $phoneNumber, $password, $member, $request)
    {
//        $locale = app()->getLocale();
//        if (!$locale) {
//            $locale = 'kr';
//        }
        $locale = $request->input('locale');

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
    // End register member
}
