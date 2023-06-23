<?php

namespace App\Http\Controllers;

use App\Enums\NotificationStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\TimeLevelStatus;
use App\Libraries\GeoIP;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\ProductInterested;
use App\Models\TimeLevelTable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function store(Request $request)
    {

        $ipAddress = $request->ip();
        $geoIp = new GeoIP();
        $locale = $geoIp->get_country_from_ip('183.80.130.4');

        if ($request->type_account == 'seller') {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'rental_code' => 'required',
                'image' => 'required|image',
                'social_media' => 'required',
                'industry' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'password' => 'required|min:6',
            ]);
        } else {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'rental_code' => 'nullable',
                'image' => 'nullable|image',
                'social_media' => 'nullable',
                'industry' => 'nullable',
                'product_name' => 'nullable',
                'product_code' => 'nullable',
                'password' => 'required|min:6',
            ]);
        }

        // Lưu thông tin người dùng vào cơ sở dữ liệu
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->rental_code = $request->rental_code;
        $user->social_media = $request->social_media;
        $user->industry = $request->industry;
        $user->product_name = $request->product_name;
        $user->product_code = $request->product_code;
        $user->password = Hash::make($request->password);
        $user->type_account = $request->type_account;
        $user->region = $locale;

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $user->image = $imagePath;
        }

        $success = $user->save();

        $mail = $request->email;
        $password = $request->password;

        //         Save permission default
        $newUser = User::where('email', $request->email)->first();

        if ($request->type_account == 'buyer') {
            $categories = Category::get()->toTree();
            $listCategoryName[] = null;
            foreach ($categories as $category) {
                $name = 'category-' . $category->id;
                $listCategoryName[] = $name;
            }

            $listValues = null;
            for ($i = 0; $i < count($listCategoryName); $i++) {
                $listValues[] = $request->input($listCategoryName[$i]);
            }

//            dd($listValues);
            $arrayIds = null;
            for ($i = 1; $i < count($listValues); $i++) {
                if ($listValues[$i] != null) {
                    $arrayIds[] = $listValues[$i];
                }
            }
//            dd($arrayIds);
            $value = implode(",", $arrayIds);
//            dd($value);
            ProductInterested::create([
                'user_id' => $newUser->id,
                'categories_id' => $value,
            ]);
        }

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
//            return response()->json(['success' => true]);
            return redirect(route('login'));
        } else {
//            return response()->json(['success' => false]);
            return back();
        }

    }

    public function changePassword(Request $request)
    {
        $oldPassword = Auth::user()->password;
        $currentPassword = $request->input('current-password');
        $check = Hash::check($currentPassword, $oldPassword);
        if ($check) {
            $newPassword = $request->input('new-password');
            $user = Auth::user();
            $user->password = Hash::make($newPassword);
            $user->save();
            return redirect(route('profile.show'));

        } else {
            return redirect(route('profile.show'));
        }

    }

    public function changeEmail(Request $request)
    {
        $user = Auth::user();
        $user->email = $request->input('edit-email');
        $user->save();
        return redirect(route('profile.show'));
    }

    public function changePhoneNumber(Request $request)
    {
        $user = Auth::user();
        $user->phone = $request->input('edit-phone');
        $user->save();
        return redirect(route('profile.show'));
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $listParam = $request->input();

        foreach ($listParam as $key => $value) {
            if ($value != null && $key != '_token') {
                $user->$key = $value;
            }
        }

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatar', 'public');
            $user->image = $avatarPath;
        }



        $user->region = strtolower($user->region);
        $user->save();
        return redirect(route('profile.show'));

    }


}
