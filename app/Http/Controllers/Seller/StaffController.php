<?php

namespace App\Http\Controllers\Seller;

use App\Enums\NotificationStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\TimeLevelStatus;
use App\Http\Controllers\Controller;
use App\Libraries\GeoIP;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\ProductInterested;
use App\Models\StaffUsers;
use App\Models\TimeLevelTable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listUsers = StaffUsers::where([['parent_user_id', '=', Auth::user()->id]])->get();
        return view('backend/staff_manage/index', compact('listUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/staff_manage/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ipAddress = $request->ip();
        $geoIp = new GeoIP();
        $locale = $geoIp->get_country_from_ip('183.80.130.4');

        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            toast('Địa chỉ email đã tồn tại.', 'error', 'top-right');
            return back();
        }

        $parent_user = Auth::user();
        // Lưu thông tin người dùng vào cơ sở dữ liệu

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $parent_user->address;
        $user->rental_code = $parent_user->rental_code;
        $user->social_media = $request->social_media;
        $user->industry = $parent_user->industry;
        $user->password = Hash::make($request->password);
        $user->type_account = $request->type_account;
        $user->region = $parent_user->region;

        $success = $user->save();

        $staff_user = new StaffUsers();
        $staff_user->chuc_vu = $request->chuc_vu;
        $staff_user->phu_trach = $request->phu_trach;
        $staff_user->parent_user_id = $parent_user->id;
        $staff_user->user_id = $user->id;

        $staff_user->save();

        // Save permission default
        $newUser = User::where('email', $request->email)->first();

        if ($request->type_account == 'seller') {
            $roleUser = DB::table('role_user')->insert([
                'role_id' => 2,
                'user_id' => $newUser->id
            ]);
            if (!$roleUser) {
                alert()->error('Error', 'Error, Please try again!!');
                return back();
            }
        }

        $mail = $request->email;
        $password = $request->password;

        $data = array('mail' => $mail, 'name' => $mail, 'password' => $password);

        Mail::send('frontend/widgets/mailWelcome', $data, function ($message) use ($mail) {
            $message->to($mail, 'Welcome mail!')->subject
            ('Welcome mail');
            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
        });

        $defaultPermission1 = Permission::where('name', 'view_all_products')->first();
        $defaultPermission2 = Permission::where('name', 'view_profile')->first();

        $permissionUser1 = [
            'user_id' => $newUser->id,
            'created_at' => Carbon::now()->addHours(7),
            'permission_id' => $defaultPermission1->id,
            'status' => PermissionUserStatus::ACTIVE
        ];

        $permissionUser2 = [
            'user_id' => $newUser->id,
            'created_at' => Carbon::now()->addHours(7),
            'permission_id' => $defaultPermission2->id,
            'status' => PermissionUserStatus::ACTIVE
        ];

        DB::table('permission_user')->insert($permissionUser1);
        DB::table('permission_user')->insert($permissionUser2);

        // Create notification with content: Register successful
        $noti = [
            'user_id' => $newUser->id,
            'content' => "Đăng ký tài khoản thành công!",
            'description' => 'Đăng ký tài khoản',
            'status' => NotificationStatus::UNSEEN,
        ];
        Notification::create($noti);

        // Save off list permission
        $permissions = DB::table('permissions')->where([['name', '!=', 'view_all_products'], ['name', '!=', 'view_profile']])->get();
        $listRequest[] = null;
        foreach ($permissions as $permission) {
            $name = 'permission-' . $permission->id;
            $listRequest[] = $name;
        }

        $listIds[] = null;
        for ($i = 0; $i < count($listRequest); $i++) {
            $listIds[] = $request->input($listRequest[$i]);
        }

        $newUser = User::where('email', $request->input('email'))->first();

        $totalPrice = null;
        for ($i = 2; $i < count($listIds); $i++) {
            if ($listIds[$i] != null) {
                $permissionUser = [
                    'user_id' => $newUser->id,
                    'created_at' => Carbon::now()->addHours(7),
                    'permission_id' => $listIds[$i],
                    'status' => PermissionUserStatus::INACTIVE
                ];

                DB::table('permission_user')->insert($permissionUser);

                $permissionUsers = DB::table('permission_user')->orderByDesc('id')->limit(1)->get();

                $timeLevel = [
                    'user_id' => $newUser->id,
                    'level_old' => $newUser->level_account,
                    'new_level' => $newUser->level_account,
                    'type_account' => $newUser->type_account,
                    'activation_date' => Carbon::now()->addHours(7),
                    'duration' => 1,
                    'expiration_date' => Carbon::now()->addHours(7)->addYear(),
                    'total_price' => 10,
                    'description' => 'description',
                    'permission_id' => $listIds[$i],
                    'permission_user_id' => $permissionUsers[0]->id,
                    'status' => TimeLevelStatus::INACTIVE
                ];

                $totalPrice = $totalPrice + 10;

                TimeLevelTable::create($timeLevel);
            }
        }

        $noti = [
            'user_id' => $newUser->id,
            'content' => "Vui lòng thanh toán khoản vay quyền lợi!",
            'description' => 'Thanh toán khoản vay',
            'status' => NotificationStatus::UNSEEN,
        ];
        Notification::create($noti);
        Session::flash('success', 'Đăng ký thành công!');

        if ($success) {
            return redirect(route('staff.manage.show'));
        } else {
            alert()->error('Error', 'Error, Please try again!!');
            return back();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
