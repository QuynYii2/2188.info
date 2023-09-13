<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MemberRegisterInfoStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function listUser(Request $request)
    {
        $users = User::where('status', '!=', UserStatus::DELETED)->paginate(10);
        return view('admin.user-manager.list-user')->with('users', $users);
    }

    public function detail($id)
    {
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
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }

    public function processUpdate($id)
    {
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
        try {
            $user = User::find($id);
            if (!$user || $user->status == UserStatus::DELETED) {
                $numLog = 404;
                $message = 'Not found';
                return view('frontend.widgets.error', compact('numLog', 'message'));
            }

            $password = $request->input('password');

            if ($password) {
                $user->password = Hash::make($password);
            }
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->name = $request->input('name');
            $user->status = $request->input('status');

            $companyPerson = MemberRegisterPersonSource::where('email', $user->email)->first();
            $companyPerson->email = $request->input('email');
            $companyPerson->phone = $request->input('phone');

            $role = $request->input('role');

            $adminRole = Role::where('name', 'super_admin')->first();
            $seller = Role::where('name', 'seller')->first();
            $buyer = Role::where('name', 'buyer')->first();
            DB::table('role_user')->where('user_id', $id)->delete();

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

            $user->save();
            $companyPerson->save();
            alert()->success('Success', 'Save information user success');
            return redirect(route('admin.list.users'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }

    }

    public function processCreate()
    {

    }

    public function create()
    {

    }

    public function showCompany($id)
    {
        $user = User::find($id);
        if (!$user || $user->status == UserStatus::DELETED) {
            $numLog = 404;
            $message = 'Not found';
            return view('frontend.widgets.error', compact('numLog', 'message'));
        }
        $companyPerson = MemberRegisterPersonSource::where('email', $user->email)->first();
        $company = null;
        if ($companyPerson) {
            $company = MemberRegisterInfo::where([
                ['id', $companyPerson->member_id],
                ['status', MemberRegisterInfoStatus::ACTIVE]
            ])->first();
        }
        return view('admin.user-manager.detail-company', compact('user', 'company', 'companyPerson'));
    }

    public function updateCompany($id, Request $request)
    {
        $company = MemberRegisterInfo::where('id', $id)->first();

        $company->name_kr = $request->input('name_kr');
        $company->name_en = $request->input('name_en');
        $company->phone = $request->input('phone');
        $company->member = $request->input('member');
        $company->address = $request->input('address');
        $company->status = $request->input('status');

        alert()->success('Success', 'Update company success');
        return redirect(route('admin.list.users'));
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user || $user->status == UserStatus::DELETED) {
            $numLog = 404;
            $message = 'Not found';
            return view('frontend.widgets.error', compact('numLog', 'message'));
        }
        $user->status = UserStatus::DELETED;
        $user->save();
        alert()->success('Success', 'Delete success');
        return redirect(route('admin.list.users'));
    }
}
