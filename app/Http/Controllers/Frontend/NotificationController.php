<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\NotificationStatus;
use App\Enums\PermissionUserStatus;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $notifications = Notification::where([
            ['user_id', Auth::user()->id],
            ['status', '!=', NotificationStatus::DELETED]
        ])->orderByDesc('id')->get();
        $notificationsUnseen = Notification::where([
            ['user_id', Auth::user()->id],
            ['status', '=', NotificationStatus::UNSEEN]
        ])->orderByDesc('id')->get();
        $notificationsSeen = Notification::where([
            ['user_id', Auth::user()->id],
            ['status', '=', NotificationStatus::SEEN]
        ])->orderByDesc('id')->get();
        $notificationsDelete = Notification::where([
            ['user_id', Auth::user()->id],
            ['status', '=', NotificationStatus::DELETED]
        ])->orderByDesc('id')->get();
        return view('frontend/pages/profile/my-notification', compact('notifications',
            'notificationsSeen',
            'notificationsUnseen',
            'notificationsDelete'));
    }

    public function checkAll(){
        Notification::where([
            ['user_id', Auth::user()->id],
            ['status', '=', NotificationStatus::UNSEEN]
        ])->update(['status' => NotificationStatus::SEEN]);

        return redirect(route('notification.show'));
    }

    public function delete($id){
        Notification::where('id', $id)->update(['status' => NotificationStatus::DELETED]);
        return redirect(route('notification.show'));
    }
}
