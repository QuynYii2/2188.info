<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\UserStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($size = 10)
    {
        $getAllUser = User::paginate($size);
        return view('backend.account_manage.account-manage', compact('getAllUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::where('user_id', $id)->orderByDesc('id')->get();
        return view('backend.account_manage.show-shop', compact('products'));
    }

    public function viewCart($id)
    {
        $orderAll = Order::where([
            ['user_id', '=', Auth::user()->id],
        ])->get();

        $orderWaitPay = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::WAIT_PAYMENT]
        ])->get();

        $orderProcessing = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::PROCESSING]
        ])->get();

        $orderShipping = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::SHIPPING]
        ])->get();

        $orderDelivered = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::DELIVERED]
        ])->get();

        $orderCancel
            = Order::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', OrderStatus::CANCELED]
        ])->get();

        return view('backend.account_manage.show-order', compact(
            'orderAll',
            'orderWaitPay',
            'orderProcessing',
            'orderShipping',
            'orderDelivered',
            'orderCancel'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $user = User::findOrFail($id);
        $user->status = UserStatus::INACTIVE;
        $user->save();

        return redirect(route('account.manage.show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('account.manage.show'));
    }
}
