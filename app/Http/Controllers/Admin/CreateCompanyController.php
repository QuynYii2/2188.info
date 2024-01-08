<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\MemberRegisterPersonSourceStatus;
use App\Enums\MemberRegisterType;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateCompanyController extends Controller
{
    /* Process create company */
    public function processCreateCompany()
    {
        $categories_no_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', null]
        ])->get();
        $exitsMember = null;
        return view('admin.user-manager.register-member.create-company', compact('categories_no_parent', 'exitsMember'));
    }

    /* Create company */
    public function createCompany(Request $request)
    {
        try {
            $company = new MemberRegisterInfo();

            $name = $request->input('name_en');
            $name_en = $request->input('name_en');
            $name_kr = $request->input('name_kr');

            $phone = $request->input('phone');
            $email = $request->input('email');

            $fax = $request->input('fax');
            $code_fax = $request->input('fax');

            $homepage = $request->input('homepage');

            $number_business = $request->input('number_business');
            $number_clearance = $request->input('number_clearance');
            $code_business = $request->input('code_business');
            $type_business = $request->input('type_business');
            $status_business = $request->input('status_business');

            $member_name = $request->input('member');
            $member = Member::where('name', $member_name)->first();
            if (!$member) {
                alert()->error('Not found', 'Member not found!');
                return back();
            }
            $member_id = $member->id;

            $address = $request->input('address_en');
            $address_en = $request->input('address_en');
            $address_kr = $request->input('address_kr');

            $datetime_register = Carbon::now()->addHours(7);
            $status = MemberRegisterInfoStatus::ACTIVE;

            $code_1 = $request->input('code_1');
            $code_2 = $request->input('code_2');
            $code_3 = $request->input('code_3');
            $code_4 = $request->input('code_4');

            $category_id = $code_1 . ',' . $code_2 . ',' . $code_3 . ',' . $code_4;

            do {
                $custom = (new HomeController())->generateRandomString(10);

                $old_company = MemberRegisterInfo::where('custom', $custom)
                    ->where('status', '!=', MemberRegisterInfoStatus::DELETED)
                    ->first();

            } while ($old_company);

            $total_date = 0;

            $old_company = MemberRegisterInfo::where('email', $email)
                ->where('status', '!=', MemberRegisterInfoStatus::DELETED)
                ->first();
            if ($old_company) {
                alert()->error('Create error', 'Email is already in use!');
                return back();
            }

            $old_company = MemberRegisterInfo::where('phone', $phone)
                ->where('status', '!=', MemberRegisterInfoStatus::DELETED)
                ->first();
            if ($old_company) {
                alert()->error('Create error', 'Phone is already in use!');
                return back();
            }

            if ($request->hasFile('giay_phep_kinh_doanh')) {
                $business_license = $request->file('giay_phep_kinh_doanh');
                $business_licensePath = $business_license->store('company/business_license', 'public');
            } else {
                alert()->error('Not empty', 'Business License not empty!');
                return back();
            }

            if ($request->hasFile('certify_business')) {
                $certify_business = $request->file('certify_business');
                $certify_businessPath = $certify_business->store('company/certify_business', 'public');
            } else {
                alert()->error('Not empty', 'Certify Business not empty!');
                return back();
            }

            $company->user_id = 0;

            $company->name = $name;
            $company->name_en = $name_en;
            $company->name_kr = $name_kr;

            $company->phone = $phone;
            $company->email = $email;
            $company->homepage = $homepage;

            $company->fax = $fax;
            $company->code_fax = $code_fax;

            $company->category_id = $category_id;
            $company->code_1 = $code_1;
            $company->code_2 = $code_2;
            $company->code_3 = $code_3;
            $company->code_4 = $code_4;

            $company->code_business = $code_business;
            $company->type_business = $type_business;
            $company->number_clearance = $number_clearance;
            $company->number_business = $number_business;
            $company->status_business = $status_business;

            $company->member = $member_name;
            $company->member_id = $member_id;

            $company->address = $address;
            $company->address_en = $address_en;
            $company->address_kr = $address_kr;

            $company->certify_business = $certify_businessPath;
            $company->giay_phep_kinh_doanh = $business_licensePath;

            $company->status = $status;
            $company->datetime_register = $datetime_register;

            $company->custom = $custom;
            $company->total_date = $total_date;

            $success = $company->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect(route('admin.member.process.create.person', $custom));
            }
            alert()->error('Error', 'Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function processCreateUserPerson($custom)
    {
        return view('admin.user-manager.register-member.create-user-person', compact('custom'));
    }

    public function createUserPerson(Request $request)
    {
        try {
            $member = new MemberRegisterPersonSource();

            $custom = $request->input('custom');
            $company = MemberRegisterInfo::where('custom', $custom)
                ->where('status', MemberRegisterInfoStatus::ACTIVE)
                ->first();
            if (!$company) {
                alert()->error('Not found', 'Error,Company not found!');
                return back();
            }

            $name = $request->input('name');
            $name_en = $request->input('name_en');
            $name_kr = $request->input('name');

            $position = $request->input('position');
            $rank = $request->input('rank');

            $code = $request->input('code');
            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');

            $old_member = MemberRegisterPersonSource::where('code', $code)
                ->where('status', '!=', MemberRegisterPersonSourceStatus::DELETED)
                ->first();
            if ($old_member) {
                alert()->error('Error', 'Error,ID number has been used!');
                return back();
            }

            if ($password != $passwordConfirm) {
                alert()->error('Error', 'Error,Password or Password Confirm incorrect!');
                return back();
            }

            if (strlen($password) < 5) {
                alert()->error('Error', 'Error,Password invalid!');
                return back();
            }

            $phoneNumber = $request->input('phoneNumber');
            $email = $request->input('email');
            $sns_account = $request->input('sns_account');

            $member_id = $company->id;
            $type = MemberRegisterType::SOURCE;

            $status = MemberRegisterPersonSourceStatus::ACTIVE;

            $address = $company->address;

            $language = app()->getLocale();
            if (!$language) {
                $language = 'kr';
            }
            $oldUser = User::where('email', $email)
                ->orWhere('phone', $phoneNumber)
                ->where('status', '!=', UserStatus::DELETED)
                ->first();
            if ($oldUser) {
                alert()->error('Error', 'Error, Email or phone number has been used!');
                return back();
            }

            $this->createUser($name, $email, $phoneNumber, $address, $language, $password, $company->member);

            $user_id = 0;
            $datetime_register = Carbon::now()->addHours(7);

            $staff = '';
            $price = 0;
            $verifyCode = '';
            $isVerify = 0;

            $member->datetime_register = $datetime_register;

            $member->user_id = $user_id;
            $member->member_id = $member_id;

            $member->name = $name;
            $member->name_en = $name_en;
            $member->position = $position;
            $member->rank = $rank;

            $member->password = Hash::make($password);

            $member->phone = $phoneNumber;
            $member->email = $email;
            $member->sns_account = $sns_account;

            $member->status = $status;
            $member->type = $type;

            $member->code = $code;

            $member->verifyCode = $verifyCode;
            $member->isVerify = $isVerify;
            $member->staff = $staff;
            $member->price = $price;
            $member->responsibility = '';

            $success = $member->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect(route('admin.member.process.create.represent', $member->code));
            }
            alert()->error('Error', 'Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    /* Private function */
    /* Create user */

    private function createUser($name, $email, $tel, $address, $language, $password, $member)
    {
        $newUser = new User();

        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->phone = $tel;
        $newUser->address = $address;
        $newUser->region = $language;
        $newUser->password = Hash::make($password);
        $newUser->status = UserStatus::ACTIVE;
        $newUser->type_account = 'SELLER';
        $newUser->member = $member;

        $success = $newUser->save();
        if ($success) {
            $role = Role::where('name', 'seller')->first();
            DB::table('role_user')->insert(['role_id' => $role->id, 'user_id' => $newUser->id]);
        }
    }

    public function processCreateUserRepresent($code)
    {
        return view('admin.user-manager.register-member.create-user-represent', compact('code'));
    }

    public function createUserRepresent(Request $request)
    {
        try {
            $member = new MemberRegisterPersonSource();

            $person_code = $request->input('person');
            $member_person = MemberRegisterPersonSource::where('code', $person_code)
                ->where('status', MemberRegisterPersonSourceStatus::ACTIVE)
                ->first();

            if (!$member_person) {
                alert()->error('Not found', 'Error,Member not found!');
                return back();
            }

            $name = $request->input('name');
            $name_en = $request->input('name_en');
            $name_kr = $request->input('name');

            $code = $request->input('code');
            $password = $request->input('password');
            $passwordConfirm = $request->input('passwordConfirm');

            $old_member = MemberRegisterPersonSource::where('code', $code)
                ->where('status', '!=', MemberRegisterPersonSourceStatus::DELETED)
                ->first();
            if ($old_member) {
                alert()->error('Error', 'Error,ID number has been used!');
                return back();
            }

            if ($password != $passwordConfirm) {
                alert()->error('Error', 'Error,Password or Password Confirm incorrect!');
                return back();
            }

            if (strlen($password) < 5) {
                alert()->error('Error', 'Error,Password invalid!');
                return back();
            }

            $phoneNumber = $request->input('phoneNumber');
            $email = $request->input('email');
            $sns_account = $request->input('sns_account');

            $member_id = $member_person->member_id;
            $type = MemberRegisterType::REPRESENT;
            $person = $member_person->id;

            $status = MemberRegisterPersonSourceStatus::ACTIVE;

            $user_person = User::where('email', $member_person->email)
                ->where('status', MemberRegisterPersonSourceStatus::ACTIVE)
                ->first();
            $address = $user_person->address;
            $language = $user_person->region;
            $oldUser = User::where('email', $email)
                ->orWhere('phone', $phoneNumber)
                ->where('status', '!=', UserStatus::DELETED)
                ->first();
            if ($oldUser) {
                alert()->error('Error', 'Error, Email or phone number has been used!');
                return back();
            }

            $this->createUser($name, $email, $phoneNumber, $address, $language, $password, $user_person->member);

            $user_id = 0;
            $datetime_register = Carbon::now()->addHours(7);

            $staff = '';
            $price = 0;
            $verifyCode = '';
            $isVerify = 0;

            $member->datetime_register = $datetime_register;

            $member->user_id = $user_id;
            $member->member_id = $member_id;

            $member->name = $name;
            $member->name_en = $name_en;
            $member->position = '';
            $member->rank = '';

            $member->password = Hash::make($password);

            $member->phone = $phoneNumber;
            $member->email = $email;
            $member->sns_account = $sns_account;

            $member->status = $status;
            $member->type = $type;
            $member->person = $person;

            $member->code = $code;

            $member->verifyCode = $verifyCode;
            $member->isVerify = $isVerify;
            $member->staff = $staff;
            $member->price = $price;
            $member->responsibility = '';

            $success = $member->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect(route('admin.list.users'));
            }
            alert()->error('Error', 'Create error!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }
}
