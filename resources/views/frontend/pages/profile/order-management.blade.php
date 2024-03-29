@extends('backend.layouts.master')
@section('title', __('home.order management'))
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <style>
        td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            color: #000;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }
        td, th {
            border: none!important;
        }
    </style>
    <div class="row p-4 bg-white rounded" id="address-book">

        <div class="border-bottom"></div>
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs nav-fill d-flex justify-content-between align-items-center"
                     id="nav-tab" role="tablist">
                    <a class="nav-item link-tabs-order nav-link active" data-toggle="tab" data-target="#nav-1"
                       role="tab" aria-controls="nav-1" aria-selected="true">
                        {{ __('home.all orders') }}
                    </a>
                    <a class="nav-item link-tabs-order nav-link" data-toggle="tab" data-target="#nav-2" role="tab"
                       aria-controls="nav-2" aria-selected="false">
                        {{ __('home.waiting for payment') }}
                    </a>
                    <a class="nav-item link-tabs-order nav-link" data-toggle="tab" data-target="#nav-3"
                       role="tab" aria-controls="nav-3" aria-selected="false">
                        {{ __('home.processing') }}
                    </a>
                    <a class="nav-item link-tabs-order nav-link" data-toggle="tab" data-target="#nav-4" role="tab"
                       aria-controls="nav-4" aria-selected="false">
                        {{ __('home.shipping') }}
                    </a>
                    <a class="nav-item link-tabs-order nav-link" data-toggle="tab" data-target="#nav-5" role="tab"
                       aria-controls="nav-4" aria-selected="false">
                        {{ __('home.delivered') }}
                    </a>
                    <a class="nav-item link-tabs-order nav-link" data-toggle="tab" data-target="#nav-6" role="tab"
                       aria-controls="nav-4" aria-selected="false">
                        {{ __('home.canceled') }}
                    </a>
                </div>
            </nav>
            @php
                $currencyController = new \App\Http\Controllers\CurrencyController();
            @endphp
            <div class="row rounded pt-4  d-flex align-center justify-content-center">
                <span class="order-mana">{{ __('home.order management') }}</span>
            </div>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade text-center active show" id="nav-1" role="tabpanel"
                     aria-labelledby="nav-contact-tab">
                    @if ($orderAll->isEmpty())
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no order') }}</p>
                    @else
                        <div class="d-flex justify-content-between">
{{--                            <div class="">Total:{{count($orderAll)}}</div>--}}
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('OrderID') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Shipping Price') }}</th>
                                <th>{{ __('Discount Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orderAll as $order)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" data-toggle="modal"
                                                data-target="#updateOrder{{$order->id}}"
                                                style="cursor: pointer;color: red;">#{{ $loop->index+1 }}</a>
                                        <div class="modal fade" id="updateOrder{{$order->id}}" tabIndex="-1"
                                             role="dialog"
                                             aria-labelledby="editModalLabel">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-content">
                                                    <div class="modal-header" style="border-bottom: 0;">
                                                        <h5 class="modal-title title-modal" id="exampleModalLabel">Detail
                                                            Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="delete-account-form"
                                                              action="{{route('order.cancel', $order->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>{{ __('Name') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php
                                                                        $order_items = \App\Models\OrderItem::where('order_id', $order->id)->get();
                                                                    @endphp
                                                                    @foreach ($order_items as $order_item)
                                                                        @php
                                                                            $product = \App\Models\Product::find($order_item->product_id);
                                                                        @endphp
                                                                        <tr>
                                                                            <td>
                                                                                @if ($product)
                                                                                    {{ ($product->name) }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ ($order_item->quantity) }}
                                                                            </td>
                                                                            @php
                                                                                $currencyValue = $currencyController->getCurrency(request(), $order_item->price);
                                                                            @endphp

                                                                            <td class="currency-color">
                                                                                {{ ($currencyValue) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="d-flex justify-content-around">
                                                                @if($order->status == \App\Enums\OrderStatus::PROCESSING  || $order->status == \App\Enums\OrderStatus::WAIT_PAYMENT)
                                                                    <button type="submit"
                                                                            class="btn w-25 btn-danger btn-cancel m-2">
                                                                        Cancel order
                                                                    </button>
                                                                @else
                                                                    <button class="btn w-25 btn-danger btn-cancel m-2"
                                                                            disabled>
                                                                        Cancel order
                                                                    </button>
                                                                @endif
                                                                <button type="button"
                                                                        class="btn w-25 btn-secondary-back m-2"
                                                                        data-dismiss="modal">Back
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ($order->orders_method) }}
                                    </td>
                                    <td>
                                        @php
                                            $currencyValue = $currencyController->getCurrency(request(), $order->shipping_price);
                                        @endphp
                                        {{ $currencyValue }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->discount_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    <td>
                                        @php
                                            $quantity = DB::table('order_items')->where('order_id', $order->id)->get();
                                        @endphp
                                        {{count($quantity)}}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->total);
                                    @endphp
                                    <td>
                                        {{$currencyValue}}
                                    </td>
                                    <td>
                                        {{$order->status}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="tab-pane fade text-center" id="nav-2" role="tabpanel"
                     aria-labelledby="nav-about-tab">
                    @if ($orderWaitPay->isEmpty())
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no order') }}</p>
                    @else
                        <div class="d-flex justify-content-between">
                            <div class="">Total:{{count($orderWaitPay)}}</div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('OrderID') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Shipping Price') }}</th>
                                <th>{{ __('Discount Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orderWaitPay as $order)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" data-toggle="modal"
                                           data-target="#updateOrder1{{$order->id}}"
                                           style="cursor: pointer;color: red;">#{{ $loop->index+1 }}</a>
                                        <div class="modal fade" id="updateOrder1{{$order->id}}" tabIndex="-1"
                                             role="dialog"
                                             aria-labelledby="editModalLabel">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-content">
                                                    <div class="modal-header" style="border-bottom: 0;">
                                                        <h5 class="modal-title title-modal" id="exampleModalLabel">Detail
                                                            Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="delete-account-form"
                                                              action="{{route('order.cancel', $order->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>{{ __('Name') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php
                                                                        $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();
                                                                    @endphp
                                                                    @foreach ($orderItems as $orderItem)
                                                                        @php
                                                                            $product1 = \App\Models\Product::find($orderItem->product_id);
                                                                        @endphp
                                                                        <tr>
                                                                            <td>
                                                                                @if ($product1)
                                                                                    {{ ($product1->name) }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ ($orderItem->quantity) }}
                                                                            </td>
                                                                            @php
                                                                                $currencyValue = $currencyController->getCurrency(request(), $orderItem->price);
                                                                            @endphp
                                                                            <td>
                                                                                {{ ($orderItem->price) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="d-flex justify-content-around">
                                                                @if($order->status == \App\Enums\OrderStatus::PROCESSING  || $order->status == \App\Enums\OrderStatus::WAIT_PAYMENT)
                                                                    <button type="submit"
                                                                            class="btn w-25 btn-danger btn-cancel m-2">
                                                                        Cancel order
                                                                    </button>
                                                                @else
                                                                    <button class="btn w-25 btn-danger btn-cancel m-2"
                                                                            disabled>
                                                                        Cancel order
                                                                    </button>
                                                                @endif
                                                                <button type="button"
                                                                        class="btn w-25 btn-secondary-back m-2"
                                                                        data-dismiss="modal">Back
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ($order->orders_method) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->shipping_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->discount_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    <td>
                                        @php
                                            $quantity = DB::table('order_items')->where('order_id', $order->id)->get();
                                        @endphp
                                        {{count($quantity)}}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->total);
                                    @endphp
                                    <td>
                                        {{$currencyValue}}
                                    </td>
                                    <td>
                                        {{$order->status}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="tab-pane fade text-center" id="nav-3" role="tabpanel"
                     aria-labelledby="nav-contact-tab">
                    @if ($orderProcessing->isEmpty())
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no order') }}</p>
                    @else
                        <div class="d-flex justify-content-between">
                            <div class="">Total:{{count($orderProcessing)}}</div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('OrderID') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Shipping Price') }}</th>
                                <th>{{ __('Discount Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orderProcessing as $order)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" data-toggle="modal"
                                           data-target="#updateOrder2{{$order->id}}"
                                           style="cursor: pointer;color: red;">#{{ $loop->index+1 }}</a>
                                        <div class="modal fade" id="updateOrder2{{$order->id}}" tabIndex="-1"
                                             role="dialog"
                                             aria-labelledby="editModalLabel">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-content">
                                                    <div class="modal-header" style="border-bottom: 0;">
                                                        <h5 class="modal-title title-modal" id="exampleModalLabel">Detail
                                                            Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="delete-account-form"
                                                              action="{{route('order.cancel', $order->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>{{ __('Name') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php
                                                                        $orderItem1s = \App\Models\OrderItem::where('order_id', $order->id)->get();
                                                                    @endphp
                                                                    @foreach ($orderItem1s as $order_item2)
                                                                        @php
                                                                            $product2 = \App\Models\Product::find($order_item2->product_id);
                                                                        @endphp
                                                                        <tr>
                                                                            <td>

                                                                                @if ($product2)
                                                                                    {{ ( $product2->name) }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ ($order_item2->quantity) }}
                                                                            </td>
                                                                            <td>
                                                                                {{ ($order_item2->price) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="d-flex justify-content-around">
                                                                @if($order->status == \App\Enums\OrderStatus::PROCESSING  || $order->status == \App\Enums\OrderStatus::WAIT_PAYMENT)
                                                                    <button type="submit"
                                                                            class="btn w-25 btn-danger btn-cancel m-2">
                                                                        Cancel order
                                                                    </button>
                                                                @else
                                                                    <button class="btn w-25 btn-danger btn-cancel m-2"
                                                                            disabled>
                                                                        Cancel order
                                                                    </button>
                                                                @endif
                                                                <button type="button"
                                                                        class="btn w-25 btn-secondary-back m-2"
                                                                        data-dismiss="modal">Back
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ($order->orders_method) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->shipping_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->discount_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    <td>
                                        @php
                                            $quantity = DB::table('order_items')->where('order_id', $order->id)->get();
                                        @endphp
                                        {{count($quantity)}}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->total);
                                    @endphp
                                    <td>
                                        {{$currencyValue}}
                                    </td>
                                    <td>
                                        {{$order->status}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="tab-pane fade text-center" id="nav-4" role="tabpanel"
                     aria-labelledby="nav-about-tab">
                    @if ($orderShipping->isEmpty())
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no order') }}</p>
                    @else
                        <div class="d-flex justify-content-between">
                            <div class="">Total:{{count($orderShipping)}}</div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('OrderID') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Shipping Price') }}</th>
                                <th>{{ __('Discount Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orderShipping as $order)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" data-toggle="modal"
                                           data-target="#updateOrder3{{$order->id}}"
                                           style="cursor: pointer;color: red;">#{{ $loop->index+1 }}</a>
                                        <div class="modal fade" id="updateOrder3{{$order->id}}" tabIndex="-1"
                                             role="dialog"
                                             aria-labelledby="editModalLabel">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-content">
                                                    <div class="modal-header" style="border-bottom: 0;">
                                                        <h5 class="modal-title title-modal" id="exampleModalLabel">Detail
                                                            Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="delete-account-form"
                                                              action="{{route('order.cancel', $order->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>{{ __('Name') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php
                                                                        $orderItem2s = \App\Models\OrderItem::where('order_id', $order->id)->get();
                                                                    @endphp
                                                                    @foreach ($orderItem2s as $order_item3)
                                                                        @php
                                                                            $product3 = \App\Models\Product::find($order_item3->product_id);
                                                                        @endphp
                                                                        <tr>
                                                                            <td>
                                                                                @if ($product3)
                                                                                    {{ ($product3->name) }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ ($order_item3->quantity) }}
                                                                            </td>
                                                                            @php
                                                                                $currencyValue = $currencyController->getCurrency(request(), $order_item5->price);
                                                                            @endphp
                                                                            <td>
                                                                                {{ ($currencyValue) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="d-flex justify-content-around">
                                                                @if($order->status == \App\Enums\OrderStatus::PROCESSING  || $order->status == \App\Enums\OrderStatus::WAIT_PAYMENT)
                                                                    <button type="submit"
                                                                            class="btn w-25 btn-danger btn-cancel m-2">
                                                                        Cancel order
                                                                    </button>
                                                                @else
                                                                    <button class="btn w-25 btn-danger btn-cancel m-2"
                                                                            disabled>
                                                                        Cancel order
                                                                    </button>
                                                                @endif
                                                                <button type="button"
                                                                        class="btn w-25 btn-secondary-back m-2"
                                                                        data-dismiss="modal">Back
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ($order->orders_method) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->shipping_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->discount_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    <td>
                                        @php
                                            $quantity = DB::table('order_items')->where('order_id', $order->id)->get();
                                        @endphp
                                        {{count($quantity)}}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->total);
                                    @endphp
                                    <td>
                                        {{$currencyValue}}
                                    </td>
                                    <td>
                                        {{ ($order->status) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="tab-pane fade text-center" id="nav-5" role="tabpanel"
                     aria-labelledby="nav-about-tab">
                    @if ($orderDelivered->isEmpty())
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no order') }}</p>
                    @else
                        <div class="d-flex justify-content-between">
                            <div class="">Total:{{count($orderDelivered)}}</div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('OrderID') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Shipping Price') }}</th>
                                <th>{{ __('Discount Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orderDelivered as $order)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" data-toggle="modal"
                                           data-target="#updateOrder4{{$order->id}}"
                                           style="cursor: pointer;color: red;">#{{ $loop->index+1 }}</a>
                                        <div class="modal fade" id="updateOrder4{{$order->id}}" tabIndex="-1"
                                             role="dialog"
                                             aria-labelledby="editModalLabel">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-content">
                                                    <div class="modal-header" style="border-bottom: 0;">
                                                        <h5 class="modal-title title-modal" id="exampleModalLabel">Detail
                                                            Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="delete-account-form"
                                                              action="{{route('order.cancel', $order->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>{{ __('Name') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php
                                                                        $orderItem3s = \App\Models\OrderItem::where('order_id', $order->id)->get();
                                                                    @endphp
                                                                    @foreach ($orderItem3s as $order_item4)
                                                                        @php
                                                                            $product4 = \App\Models\Product::find($order_item4->product_id);
                                                                        @endphp
                                                                        <tr>
                                                                            <td>
                                                                                @if ($product4)
                                                                                    {{ ($product4->name) }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ ($order_item4->quantity) }}
                                                                            </td>
                                                                            @php
                                                                                $currencyValue = $currencyController->getCurrency(request(), $order_item5->price);
                                                                            @endphp
                                                                            <td>
                                                                                {{ ($currencyValue) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="d-flex justify-content-around">
                                                                @if($order->status == \App\Enums\OrderStatus::PROCESSING  || $order->status == \App\Enums\OrderStatus::WAIT_PAYMENT)
                                                                    <button type="submit"
                                                                            class="btn w-25 btn-danger btn-cancel m-2">
                                                                        Cancel order
                                                                    </button>
                                                                @else
                                                                    <button class="btn w-25 btn-danger btn-cancel m-2"
                                                                            disabled>
                                                                        Cancel order
                                                                    </button>
                                                                @endif
                                                                <button type="button"
                                                                        class="btn w-25 btn-secondary-back m-2"
                                                                        data-dismiss="modal">Back
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ($order->orders_method) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->shipping_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->discount_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    <td>
                                        @php
                                            $quantity = DB::table('order_items')->where('order_id', $order->id)->get();
                                        @endphp
                                        {{count($quantity)}}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->total);
                                    @endphp
                                    <td>
                                        {{$currencyValue}}
                                    </td>
                                    <td>
                                        {{ ($order->status) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="tab-pane fade text-center" id="nav-6" role="tabpanel"
                     aria-labelledby="nav-about-tab">
                    @if ($orderCancel->isEmpty())
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no order') }}</p>
                    @else
                        <div class="d-flex justify-content-between">
                            <div class="">Total:{{count($orderCancel)}}</div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('OrderID') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Shipping Price') }}</th>
                                <th>{{ __('Discount Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orderCancel as $order)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none" data-toggle="modal"
                                           data-target="#updateOrder5{{$order->id}}"
                                           style="cursor: pointer;color: red;">#{{ $loop->index+1 }}</a>
                                        <div class="modal fade" id="updateOrder5{{$order->id}}" tabIndex="-1"
                                             role="dialog"
                                             aria-labelledby="editModalLabel">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content border-content">
                                                    <div class="modal-header" style="border-bottom: 0;">
                                                        <h5 class="modal-title title-modal" id="exampleModalLabel">Detail
                                                            Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="delete-account-form"
                                                              action="{{route('order.cancel', $order->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>{{ __('Name') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @php
                                                                        $orderItem4s = \App\Models\OrderItem::where('order_id', $order->id)->get();
                                                                    @endphp
                                                                    @foreach ($orderItem4s as $order_item5)
                                                                        @php
                                                                            $product5 = \App\Models\Product::find($order_item5->product_id);
                                                                        @endphp
                                                                        <tr>
                                                                            <td>

                                                                                @if ($product5)
                                                                                    {{ ($product5->name) }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ ($order_item5->quantity) }}
                                                                            </td>
                                                                            @php
                                                                                $currencyValue = $currencyController->getCurrency(request(), $order_item5->price);
                                                                            @endphp
                                                                            <td>
                                                                                {{ ($currencyValue) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="d-flex justify-content-around">
                                                                @if($order->status == \App\Enums\OrderStatus::PROCESSING  || $order->status == \App\Enums\OrderStatus::WAIT_PAYMENT)
                                                                    <button type="submit"
                                                                            class="btn w-25 btn-danger btn-cancel m-2">
                                                                        Cancel order
                                                                    </button>
                                                                @else
                                                                    <button class="btn w-25 btn-danger btn-cancel m-2"
                                                                            disabled>
                                                                        Cancel order
                                                                    </button>
                                                                @endif
                                                                <button type="button"
                                                                        class="btn w-25 btn-secondary-back m-2"
                                                                        data-dismiss="modal">Back
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ($order->orders_method) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->shipping_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->discount_price);
                                    @endphp
                                    <td>
                                        {{ ($currencyValue) }}
                                    </td>
                                    <td>
                                        @php
                                            $quantity = DB::table('order_items')->where('order_id', $order->id)->get();
                                        @endphp
                                        {{count($quantity)}}
                                    </td>
                                    @php
                                        $currencyValue = $currencyController->getCurrency(request(), $order->total);
                                    @endphp
                                    <td>
                                        {{$currencyValue}}
                                    </td>
                                    <td>
                                        {{$order->status}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
