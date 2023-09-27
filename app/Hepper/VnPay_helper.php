<?php

use App\Enums\CartStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('checkoutByVNPay')) {
   function checkoutByVNPay(Request $request)
    {
        $money = $request->input('priceID') * 24372;
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "DX99JC99";
        $vnp_HashSecret = "NTMFIAYIYAEFEAMZVWNCESERJMBVROKS";
        $vnp_Returnurl = route('return.checkout.payment');
        $vnp_TxnRef = date("YmdHis");
        $vnp_Amount = $money * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        alert()->error('errors', 'Payment errors!');
        return redirect($vnp_Url);

    }
}
if (!function_exists('returnCheckout')) {
    function returnCheckout(Request $request)
    {
        $url = session('url_prev','/');
        if($request->vnp_ResponseCode == "00") {
            $vnpAmount = $request->input('vnp_Amount');
            $vnpBankCode = $request->input('vnp_BankCode');
            $vnpBankTranNo = $request->input('vnp_BankTranNo');
            $time = $request->input('vnp_PayDate');
            $responseCode = $request->input('vnp_ResponseCode');
            $note = $request->input('vnp_OrderInfo');
            $userId = Auth::user()->id;
            $costId = $request->input('vnp_TxnRef');

            DB::table('payments_vnpay')->insert([
                'money' => $vnpAmount/100,
                'code_bank' => $vnpBankCode,
                'code_vnpay' => $vnpBankTranNo,
                'time' => $time,
                'vnp_response_code' => $responseCode,
                'note' => $note,
                'user_id' => $userId,
                'cost_id' => $costId,
            ]);
            if (Auth::check()) {
                DB::table('carts')->where([['user_id', Auth::user()->id], ['status', CartStatus::WAIT_ORDER]])->update([
                    'status' => CartStatus::ORDERED
                ]);
                alert()->success('Success', 'Đã thanh toán phí dịch vụ');
//                return redirect($url)->with('success' ,'Đã thanh toán phí dịch vụ');
                return view('frontend.pages.PaymentMethods.vnpay_return');
            }

            alert()->error('errors', 'errors');
            return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
        }
        session()->forget('url_prev');
        return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
}
