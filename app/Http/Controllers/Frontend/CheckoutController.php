<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\CartStatus;
use App\Enums\CoinStatus;
use App\Enums\NotificationStatus;
use App\Enums\OrderItemStatus;
use App\Enums\OrderMethod;
use App\Enums\OrderStatus;
use App\Enums\PriceUpLevel;
use App\Enums\UserInterestEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaypalPaymentController;
use App\Models\Cart;
use App\Models\Coin;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\RankSetUpSeller;
use App\Models\RankUserSeller;
use App\Models\Revenue;
use App\Models\StorageProduct;
use App\Models\User;
use App\Models\VoucherItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            $number = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->count();
            $carts = Cart::where([
                ['user_id', '=', Auth::user()->id],
                ['status', '=', CartStatus::WAIT_ORDER]
            ])->get();
            $user = User::find(Auth::user()->id);
            $voucherItems = VoucherItem::where('customer_id', Auth::user()->id)->get();

            $totalSaleByRank = $this->findDiscount($carts);
            return view('frontend/pages/checkout', compact('number', 'carts', 'user', 'voucherItems', 'totalSaleByRank'));
        } else {
            return view('frontend/pages/login');
        }
    }

    private function calcSoLuongSPTrongKho($carts)
    {
        $product_id = $carts->product_id;
        $quantity = $carts->quantity;

        $product = Product::where([['id', '=', $product_id]])->first();
        $storage = StorageProduct::where([['id', '=', $product->storage_id]])->first();

        $qtyCalc = $storage->quantity - $quantity;
        $product->qty = $qtyCalc;
        $storage->quantity = $qtyCalc;

        $product->save();
        $storage->save();
    }

    private function checkout(Request $request, $status, $orderMethod, $name, $email, $phone, $address, $idVoucher, $array)
    {
        $carts = Cart::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', CartStatus::WAIT_ORDER]
        ])->get();
        $realTotalPrice = 0;

        foreach ($carts as $cart) {
            $realTotalPrice = $realTotalPrice + ($cart->price * $cart->quantity);
        }

        $array = explode(',', $array);

        $order = [
            'user_id' => Auth::user()->id,
            'fullname' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'orders_method' => $orderMethod,
            'total_price' => $array[0],
            'shipping_price' => $array[1],
            'discount_price' => $array[2],
            'total' => $array[3],
            'status' => $status
        ];

        Order::create($order);

        $totalCheck = 0;
        $listOrder = Order::where('user_id', Auth::user()->id)->get();
        $user = User::find(Auth::user()->id);
        foreach ($listOrder as $item) {
            $totalCheck = $totalCheck + $item->total;
        }

        if (1 <= count($listOrder) && count($listOrder) < 10) {
            if (PriceUpLevel::LEVEL1 <= $totalCheck && $totalCheck < PriceUpLevel::LEVEL2) {
                $user->level_account = UserInterestEnum::VIP;
            } elseif (PriceUpLevel::LEVEL2 <= $totalCheck && $totalCheck < PriceUpLevel::LEVEL3) {
                $user->level_account = UserInterestEnum::VVIP;
            } elseif (PriceUpLevel::LEVEL3 <= $totalCheck) {
                $user->level_account = UserInterestEnum::SVIP;
            } else {
                $user->level_account = UserInterestEnum::FREE;
            }
        } elseif (10 <= count($listOrder) && count($listOrder) < 20) {
            if (PriceUpLevel::LEVEL2 <= $totalCheck && $totalCheck < PriceUpLevel::LEVEL3) {
                $user->level_account = UserInterestEnum::VVIP;
            } elseif (PriceUpLevel::LEVEL3 <= $totalCheck) {
                $user->level_account = UserInterestEnum::SVIP;
            } else {
                $user->level_account = UserInterestEnum::VIP;
            }
        } elseif (20 <= count($listOrder) && count($listOrder) < 50) {
            if (PriceUpLevel::LEVEL3 <= $totalCheck) {
                $user->level_account = UserInterestEnum::SVIP;
            } else {
                $user->level_account = UserInterestEnum::VVIP;
            }
        } elseif (50 <= count($listOrder)) {
            $user->level_account = UserInterestEnum::SVIP;
        }

        $user->save();

        $orders = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', $status]
        ])->get();

        $number = count($orders);

        foreach ($carts as $cart) {
            $productDetail = \App\Models\Variation::where([
                ['product_id', $cart->product->id],
                ['variation', $cart->values]
            ])->first();

            $item = [
                'order_id' => $orders[$number - 1]->id,
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'price' => $productDetail->price,
                'variable' => $productDetail->id,
                'status' => OrderItemStatus::ACTIVE
            ];
            OrderItem::create($item);

            $product = Product::find($cart->product->id);
            $seller_id = $product->user_id;

            $revenue = Revenue::where([
                ['seller_id', $seller_id],
                ['date', '>', Carbon::now()->addHours(7)->startOfDay()],
                ['date', '<', Carbon::now()->addHours(7)->endOfDay()]
            ])->first();

            if ($revenue) {
                $revenue->revenue = $revenue->revenue + $cart->quantity * $cart->product->price;
                $revenue->save();
            } else {
                (new HomeController())->getLocale($request);
                $local = app()->getLocale();
                $revenue = [
                    'seller_id' => $seller_id,
                    'location' => $local,
                    'rank' => 'FREE',
                    'date' => Carbon::now()->addHours(7),
                    'revenue' => $cart->quantity * $cart->product->price,
                ];

                Revenue::create($revenue);
            }
        }

        $this->deleteVoucher($idVoucher);

        foreach ($carts as $cart) {
            $this->calcSoLuongSPTrongKho($cart);
            $cart->status = CartStatus::ORDERED;
            $cart->save();
        }

        return $order;
    }

    private function deleteVoucher($id)
    {
        VoucherItem::where([['voucher_id', $id], ['customer_id', Auth::user()->id]])->delete();
    }

    private function notifiCreate()
    {
        $noti = [
            'user_id' => Auth::user()->id,
            'content' => "Thanh toán đơn hàng thành công!",
            'description' => 'Thanh toán thành công',
            'status' => NotificationStatus::UNSEEN,
        ];

        Notification::create($noti);

        return $noti;
    }

    public function checkoutByImme(Request $request)
    {
        $status = OrderStatus::WAIT_PAYMENT;
        $idVoucher = $request->input('voucherID');
        $name = $request->input('fullname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $total = $request->input('total_price');
        $shippingPrice = $request->input('shipping_price');
        $salePrice = $request->input('discount_price');
        $checkOutPrice = $request->input('priceID');
        $array[] = $total;
        $array[] = $shippingPrice;
        $array[] = $salePrice;
        $array[] = $checkOutPrice;
        $array = implode(',', $array);
        $this->checkout($request, $status, OrderMethod::IMMEDIATE, $name, $email, $phone, $address, $idVoucher, $array);
        alert()->success('Success', 'Đặt hàng thành công');
        return redirect()->route('order.show');
    }

    public function checkoutByCoin(Request $request)
    {
        $status = OrderStatus::WAIT_PAYMENT;
        $realTotalPrice = $request->input('priceID');
        $coin = Coin::where([['user_id', Auth::user()->id], ['status', CoinStatus::ACTIVE]])->first();
        $realTotalPrice9 = $realTotalPrice * 9;
        if ($coin != null) {
            if ($coin->quantity >= $realTotalPrice9) {
                $coin->quantity = $coin->quantity - $realTotalPrice9;
                $coin->save();

                $this->notifiCreate();

                $status = OrderStatus::PROCESSING;
                $idVoucher = $request->input('voucherID');
                $name = $request->input('fullname');
                $email = $request->input('email');
                $phone = $request->input('phone');
                $address = $request->input('address');
                $total = $request->input('total_price');
                $shippingPrice = $request->input('shipping_price');
                $salePrice = $request->input('discount_price');
                $checkOutPrice = $request->input('priceID');
                $array[] = $total;
                $array[] = $shippingPrice;
                $array[] = $salePrice;
                $array[] = $checkOutPrice;
                $array = implode(',', $array);
                $order = $this->checkout($request, $status, OrderMethod::SHOPPING_MALL_COIN, $name, $email, $phone, $address, $idVoucher, $array);
                return redirect()->route('order.show')->with('success', 'Transaction complete.');
            }
        }
        return redirect()->route('checkout.show')->with('error', 'Checkout fail');
    }

    public function checkoutByPaypal(Request $request)
    {
        $idVoucher = $request->input('voucherID');
        $name = $request->input('fullname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $realTotalPrice = $request->input('priceID');
        $total = $request->input('total_price');
        $shippingPrice = $request->input('shipping_price');
        $salePrice = $request->input('discount_price');
        $checkOutPrice = $request->input('priceID');
        $array[] = $total;
        $array[] = $shippingPrice;
        $array[] = $salePrice;
        $array[] = $checkOutPrice;
        $array = implode(',', $array);
        $response = (new PaypalPaymentController())->paypalTotal($request, $realTotalPrice, route('checkout.success.paypal', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'idVoucher' => $idVoucher,
            'array' => $array,
        ]));

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('checkout.show')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('checkout.show')
                ->with('error', $response['message'] ?? 'Something went wrong back');
        }
    }

    public function checkoutSuccess(Request $request, $name, $email, $phone, $address, $idVoucher, $array)
    {
        $status = OrderStatus::WAIT_PAYMENT;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $status = OrderStatus::PROCESSING;

            $order = $this->checkout($request, $status, OrderMethod::ElectronicWallet, $name, $email, $phone, $address, $idVoucher, $array);

            $this->notifiCreate();

            return redirect()
                ->route('order.show')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('checkout.show')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    private function findDiscount($carts)
    {
        $totalSaleByRank = 0;
        $ranks = null;
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $sellerID = $product->user_id;
            $setup = RankSetUpSeller::where('user_id', $sellerID)->first();
            if ($setup){
                $orderItems = DB::table('order_items')
                    ->join('orders', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'products.id', '=', 'order_items.product_id')
                    ->where([
                        ['orders.user_id', '=', Auth::user()->id],
                        ['products.user_id', $sellerID]
                    ])
                    ->select('order_items.*', 'products.user_id')
                    ->get();
                $total = 0;
                foreach ($orderItems as $orderItem) {
                    $total = $total + $orderItem->price * $orderItem->quantity;
                }
                $arrayRank = explode(',', $setup->setup);
                for ($i = 0; $i < 4; $i++) {
                    $detailRank = $arrayRank[$i];
                    $arrayDetailRank = explode(':', $detailRank);
                    $value = (int)$arrayDetailRank[1];
                    if ($total > $value) {
                        $ranks = $arrayDetailRank[0];
                    }
                }
                $ranks = str_replace(' ', '', $ranks);
                $arrayShops = [];
                $rankUsers = RankUserSeller::all();

                foreach ($rankUsers as $rankUser) {
                    $listRanks = $rankUser->apply;
                    $array = explode(',', $listRanks);
                    foreach ($array as $item) {
                        $rankCurrent = explode('-', $ranks);
                        foreach ($rankCurrent as $str) {
                            if ($str == $item) {
                                $arrayShops[] = $rankUser->user_id . "-" . $rankUser->percent;
                            }
                        }
                    }
                }

                $arrayProducts = [];
                if (!empty($arrayShops)) {
                    foreach ($arrayShops as $shop) {
                        $myArray = explode('-', $shop);

                        foreach ($carts as $cart) {
                            $product = Product::find($cart->product_id);

                            if ($product->user_id == $myArray[0]) {
                                $arrayProducts[] = $cart->price . "-" . $cart->quantity . "-" . $myArray[1] . "-" . $cart->product_id;
                            }
                        }
                    }
                }

                $arrayTotal = [];
                $totalSaleByRankNews = 0;

                if (!empty($arrayProducts)) {
                    foreach ($arrayProducts as $product) {
                        $saleArray = explode('-', $product);
                        $totalPrice = $saleArray[0] * $saleArray[1] * $saleArray[2] / 100;
                        $totalSaleByRankNews += $totalPrice;
                        $arrayTotal[] = $saleArray[3] . "-" . $totalPrice;
                    }

                    if ($totalSaleByRankNews > $totalSaleByRank) {
                        $totalSaleByRank = $totalSaleByRankNews;
                    }
                }
            }
        }
        return $totalSaleByRank;
    }
}
