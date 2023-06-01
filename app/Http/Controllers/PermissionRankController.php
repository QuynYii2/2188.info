<?php

namespace App\Http\Controllers;

use App\Enums\PermissionUserStatus;
use App\Enums\TimeLevelStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\TimeLevelTable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PermissionRankController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $permissions = DB::table('permission_user')->where([['user_id', Auth::user()->id], ['status', PermissionUserStatus::ACTIVE]])->get();
        return view('frontend/pages/profile/rank', compact('permissions'));
    }

    public function list(Request $request)
    {
        (new HomeController())->getLocale($request);
        $permissionUsers = DB::table('permission_user')->where([['user_id', Auth::user()->id], ['status', PermissionUserStatus::ACTIVE]])->get();
        $number = [];
        for ($i=0; $i<count($permissionUsers); $i++){
            $number[] = $permissionUsers[$i]->permission_id;
        }
        $permissions = DB::table('permissions')->whereNotIn('id', $number)->get();
        return view('frontend/pages/profile/listRank', compact('permissions', 'permissionUsers'));
    }

    public function store(Request $request){
        $permissionUser = [
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()->addHours(7),
            'permission_id' => $request->input('permission-id'),
            'status' => PermissionUserStatus::ACTIVE
        ];

        DB::table('permission_user')->insert($permissionUser);

        $permissionUsers = DB::table('permission_user')->orderByDesc('id')->limit(1)->get();


        $user = User::find(Auth::user()->id);

        /*
         * Miss do thieu fillable, kh send duoc request
         * */
        $timeLevel = [
            'user_id' => Auth::user()->id,
            'level_old' => $user->level_account,
            'new_level' => $user->level_account,
            'type_account' => $user->type_account,
            'activation_date' => Carbon::now()->addHours(7),
            'duration' => 1,
            'expiration_date' => Carbon::now()->addHours(7)->addYear(),
            'total_price' => 10,
            'description' => 'description',
            'permission_id' => $request->input('permission-id'),
            'permission_user_id' => $permissionUsers[0]->id,
            'status' => TimeLevelStatus::ACTIVE
        ];

        TimeLevelTable::create($timeLevel);

//        $mail = Auth::user()->email;
//        $data = array('mail' => $mail, 'name' => $mail,);
//        Mail::send('frontend/widgets/mailNotifiUpgradeRank', $data, function ($message) {
//            $message->to(Auth::user()->email, 'Notification mail!')->subject
//            ('Notification mail');
//            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
//        });
//
//        Mail::send('frontend/widgets/mailNotifiUpgradeRank', $data, function ($message) {
//            $message->to('ngodaix5tp@gmail.com', 'Notification mail!')->subject
//            ('Notification mail');
//            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
//        });

        return route('permission.user.show');
    }
}
