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
        return view('frontend.pages.mail-seller.list', compact('mailogs'));
    }

    public function delete($id)
    {
        try {
            $mailog = MailSendSellerLog::find($id);
            if (!$mailog || $mailog->status == MailSendSellerLogStatus::DELETED) {
                return back();
            }
            $mailog->status = MailSendSellerLogStatus::DELETED;
            $mailog->save();
            alert()->success('Success', 'Delete successfully.');
            return redirect(route('user.list.mail.seller'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again!');
            return back();
        }
    }
}
