<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\AddressOrderStatus;
use App\Enums\CartStatus;
use App\Enums\CoinStatus;
use App\Enums\MemberPartnerStatus;
use App\Enums\MemberRegisterInfoStatus;
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
use App\Models\MemberPartner;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderAddress;
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
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        (new HomeController())->getLocale($request);
        $currency = (new HomeController())->getLocation($request);
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

            $address = OrderAddress::where('user_id', Auth::user()->id)
                ->where('status', AddressOrderStatus::ACTIVE)
                ->where(function ($query) {
                    $query->where('default', 1)
                        ->orWhereNull('default');
                })
                ->first();

            return view('frontend/pages/checkout', compact('address', 'number', 'carts', 'user', 'voucherItems', 'totalSaleByRank', 'currency'));
        } else {
            return view('frontend/pages/login');
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
            if ($setup) {
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
        if (locationHelper() == 'kr') {
            alert()->success('성공', '주문 성공했습니다');
        } elseif (locationHelper() == 'vi') {
            alert()->success('Thành công', 'Đặt hàng thành công');
        } elseif (locationHelper() == 'cn') {
            alert()->success('成功', '订单成功');
        } elseif (locationHelper() == 'jp') {
            alert()->success('成功」、「注文は成功しました」');
        } else {
            alert()->success('Success', 'Order Success');
        }
        return redirect()->route('order.show');
    }

    private function checkout(Request $request, $status, $orderMethod, $name, $email, $phone, $address, $idVoucher, $array)
    {
        (new HomeController())->getLocale($request);
        $carts = Cart::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', CartStatus::WAIT_ORDER]
        ])->get();
        $realTotalPrice = 0;
        foreach ($carts as $cart) {
            if ($cart->member == 1) {
                $productCart = Product::find($cart->product_id);
                $user = User::find($productCart->user_id);
                $memberPerson = MemberRegisterPersonSource::where('email', $user->email)->first();
                $memberProduct = null;
                if ($memberPerson) {
                    $memberProduct = MemberRegisterInfo::where([
                        ['id', $memberPerson->member_id],
                        ['status', MemberRegisterInfoStatus::ACTIVE]
                    ])->first();
                }
                if ($memberProduct) {
                    $userCurrent = Auth::user();
                    $memberPersonCurrent = MemberRegisterPersonSource::where('email', $userCurrent->email)->first();
                    $memberCurrent = null;
                    $memberCurrent = MemberRegisterInfo::where([
                        ['id', $memberPersonCurrent->member_id],
                        ['status', MemberRegisterInfoStatus::ACTIVE]
                    ])->first();
                    if ($memberCurrent) {
                        $memberPartner = MemberPartner::where([
                            ['company_id_source', $memberProduct->id],
                            ['company_id_follow', $memberCurrent->id],
                            ['status', MemberPartnerStatus::ACTIVE]
                        ])->first();
                        if ($memberPartner) {
                            $memberPartner->price = $memberPartner->price + ($cart->price * $cart->quantity);
                            $memberPartner->quantity = $memberPartner->quantity + 1;
                            $memberPartner->save();
                        } else {
                            $item = [
                                'company_id_source' => $memberProduct->id,
                                'company_id_follow' => $memberCurrent->id,
                                'quantity' => 1,
                                'price' => ($cart->price * $cart->quantity),
                            ];
                            MemberPartner::create($item);
                        }
                    }
                }
            }
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

        $od = Order::create($order);
        session(['order' => $od]);

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
            $item = null;
            if ($productDetail) {
                $item = [
                    'order_id' => $orders[$number - 1]->id,
                    'product_id' => $cart->product->id,
                    'quantity' => $cart->quantity,
                    'price' => $productDetail->price,
                    'variable' => $productDetail->id,
                    'status' => OrderItemStatus::ACTIVE
                ];
            } else {
                $item = [
                    'order_id' => $orders[$number - 1]->id,
                    'product_id' => $cart->product->id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'variable' => 0,
                    'status' => OrderItemStatus::ACTIVE
                ];
            }
            (new HomeController())->createStatisticShopDetail('orders', $cart->product->user_id);
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

    private function calcSoLuongSPTrongKho($carts)
    {
        try {
            $product_id = $carts->product_id;
            $quantity = $carts->quantity;

            $product = Product::where([['id', '=', $product_id]])->first();
            $storage = StorageProduct::where([['id', '=', $product->storage_id]])->first();

            if ($storage) {
                $qtyCalc = $storage->quantity - $quantity;
                $product->qty = $qtyCalc;
                $storage->quantity = $qtyCalc;

                $product->save();
                $storage->save();
            }
        } catch (\Exception $exception) {
            return $exception;
        }
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

    public function returnCheckout(Request $request)
    {
        (new HomeController())->getLocale($request);
        $url = session('url_prev', '/');

        if ($request->vnp_ResponseCode == "00") {
            $vnpAmount = $request->input('vnp_Amount');
            $vnpBankCode = $request->input('vnp_BankCode');
            $vnpBankTranNo = $request->input('vnp_BankTranNo');
            $time = $request->input('vnp_PayDate');
            $responseCode = $request->input('vnp_ResponseCode');
            $note = $request->input('vnp_OrderInfo');
            $userId = Auth::user()->id;
            $email = Auth::user()->email;
            $costId = $request->input('vnp_TxnRef');
            $order = session('order');
            $orderItems = null;
            $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();

            DB::table('payments_vnpay')->insert([
                'money' => $vnpAmount / 100,
                'code_bank' => $vnpBankCode,
                'code_vnpay' => $vnpBankTranNo,
                'time' => $time,
                'vnp_response_code' => $responseCode,
                'note' => $note,
                'user_id' => $userId,
                'cost_id' => $costId,
                'orders_method' => OrderMethod::ElectronicWallet,
                'status' => OrderStatus::PROCESSING
            ]);
            if (Auth::check()) {
                DB::table('carts')->where([['user_id', Auth::user()->id],
                    ['status', CartStatus::WAIT_ORDER]
                ])->update([
                    'status' => CartStatus::ORDERED
                ]);
                DB::table('orders')->update([
                    'status' => OrderStatus::PROCESSING
                ]);
                $email = session('emailTo');
                $adminID = DB::table('role_user')->where('role_id', '=', 1)->first('user_id');
                $admin = DB::table('users')->where('id', '=', $adminID->user_id)->first('email');
                $this->sendMail($email);
                $this->sendMail($admin->email);
                return view('frontend.pages.PaymentMethods.vnpay_return', compact([
                    'email', 'orderItems'
                ]));
            }

            alert()->error('errors', 'errors');
            return redirect($url)->with('errors', 'Lỗi trong quá trình thanh toán phí dịch vụ');
        }
        session()->forget('url_prev');
        return redirect($url)->with('errors', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

    public function sendMail($email)
    {
        $order = session('order');
        $data = ['message' => '$request->input()'];
        Mail::send('frontend/widgets/mailCode', $data, function ($message) use ($email) {
            $message->to([$email], 'Verify mail!')->subject
            ('Verify mail');
            $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
        });
    }

    public function checkoutByVNPay(Request $request)
    {
        $emailTo = $request->input('email');
        session(['emailTo' => $emailTo]);
        $money = $request->input('priceID') * 24372;
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "DX99JC99";
        $vnp_HashSecret = "NTMFIAYIYAEFEAMZVWNCESERJMBVROKS";
        $vnp_Returnurl = route('return.checkout.payment');
        $vnp_TxnRef = date("YmdHis");
        $vnp_Amount = $money * 100;
        $vnp_Locale = 'vn';
        $user = Auth::user();
        $vnp_IpAddr = $request->input('address');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $vnpAmount = $request->input('total_price');
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
        $shippingPrice = $request->input('shipping_price');
        $salePrice = $request->input('discount_price');
        $array[] = $vnpAmount;
        $array[] = $shippingPrice;
        $array[] = $salePrice;
        $array[] = $money;
        $array = implode(',', $array);

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
        $order = $this->checkout($request, $status = OrderStatus::WAIT_PAYMENT,
            OrderMethod::ElectronicWallet,
            $name = $request->input('fullname'),
            $email = $emailTo,
            $phone = $request->input('phone'),
            $address = $request->input('address'),
            $idVoucher = $request->input('voucherID'),
            $array);

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
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        alert()->error('errors', 'Payment errors!');
        return redirect($vnp_Url);

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
}
