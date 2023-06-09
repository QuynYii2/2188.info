<?php

namespace App\Http\Controllers;

use App\Enums\NotificationStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\TimeLevelStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Notification;
use App\Models\TimeLevelTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $permissions = DB::table('permission_user')->where([['user_id', Auth::user()->id], ['status', PermissionUserStatus::INACTIVE]])->get();
        return view('frontend/pages/payment', compact('permissions'));
    }

    public function createTransaction()
    {
        return view('transaction');
    }

    public function paypalTotal(Request $request, $total, $successUrl)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => $successUrl,
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total,
                    ]
                ]
            ]
        ]);

        return $response;
    }

    public function processTransaction(Request $request)
    {
        $permissions = DB::table('permission_user')->where([['user_id', Auth::user()->id], ['status', PermissionUserStatus::INACTIVE]])->get();

        $number = count($permissions);

        $response = $this->paypalTotal($request, $number * 10, route('successTransaction'));

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('payment.show')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('payment.show')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $timeTables = TimeLevelTable::where([['user_id', Auth::user()->id], ['status', TimeLevelStatus::INACTIVE]])->get();
            for ($i = 0; $i < count($timeTables); $i++) {
                $this->changeStatusTimetable($timeTables[$i]->id);
            }

            $permissions = DB::table('permission_user')->where([['user_id', Auth::user()->id], ['status', PermissionUserStatus::INACTIVE]])->get();
            for ($i = 0; $i < count($permissions); $i++) {
                $this->changeStatusPermission($permissions[$i]->id);
            }

            $noti = [
                'user_id' => Auth::user()->id,
                'content' => "Thanh toán gói quyền thành công!",
                'description' => 'Thanh toán thành công',
                'status' => NotificationStatus::UNSEEN,
            ];

            Notification::create($noti);

            return redirect()
                ->route('permission.user.show')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('payment.show')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('home')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    private function changeStatusPermission($id)
    {
        DB::table('permission_user')->where('id', $id)->update(['status' => PermissionUserStatus::ACTIVE]);;
    }

    private function changeStatusTimetable($id)
    {
        $now = Carbon::now()->addHours(7);
        DB::table('time_level_tables')->where('id', $id)->update(['status' => TimeLevelStatus::ACTIVE, 'activation_date' => $now, 'expiration_date' => $now->addYear()]);;
    }
}
