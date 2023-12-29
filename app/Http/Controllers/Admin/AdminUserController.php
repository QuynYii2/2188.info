<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\MemberRegisterType;
use App\Enums\MemberStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Category;
use App\Models\Member;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function listUser(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (checkAdmin() && Auth::user()->is_admin == 1) {
            $users = User::where('status', '!=', UserStatus::DELETED)
                ->orderBy('id', 'desc')->paginate(30);
        } else {
            $locale = app()->getLocale();
            if (!$locale) {
                $locale = $request->session()->get('locale');
            }
            if (!$locale) {
                $locale = 'kr';
            }
            $users = User::where('region', $locale)->where('status', '!=', UserStatus::DELETED)
                ->orderBy('id', 'desc')->paginate(30);
        }
        $members = Member::where('status', MemberStatus::ACTIVE)->get();

        $roles = Role::all();
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        return view('admin.user-manager.list-user', compact('members', 'users', 'roles', 'categories'));
    }

    public function detail($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $user = User::find($id);
        if (!$user || $user->status == UserStatus::DELETED) {
            $numLog = 404;
            $message = 'Not found';
            return view('frontend.widgets.error', compact('numLog', 'message'));
        }
        return view('admin.user-manager.detail-user', compact('user'));
    }

    public function edit($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $user = User::find($id);
            if (!$user || $user->status == UserStatus::DELETED) {
                $numLog = 404;
                $message = 'Not found';
                return view('frontend.widgets.error', compact('numLog', 'message'));
            }

            if ($request->hasFile('thumbnail')) {
                $avatar = $request->file('thumbnail');
                $avatarPath = $avatar->store('avatar', 'public');
                $user->image = $avatarPath;
            }

            $user->phone = $request->input('phone');
            $user->name = $request->input('name');
            $user->address = $request->input('address');
            $user->region = $request->input('region');
            $user->status = $request->input('status');

            $companyPerson = MemberRegisterPersonSource::where('email', $user->email)->first();
            $companyPerson->name = $request->input('name');
            $companyPerson->phone = $request->input('phone');

            $user->save();
            $companyPerson->save();
            alert()->success('Success', 'Save information user success');
            return redirect(route('admin.list.users'));
        } catch (Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }

    public function processUpdate($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $user = User::find($id);
        if (!$user || $user->status == UserStatus::DELETED) {
            $numLog = 404;
            $message = 'Not found';
            return view('frontend.widgets.error', compact('numLog', 'message'));
        }
        // Check admin by id
        $role_id = DB::table('role_user')->where('user_id', $id)->get();
        $isAdmin = false;
        foreach ($role_id as $item) {
            if ($item->role_id == 1) {
                $isAdmin = true;
            }
        }
        // Check seller by id
        $isSeller = false;
        $roles = $user->roles;
        $roleNames = $roles->pluck('name');
        if ($roleNames->contains('seller')) {
            $isSeller = true;
        }
        return view('admin.user-manager.update-user', compact('user', 'isAdmin', 'isSeller'));
    }

    public function update($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $user = User::find($id);
            if (!$user || $user->status == UserStatus::DELETED) {
                $numLog = 404;
                $message = 'Not found';
                return view('frontend.widgets.error', compact('numLog', 'message'));
            }

            $password = $request->input('password');
            $password_confirm = $request->input('password_confirm');
            $new_password_confirm = $request->input('new_password_confirm');

            if ($password) {
                if (!Hash::check($password, $user->password)) {
                    alert()->error('Error', 'Error, Password incorrect!');
                    return back();
                }

                if ($password_confirm != $new_password_confirm) {
                    alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                    return back();
                }

                $new_password = Hash::make($password_confirm);
                $user->password = $new_password;
            }

            if ($request->hasFile('thumbnail')) {
                $avatar = $request->file('thumbnail');
                $avatarPath = $avatar->store('avatar', 'public');
                $user->image = $avatarPath;
            }


            $member = $request->input('member');
            $user->member = $member;
            $companyPerson = MemberRegisterPersonSource::where('email', $user->email)->first();

            $user->name = $request->input('name') ?? $user->name;
            $user->address = $request->input('address') ?? $user->address;
            $user->region = $request->input('region') ?? $user->region;

            $user->email = $request->input('email') ?? $user->email;
            $user->phone = $request->input('phone') ?? $user->phone;
            $user->status = $request->input('status');

            $user->save();
            if ($companyPerson) {
                $company = MemberRegisterInfo::find($companyPerson->member_id);
                $company->member = $member;
                $member_id = Member::where('name', $member)->first();
                $company->member_id = $member_id->id;
                $company->save();

                $companyPerson->email = $request->input('email') ?? $user->email;
                $companyPerson->phone = $request->input('phone') ?? $user->phone;
                $companyPerson->save();
            }
            alert()->success('Success', 'Save information user success');
            return redirect(route('admin.list.users'));
        } catch (Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }

    public function delete($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $user = User::find($id);
        if (!$user || $user->status == UserStatus::DELETED) {
            alert()->success('Success', 'Deleted');
            return redirect(route('admin.list.users'));
        }
        $user->status = UserStatus::DELETED;
        $user->save();
        alert()->success('Success', 'Delete success');
        return redirect(route('admin.list.users'));
    }

    public function processCreate(Request $request)
    {
        (new HomeController())->getLocale($request);
        $members = Member::where('status', MemberStatus::ACTIVE)->get();
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        return view('admin.user-manager.create-user', compact('members', 'categories'));
    }

    public function create(Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $user = new User();

            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');

            $oldUser = User::where('email', $request->input('email'))->first();
            if ($oldUser) {
                alert()->error('Error', 'Error, Email exits!');
                return back();
            }

            if ($password !== $passwordConfirm) {
                alert()->error('Error', 'Error, Password or Password confirm incorrect!');
                return back();
            }

            $user->name = $request->input('name');
            $user->phone = $request->input('phoneNumber');
            $user->email = $request->input('email');
            $user->password = Hash::make($password);

            $user->region = $request->input('region');
            $user->gender = $request->input('gender');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->type_account = $request->input('type_account');

            $user->address = $request->input('address_en');

            if ($request->hasFile('image')) {
                $avatar = $request->file('image');
                $avatarPath = $avatar->store('avatar', 'public');
                $user->image = $avatarPath;
            }
            $user->status = $request->input('status');
            $member_id = $request->input('member');
            $member = Member::find($member_id);
            $user->member = $member->name;
            $role = $request->input('role');

            $user->save();

            $category = $request->input('category');
            $listCategory = implode(',', $category);

            $type_business = $request->input('type_business');
            $listType_business = implode(',', $type_business);

            $newUser = User::where('email', $request->input('email'))->first();
            $id = $newUser->id;
            $this->insertRole($role, $id, $request);

            $company = new MemberRegisterInfo();

            $company->datetime_register = Carbon::now()->addHours(7);
            $company->user_id = $id;
            $company->name = $request->input('name');
            $company->phone = $request->input('phoneNumber');
            $company->fax = 'fax';

            $company->code_fax = 'code_fax';
            $company->category_id = $listCategory;
            $company->code_business = $listCategory;
            $company->number_business = 'default';
            $company->type_business = $listType_business;

            $company->member = $member->name;
            $company->status = $request->input('status');
            $company->address = $request->input('address_en');
            $company->member_id = $member_id;

            $company->datetime_register = Carbon::now()->addHours(7);

            $company->name_en = $request->input('name_en');
            $company->name_kr = $request->input('name');

            $company->address_en = $request->input('address_en');
            $company->address_kr = $request->input('address_kr');

            $company->email = $request->input('email');

            $company->number_clearance = $request->input('number_clearance');
            $company->save();

            $newCompany = MemberRegisterInfo::where([
                ['name', $request->input('name')],
                ['phone', $request->input('phoneNumber')],
                ['member_id', $member_id],
            ])->first();

            $person = new MemberRegisterPersonSource();

            $person->user_id = $id;

            $person->member_id = $newCompany->id;
            $person->name = $request->input('name');
            $person->password = Hash::make($password);
            $person->phone = $request->input('phoneNumber');
            $person->email = $request->input('email');

            $person->verifyCode = '123456';
            $person->isVerify = 1;

            $person->rank = 'default';

            $person->datetime_register = Carbon::now()->addHours(7);

            $person->type = MemberRegisterType::SOURCE;
            $person->status = $request->input('status');
            $person->name_en = $request->input('name');
            $person->sns_account = $request->input('sns_account');
            $person->code = $request->input('code');
            $person->save();

            alert()->success('Success', 'Save information user success');
            return redirect(route('admin.list.users'));
        } catch (Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }

    private function insertRole($role, $id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $adminRole = Role::where('name', 'super_admin')->first();
        $seller = Role::where('name', 'seller')->first();
        $buyer = Role::where('name', 'buyer')->first();
        if ($role == 'ADMIN') {
            DB::table('role_user')->insert([
                [
                    'role_id' => $adminRole->id,
                    'user_id' => $id
                ],
                [
                    'role_id' => $seller->id,
                    'user_id' => $id
                ]
            ]);
        } elseif ($role == 'SELLER') {
            DB::table('role_user')->insert([
                'role_id' => $seller->id,
                'user_id' => $id
            ]);
        } else {
            DB::table('role_user')->insert([
                'role_id' => $buyer->id,
                'user_id' => $id
            ]);
        }
    }

    public function showCompany($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $user = User::find($id);
        if (!$user || $user->status == UserStatus::DELETED) {
            $numLog = 404;
            $message = 'Not found';
            return view('frontend.widgets.error', compact('numLog', 'message'));
        }
        $companyPerson = MemberRegisterPersonSource::where('email', $user->email)->first();
        $company = null;
        $member = null;
        if ($companyPerson) {
            $company = MemberRegisterInfo::where([
                ['id', $companyPerson->member_id],
                ['status', MemberRegisterInfoStatus::ACTIVE]
            ])->first();

            $member = Member::find($company->member_id);
        }


        if (!$company) {
            alert()->error('Error', 'Error, Company not found!');
            return back();
        }

        $time = (new HomeController())->calcTimeDiff($company->created_at);
        $date_time = $time[0] . $time[1];

        return view('admin.user-manager.detail-company', compact(
            'user',
            'company',
            'date_time',
            'companyPerson',
            'member',));
    }

    public function updateCompany($id, Request $request)
    {
        (new HomeController())->getLocale($request);
        $company = MemberRegisterInfo::where('id', $id)->first();

        $memberID = $request->input('member_id');

        $companyName = $request->input('name_en');
        $email = $request->input('email');
        $homepage = $request->input('homepage');
        $numberBusiness = $request->input('number_business');
        $phoneNumber = $request->input('phone');
        if (!$phoneNumber) {
            $phoneNumber = $request->input('phoneNumber');
        }
        $registerMember = $request->input('member');

        $fax = $request->input('fax');
        if (!$fax) {
            $fax = '';
        }

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

        if (!$code_business) {
            $code_business = '';
        }

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

        if (!$gpkdPath) {
            $gpkdPath = $company->giay_phep_kinh_doanh;
        }

        $code_1_item = $code_1;
        $code_2_item = $code_2;
        $code_3_item = $code_3;

        if (!$numberBusiness) {
            $numberBusiness = '';
        }

        if (!$type_business) {
            $type_business = '';
        }

        $company->user_id = $id;
        $company->name = $companyName;
        $company->email = $email;
        $company->phone = $phoneNumber;
        $company->category_id = $categoryIds;
        $company->number_business = $numberBusiness;
        $company->type_business = $type_business;
        $company->code_business = $code_business;
        $company->giay_phep_kinh_doanh = $gpkdPath;
        $company->address = $address;
        $company->member_id = $memberID;
        $company->member = $registerMember;

        $company->number_clearance = $number_clearance;
        $company->name_en = $name_en;
        $company->name_kr = $name_kr;
        $company->address_en = $address_en;
        $company->address_kr = $address_kr;
        $company->certify_business = $certify_business;
        $company->status_business = $status_business;
        $company->code_1 = $code_1_item;
        $company->code_2 = $code_2_item;
        $company->code_3 = $code_3_item;
        $company->code_4 = $code_4;
        $company->homepage = $homepage;

        $company->fax = $fax;

        $company->save();

        alert()->success('Success', 'Update company success');
        return redirect(route('admin.list.users'));
    }

    public function searchUser(Request $request)
    {
        $keyword = $request->input('keyword');
        $member = $request->input('member');
        $category = $request->input('category');
        $region = $request->input('region');

        $users = DB::table('users');

        if ($keyword) {
            $users->where('users.name', 'like', '%' . $keyword . '%');
        }

        if ($keyword) {
            $users->orWhere('users.email', 'like', '%' . $keyword . '%');
        }

        if ($keyword) {
            $users->orWhere('users.phone', 'like', '%' . $keyword . '%');
        }

        if ($keyword) {
            $users->join('member_register_person_sources', 'users.email', '=', 'member_register_person_sources.email')
                ->join('member_register_infos', 'member_register_infos.id', '=', 'member_register_person_sources.member_id')
                ->orWhere('member_register_infos.name', 'like', '%' . $keyword . '%')
                ->orWhere('member_register_infos.name_kr', 'like', '%' . $keyword . '%')
                ->orWhere('member_register_infos.name_en', 'like', '%' . $keyword . '%');
        }

        if ($member) {
            $users->where('users.member', $member);
        }

        if ($category) {
            $users->join('member_register_person_sources', 'users.email', '=', 'member_register_person_sources.email')
                ->join('member_register_infos', 'member_register_infos.id', '=', 'member_register_person_sources.member_id')
                ->whereRaw('FIND_IN_SET(?, member_register_infos.category_id)', [$category]);
        }

        if (checkAdmin() && Auth::user()->is_admin == 1) {
            if ($region) {
                $users->where('users.region', $region);
            }
        } else {
            $locale = app()->getLocale();
            if (!$locale) {
                $locale = $request->session()->get('locale');
            }
            if (!$locale) {
                $locale = 'kr';
            }
            $users->where('users.region', $locale);
        }

        $users = $users->orderBy('users.id', 'desc')->paginate(30);

        $members = Member::where('status', MemberStatus::ACTIVE)->get();

        $roles = Role::all();
        $categories = Category::where('status', CategoryStatus::ACTIVE)->get();
        return view('admin.user-manager.list-user', compact('members', 'users', 'roles', 'categories', 'keyword'));
    }
}
