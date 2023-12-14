<?php

namespace App\Http\Controllers\Seller;

use App\Enums\MailSendSellerLogStatus;
use App\Http\Controllers\Controller;
use App\Models\MailSendSellerLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerMailSendSellerLogController extends Controller
{
    public function index()
    {
        $mailogs = DB::table('mail_send_seller_logs')
            ->join('products', 'products.id', '=', 'mail_send_seller_logs.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->where('mail_send_seller_logs.status', MailSendSellerLogStatus::ACTIVE)
            ->select('mail_send_seller_logs.*', 'products.name')
            ->orderBy('mail_send_seller_logs.id', 'desc')
            ->get();

        return view('backend.mail-seller.list', compact('mailogs'));
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
            return redirect(route('seller.list.mail.seller'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again!');
            return back();
        }
    }
}
