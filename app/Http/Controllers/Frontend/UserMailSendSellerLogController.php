<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\MailSendSellerLogStatus;
use App\Http\Controllers\Controller;
use App\Models\MailSendSellerLog;
use Illuminate\Support\Facades\Auth;

class UserMailSendSellerLogController extends Controller
{
    public function index()
    {
        $mailogs = MailSendSellerLog::where('user_id', Auth::user()->id)
            ->where('status', MailSendSellerLogStatus::ACTIVE)
            ->orderBy('id', 'desc')
            ->get();
    }
}
