<?php

namespace App\Http\Controllers\Member;

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
            /*Thông tin công ty đăng ký*/
            // MemberInfo
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
            $address_en = $request->input('address_en');
            $address_kr = $request->input('address_kr');
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

            if ($password !== $passwordConfirm) {
                alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                return back();
            }

            $password = Hash::make($password);

            $code = (new  HomeController())->generateRandomString(6);

            $data = array('mail' => $email, 'name' => $email, 'code' => $code);

//            $id = Auth::user()->id;
            $id = 0;

            $price = 0;

            // Công ty
            $arrayIds = $this->getArrayIds($request, 'category-');
            if ($arrayIds) {
                try {
                    $categories = implode(',', $arrayIds);
                } catch (\Exception $exception) {
                    alert()->error('Error', 'Error, Please choosing your apply category!');
                    return back();
                }
            } else {
                alert()->error('Error', 'Error, Please choosing your apply category!');
                return back();
            }

            $codeBusiness = $categories;

            $arrayIds = $this->getArrayIds($request, 'type_business-');
            if ($arrayIds) {
                try {
                    $type_business = implode(',', $arrayIds);
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

            $status = MemberRegisterInfoStatus::ACTIVE;

            $create = [
                'user_id' => $id,
                'name' => $companyName,
                'phone' => $phoneNumber,
                'fax' => $fax,
                'code_fax' => 'default',
                'category_id' => $categories,
                'code_business' => $codeBusiness,
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
            ];

            $success = MemberRegisterInfo::create($create);
            if (!$success) {
                alert()->error('Error', 'Register error, Please try again!');
                return back();
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
                'verifyCode' => $code,
                'isVerify' => 0,
                'price' => $price,
                'datetime_register' => $datetime_register,
                'name_en' => $name_en,
                'status' => MemberRegisterPersonSourceStatus::INACTIVE
            ];

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
            $this->createUser($fullName, $email, $phoneNumber, $password, RegisterMember::BUYER);
            $save = MemberRegisterPersonSource::create($memberRegister);

            if ($save) {
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

    /*Đăng kí thông tin hội viên không phải là hội viên buyer*/
    public function registerMemberInfo(Request $request)
    {
        try {
            $memberID = $request->input('member_id');

            $address = $request->input('wards-select') . ', ' . $request->input('provinces-select') . ', ' . $request->input('cities-select') . ', ' . $request->input('countries-select');
            $companyName = $request->input('name_en');
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
            $address_en = $request->input('address_en');
            $address_kr = $request->input('address_kr');
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
                $gpkdPath = '';
            }

            $arrayIds = $this->getArrayIds($request, 'category-');
            if ($arrayIds) {
                try {
                    $categories = implode(',', $arrayIds);
                } catch (\Exception $exception) {
                    alert()->error('Error', 'Error, Please choosing your apply category!');
                    return back();
                }
            } else {
                alert()->error('Error', 'Error, Please choosing your apply category!');
                return back();
            }

            $codeBusiness = $categories;

            $arrayIds = $this->getArrayIds($request, 'type_business-');
            if ($arrayIds) {
                try {
                    $type_business = implode(',', $arrayIds);
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
                $exitsMember->category_id = $categories;
                $exitsMember->number_business = $numberBusiness;
                $exitsMember->type_business = $type_business;
                $exitsMember->code_business = $codeBusiness;
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
                $exitsMember->code_1 = $code_1;
                $exitsMember->code_2 = $code_2;
                $exitsMember->code_3 = $code_3;
                $exitsMember->code_4 = $code_4;

                $success = $exitsMember->save();
                $newUser = $exitsMember;
            } else {
                $create = [
                    'user_id' => $id,
                    'name' => $companyName,
                    'phone' => $phoneNumber,
                    'fax' => $fax,
                    'code_fax' => 'default',
                    'category_id' => $categories,
                    'code_business' => $codeBusiness,
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
                    'code_1' => $code_1,
                    'code_2' => $code_2,
                    'code_3' => $code_3,
                    'code_4' => $code_4,
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
                'datetime_register' => $datetime_register,
                'name_en' => $name_en,
                'responsibility' => $responsibility,
                'position' => $position,
                'code' => $codeItem,
                'status' => MemberRegisterPersonSourceStatus::INACTIVE
            ];

            $userOld = User::where('email', $email)->first();
            $memberOld = MemberRegisterPersonSource::where('email', $email)->first();

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
                    if ($exitsMember->member != RegisterMember::TRUST){
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
                    alert()->success('Success', 'Success, Create success! Please continue next steps');
                    return redirect(route('show.register.member.person.represent', [
                        'person_id' => $memberPersonSource->id,
                        'registerMember' => $register->member
                    ]));
                } else {
                    if ($userOld) {
                        alert()->error('Error', 'Error, Email is user used!');
                        return back();
                    }

                    if ($memberOld) {
                        alert()->error('Error', 'Error, Email in member used!');
                        return back();
                    }
                    if ($exitsMember->member != RegisterMember::TRUST){
                        DB::table('role_user')->insert([
                            'role_id' => 2,
                            'user_id' => $user->id
                        ]);
                    }
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPersonSource->status = MemberRegisterPersonSourceStatus::INACTIVE;
                    $memberPersonSource->email = $email;
                    $this->sendMail($data, $email);
                    $memberPersonSource->isVerify = 0;
                    $memberPersonSource->verifyCode = $code;
                    $success = $memberPersonSource->save();
                }
            } else {
                if ($userOld) {
                    alert()->error('Error', 'Error, Email is user used!');
                    return back();
                }

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

                'datetime_register' => $datetime_register,
                'name_en' => $name_en,
                'responsibility' => $responsibility,
                'position' => $position,
                'code' => $codeItem,

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

            $userOld = User::where('email', $email)->first();
            $memberOld = MemberRegisterPersonSource::where('email', $email)->first();
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

                $memberPerson->status = MemberRegisterPersonSourceStatus::INACTIVE;
                if ($email == $memberPerson->email) {
                    $memberPerson->status = MemberRegisterPersonSourceStatus::ACTIVE;
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPerson->email = $email;
                    $memberPerson->save();
                    alert()->success('Success', 'Success');
                    return redirect(route('show.register.member.ship', $memberBefore->member_id));
                } else {
                    if ($userOld) {
                        alert()->error('Error', 'Error, Email is user used!');
                        return back();
                    }
                    if ($memberOld) {
                        alert()->error('Error', 'Error, Email in member used!');
                        return back();
                    }
                    $this->updateUser($user, $fullName, $email, $phoneNumber, $exitsMember->member);
                    $memberPerson->email = $email;
                    $this->sendMail($data, $email);
                    $memberPerson->isVerify = 0;
                    $memberPerson->verifyCode = $code;
                    $success = $memberPerson->save();
                }
            } else {
                if ($userOld) {
                    alert()->error('Error', 'Error, Email is user used!');
                    return back();
                }
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

    /*Show form register membership*/
    public function registerMemberShip($member, Request $request)
    {
        (new HomeController())->getLocale($request);
        $memberRepresent = MemberRegisterPersonSource::find($member);
        if (!$memberRepresent) {
            return back();
        }
        $memberSource = MemberRegisterPersonSource::find($memberRepresent->person);
        return view('frontend.pages.registerMember.membership', compact('memberRepresent', 'memberSource'));
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

    /*Private function*/

    private function getArrayIds(Request $request, $input)
    {
        $listCategoryName[] = null;
        $arrayIds = null;
        $categories = Category::all();
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

    private function createUser($fullName, $email, $phoneNumber, $password, $member)
    {
        $locale = app()->getLocale();
        if (!$locale) {
            $locale = 'kr';
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
    // End register member
}
