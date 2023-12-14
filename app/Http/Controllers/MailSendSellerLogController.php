<?php

namespace App\Http\Controllers;

use App\Enums\MailSendSellerLogStatus;
use App\Models\MailSendSellerLog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailSendSellerLogController extends Controller
{
    public function create(Request $request)
    {
        try {
            $mailog = new MailSendSellerLog();

            $email = $request->input('email');
            $product_id = $request->input('product_id');
            $product_quantity = $request->input('product_quantity');
            $product_fn = $request->input('product_fn');
            $content = $request->input('content');
            $status = MailSendSellerLogStatus::ACTIVE;

            $mailog->email = $email;
            $mailog->product_id = $product_id;
            $mailog->product_quantity = $product_quantity;
            $mailog->product_fn = $product_fn;
            $mailog->content = $content;
            $mailog->status = $status;
            $mailog->user_id = Auth::user()->id;

            $product = Product::find($product_id);
            $mailog->save();

            $data = array('mail' => $email, 'product' => $product, 'mailog' => $mailog);
            $seller = User::find($product->user_id);
            $mail = $seller->email;

            Mail::send('frontend/layouts/mail/mail-seller', $data, function ($message) use ($mail) {
                $message->to($mail, 'Contact mail!')->subject('Contact mail');
                $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
            });
            alert()->success('Success', 'Send successfully.');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again');
            return back();
        }
    }
}
