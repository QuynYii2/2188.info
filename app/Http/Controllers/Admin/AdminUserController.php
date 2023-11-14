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
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function listUser(Request $request)
    {
        (new HomeController())->getLocale($request);
        $users = User::paginate(10);
        $members = Member::where('status', MemberStatus::ACTIVE)->get();
        $roles = Role::all();
        $categories = Category::all();
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

            if ($password) {
                $user->password = Hash::make($password);
            }

            if ($request->hasFile('thumbnail')) {
                $avatar = $request->file('thumbnail');
                $avatarPath = $avatar->store('avatar', 'public');
                $user->image = $avatarPath;
            }

            $user->name = $request->input('name');
            $user->address = $request->input('address');
            $user->region = $request->input('region');

            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->status = $request->input('status');

            $companyPerson = MemberRegisterPersonSource::where('email', $user->email)->first();

            $role = $request->input('role');

            DB::table('role_user')->where('user_id', $id)->delete();

            $this->insertRole($role, $id, $request);

            $user->save();
            if ($companyPerson) {
                $companyPerson->email = $request->input('email');
                $companyPerson->phone = $request->input('phone');
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
            dd($exception);
            return back();
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
        (new HomeController())->getLocale($request);
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

    public function searchUser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $member = $request->input('member');
        $role = $request->input('role');
        $category = $request->input('category');

        $users = User::query();

        if ($name) {
            $users->where('users.name', 'like', '%'.$name.'%');
        }

        if ($email) {
            $users->where('users.email', 'like', '%'.$email.'%');
        }

        if ($phone) {
            $users->where('users.phone', 'like', '%'.$phone.'%');
        }

        if ($member) {
            $users->where('users.member', $member);
        }

        if ($role) {
            $users->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', $role);
        }

        if ($category) {
            $users
                ->join('member_register_infos', 'users.id', '=',
                'member_register_infos.user_id')
                ->where('member_register_infos.category_id', 'like', '%'.$category.'%');
        }

        $results = $users->paginate(10);

        $results = $this->renderToHTML($results);
        return response()->json($results);
    }

    public function renderToHTML($users)
    {
        $html = '';

        foreach ($users as $index => $user) {
            $html .= '<tr>
                        <th scope="row">'.$index.'</th>
                        <td class="table-name">'.$user->name.'</td>
                        <td class="table-email">'.$user->email.'</td>
                        <td>'.$user->phone.'</td>
                        <td class="table-role">';
            $user_roles = DB::table('role_user')->where('user_id', $user->id)->get();
            if ($user_roles->isEmpty()) {
                $html .= 'buyer';
            }

            foreach ($user_roles as $user_role) {
                $role = Role::find($user_role->role_id);
                $html .= $role->name.'<br>';
            }

            $html .= '</td>
                        <td class="table-member">'.$user->member.'</td>
                        <td>'.$user->region.'</td>
                        <td>';
            $orders = Order::where('user_id', $user->id)->get();
            $html .= count($orders).'</td><td>';

            $products = Product::where('user_id', $user->id)->get();
            $html .= count($products).'</td>
                        <td>'.$user->status.'</td>
                        <td>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="'.route('admin.private.update.users', $user->id).'"
                                   class="btn btn-primary">Detail</a>
                                <form action="'.route('admin.delete.users', $user->id).'" method="post">
                                    <input type="hidden" value="'.csrf_token().'">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>';
        }

        return $html;
    }

}
