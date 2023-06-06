<?php

namespace App\Http\Controllers;

use App\Enums\CoinStatus;
use App\Enums\NotificationStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Coin;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CoinController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);

        $reflector = new \ReflectionClass('App\Enums\CoinCombo');
        $comboCoin = $reflector->getConstants();

        return view('frontend/pages/buy-coin', compact('comboCoin'));
    }

    public function store(Request $request)
    {
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        if ($price == null) {
            return redirect()->route('cancelTransaction');
        }
        if ($quantity == null) {
            $quantity = $price * 10;
        }

        $url = asset("/buy-coin-success?price=$price&quantity=$quantity");

        $response = (new PaypalPaymentController())->paypalTotal($request, $price, route('buy.coin.success', ['price' => $price, 'quantity' => $quantity]));

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('home')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('home')
                ->with('error', $response['message'] ?? 'Something went wrong back');
        }
    }

    public function successPayment(Request $request, $price, $quantity)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $oldCoin = Coin::where([['user_id', Auth::user()->id], ['status', CoinStatus::ACTIVE]])->first();
            if ($oldCoin == null) {
                $coin = [
                    'user_id' => Auth::user()->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'status' => CoinStatus::ACTIVE,
                ];

                DB::table('coins')->insert($coin);
            } else {
                $price = $price + $oldCoin[0]->price;
                $quantity = $quantity + $oldCoin[0]->quantity;
                DB::table('coins')->where('user_id', Auth::user()->id)
                    ->first()
                    ->update(['quantity' => $quantity, 'price' => $price]);;
            }

            $noti = [
                'user_id' => Auth::user()->id,
                'content' => "Thanh toán coin thành công!",
                'description' => 'Thanh toán thành công',
                'status' => NotificationStatus::UNSEEN,
            ];

            Notification::create($noti);

            return redirect()
                ->route('profile.show')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('home')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
