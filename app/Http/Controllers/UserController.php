<?php

namespace App\Http\Controllers;

use App\Enums\MemberRegisterPersonSourceStatus;
use App\Enums\NotificationStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\TimeLevelStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Libraries\GeoIP;
use App\Models\Category;
use App\Models\MemberRegisterPersonSource;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\ProductInterested;
use App\Models\TimeLevelTable;
use App\Models\User;
use App\Models\Voucher;
use App\Models\wishlists;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        (new HomeController())->getLocale($request);
        $oldPassword = Auth::user()->password;
        $currentPassword = $request->input('current-password');
        $check = Hash::check($currentPassword, $oldPassword);
        if ($check) {
            $newPassword = $request->input('new-password');
            $user = Auth::user();
            $user->password = Hash::make($newPassword);
            $success = $user->save();
            if ($success) {
                $request->session()->flush();
                alert()->success('Success', 'Change Password Success!');
            } else {
                alert()->error('Error', 'Change Password error!');
            }
            return redirect(route('profile.show'));

        } else {
            alert()->error('Error', 'Change Password error!');
            return redirect(route('profile.show'));
        }

    }

    public function changeEmail(Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $user = Auth::user();
            $email = $request->input('edit-email');
            $oldUser = User::where('email', $email)->first();
            if ($oldUser) {
                alert()->error('Error', 'Email already used!');
                return back();
            } else {
                $person = MemberRegisterPersonSource::where('email', $email)->where('status',
                    MemberRegisterPersonSourceStatus::ACTIVE)->first();

                if ($person) {
                    alert()->error('Error', 'Email already used!');
                    return back();
                }

                $myPerson = MemberRegisterPersonSource::where('email', $user->email)->where('status',
                    MemberRegisterPersonSourceStatus::ACTIVE)->first();

                $user->email = $email;
                $myPerson->email = $email;

                $myPerson->save();
                $success = $user->save();
                if ($success) {
                    alert()->success('Success', 'Change Email Success!');
                } else {
                    alert()->error('Error', 'Change Email error!');
                }
            }
        } catch (Exception $exception) {
            alert()->error('Error', 'Change Email error!');
            return back();
        }
        return redirect(route('profile.show'));
    }

    public function changePhoneNumber(Request $request)
    {
        (new HomeController())->getLocale($request);
        try {
            $user = Auth::user();
            $user->phone = $request->input('edit-phone');
            $success = $user->save();
            if ($success) {
                alert()->success('Success', 'Change PhoneNumber Success!');
            } else {
                alert()->error('Error', 'Change PhoneNumber error!');
            }
        } catch (Exception $exception) {
            return back([400], ['Error']);
        }
        return redirect(route('profile.show'));
    }

    public function updateInfo(Request $request)
    {
        (new HomeController())->getLocale($request);
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
        $success = $user->save();
        if ($success) {
            alert()->success('Success', 'Update Info Success!');
        } else {
            alert()->error('Error', 'Update Info Error!');
        }
        return redirect(route('profile.show'));

    }

    public function store(Request $request)
    {
        (new HomeController())->getLocale($request);
        $ipAddress = $request->ip();
        $validator = Validator::make($request->all(), []);
        $geoIp = new GeoIP();
        $locale = $geoIp->get_country_from_ip('183.80.130.4');

        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            toast('Địa chỉ email đã tồn tại.', 'error', 'top-right');
            return redirect(route('register.show'))->withErrors($validator)->withInput();
        }

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

        if ($request->type_account == 'buyer') {
            $categories = Category::get()->toTree();
            $listCategoryName[] = null;
            foreach ($categories as $category) {
                $name = 'category-'.$category->id;
                $listCategoryName[] = $name;
            }
            if ($listCategoryName != null) {
                $listValues = null;
                for ($i = 0; $i < count($listCategoryName); $i++) {
                    $listValues[] = $request->input($listCategoryName[$i]);
                }
                if ($listValues != null) {
                    $arrayIds = null;
                    for ($i = 1; $i < count($listValues); $i++) {
                        if ($listValues[$i] != null) {
                            $arrayIds[] = $listValues[$i];
                        }
                    }
                    if ($arrayIds != null) {
                        $value = implode(",", $arrayIds);
                        ProductInterested::create([
                            'user_id' => $newUser->id,
                            'categories_id' => $value,
                        ]);
                    }
                }
            }
        }

        $data = array('mail' => $mail, 'name' => $mail, 'password' => $password);

        Mail::send('frontend/widgets/mailWelcome', $data, function ($message) use ($mail) {
            $message->to($mail, 'Welcome mail!')->subject('Welcome mail');
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
        $permissions = DB::table('permissions')->where([
            ['name', '!=', 'view_all_products'],
            ['name', '!=', 'view_profile']
        ])->get();
        $listRequest[] = null;
        foreach ($permissions as $permission) {
            $name = 'permission-'.$permission->id;
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
            alert()->success('Success', 'Đăng ký thành công!
        Vui lòng đăng nhập để tiếp tục sử  dịch vụ của chúng tôi');
            return redirect(route('login'));
        } else {
            alert()->error('Error', 'Error, Please try again!!');
            return back();
        }

    }

    public function myVoucher(Request $request)
    {
        (new HomeController())->getLocale($request);
        $listVouchers = Voucher::all();
        $sellerIds = DB::table('role_user')->where('role_id', '=',
            '2')->get(); // Lấy tất cả ca user_id là seller trong bảng role_user
        $adminIds = DB::table('role_user')->where('role_id', '=',
            '1')->get(); // Lấy tất cả ca user_id là admin  trong bảng role_user
        $sellers = [];
        $admins = [];
        foreach ($sellerIds as $sellerId) {
            array_push($sellers, $sellerId->user_id);
        }

        foreach ($adminIds as $adminId) {
            array_push($admins, $adminId->user_id);
        }

        $voucherWithSellers = Voucher::whereIn('user_id',
            $sellers)->get(); // Viết câu truy vấn lấy tất cả các voucher có user_id có trong mảng  $sellerIds
        $voucherWithAdmin = Voucher::whereIn('user_id',
            $admins)->get(); // Viết câu truy vấn lấy tất cả các voucher có user_id có trong mảng  $adminIds


        return view('frontend.pages.profile.my-voucher', [
            'all' => $listVouchers,
            'shoppe' => $voucherWithAdmin,
            'shop' => $voucherWithSellers
        ]);
    }

    public function getNumberPhoneByEmail(Request $request)
    {
        $email = $request->email;
        $phone = $request->phone;
        $user = User::where('email', $email)->first();
        if ($user) {
            if ($user->phone == $phone) {
                $verifyCode = rand(100000, 999999);
                $verifyCodeHash = base64_encode($verifyCode);
                $code = $this->sendVerifyCodeLogin($phone, $verifyCode);

                return response()->json([
                    'status' => 200,
                    'message' => "Success",
                    'code' => $code,
                    'deaswr' => $verifyCodeHash,
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => "Số điện thoại không đúng",
                ]);
            }
        } else {
            return response()->json([
                'status' => 400,
                'message' => "User không tồn tại",
            ]);
        }
    }

    public function sendVerifyCodeLogin($phoneTo, $code = null)
    {
        $site = env('SMS_Site');
        $loginName = env('SMS_LoginName');
        $password = env('SMS_Password');
        $sendServiceCode = env('SMS_SendServiceCode');
        $brandName = env('SMS_BrandName');
        $unicode = env('SMS_Unicode');

        $site = "ILVIETNAM";
        $loginName = "admin";
        $password = "ILVIETNAM@1";
        $sendServiceCode = "11";
        $brandName = "IL VIETNAM";
        $unicode = "0";


        $timestamp = time();
        $randomValue = rand(0, 999);
        $smsId = $timestamp.$randomValue;

        $content = "Your verification code is " . $code . ". Do not share this code with anyone.";

        $apiUrl = "https://api.s247.vn:8443/api/sms?site=".$site."&LoginName=".$loginName."&Password=".$password."&SendServiceCode=".$sendServiceCode."&BrandName=".$brandName."&mobile=".$phoneTo."&Message=".$content."&SmsId=".$smsId."&Unicode=".$unicode;

        $client = new Client();

        $response = $client->get($apiUrl);

        $data = $response->getBody()->getContents();

        return json_decode($data)->code;
    }
}
