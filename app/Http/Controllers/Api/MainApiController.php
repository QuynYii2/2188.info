<?php

namespace App\Http\Controllers\Api;

use App\Enums\MemberRegisterInfoStatus;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\MemberRegisterInfo;
use App\Models\User;
use Illuminate\Http\Request;

class MainApiController extends Controller
{
    public function checkEmailUser(Request $request)
    {
        $error = __('message-alert.Error, Please try again!');
        try {
            $email = $request->input('email');

            $user = User::where('email', $email)
                ->where('status', '!=', UserStatus::DELETED)
                ->first();
            $error = __('message-alert.Error, Email is user used!');
            $success = __('message-alert.Email is available!');
            if (!$user) {
                return response($this->returnMessage($success), 200);
            }
            return response($this->returnMessage($error), 201);
        } catch (\Exception $exception) {
            return response($this->returnMessage($error), 400);
        }
    }

    public function returnMessage($message)
    {
        return ['message' => $message];
    }

    public function checkEmailCompany(Request $request)
    {
        try {
            $email = $request->input('email');

            $user = MemberRegisterInfo::where('email', $email)
                ->where('status', '!=', MemberRegisterInfoStatus::DELETED)
                ->first();

            if (!$user) {
                return response($this->returnMessage('Success, member not found!'), 200);
            }
            return response($this->returnMessage('Success, member has been found!'), 201);
        } catch (\Exception $exception) {
            return response($this->returnMessage('Error, please try again!'), 400);
        }
    }

    public function checkEmail(Request $request)
    {
        $error = __('message-alert.Error, Please try again!');
        try {
            $email = $request->input('email');

            $member = MemberRegisterInfo::where('email', $email)
                ->where('status', '!=', MemberRegisterInfoStatus::DELETED)
                ->first();

            $user = User::where('email', $email)
                ->where('status', '!=', UserStatus::DELETED)
                ->first();

            $error_email = __('message-alert.Error, Email in member used!!');
            $success = __('message-alert.Email is available!');

            if ($member) {
                return response($this->returnMessage($error_email), 201);
            }

            $error_email = __('message-alert.Error, Email is user used!');
            if ($user) {
                return response($this->returnMessage($error_email), 201);
            }

            return response($this->returnMessage($success), 200);
        } catch (\Exception $exception) {
            return response($this->returnMessage($error), 400);
        }
    }
}
