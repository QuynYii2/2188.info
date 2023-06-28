@extends('frontend.layouts.profile')

@section('title', 'Order Management')

<style>
    .link-tabs {
        background-color: #f7f7f7 !important;
    }

    .link-tabs:hover {
        color: #c69500;
    !important;
    }
</style>

@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use App\Enums\PermissionUserStatus;

    if (auth()->check() != null){
        $permissionUsers = DB::table('permissions')
        ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
        ->where([['permission_user.user_id', Auth::user()->id], ['permission_user.status', PermissionUserStatus::ACTIVE]])
        ->select('permissions.*')
        ->get();
    } else {
        $permissionUsers[]= null;
    }

@endphp

@section('sub-content')

    @for($i = 0; $i< count($permissionUsers); $i++)
        @if($permissionUsers[$i]->name == 'manage_orders')
            <div class="row mt-2 bg-white rounded">
                <div class="row rounded pt-1 ml-5">
                    <h5>{{ __('home.order management') }}</h5>
                </div>
                <div class="border-bottom"></div>
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill d-flex justify-content-between align-items-center"
                             id="nav-tab" role="tablist">
                            <a class="nav-item link-tabs nav-link active" data-toggle="tab" data-target="#nav-1"
                               role="tab" aria-controls="nav-1" aria-selected="true">
                                {{ __('home.all orders') }}
                            </a>
                            <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-2" role="tab"
                               aria-controls="nav-2" aria-selected="false">
                                {{ __('home.waiting for payment') }}
                            </a>
                            <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-3"
                               role="tab" aria-controls="nav-3" aria-selected="false">
                                {{ __('home.processing') }}
                            </a>
                            <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-4" role="tab"
                               aria-controls="nav-4" aria-selected="false">
                                {{ __('home.shipping') }}
                            </a>
                            <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-5" role="tab"
                               aria-controls="nav-4" aria-selected="false">
                                {{ __('home.delivered') }}
                            </a>
                            <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-6" role="tab"
                               aria-controls="nav-4" aria-selected="false">
                                {{ __('home.canceled') }}
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade text-center active show" id="nav-1" role="tabpanel"
                             aria-labelledby="nav-contact-tab">
                            @if ($orderAll->isEmpty())
                                <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                                <p>{{ __('home.you have no order') }}</p>
                            @else
                                <div class="d-flex justify-content-between">
                                    <div class="">Total:{{count($orderAll)}}</div>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="float-left">OrderID</th>
                                        <th class="float-right">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderAll as $order)
                                        <tr>
                                            <td class="float-left">
                                                <button class="text-decoration-none" data-toggle="modal"
                                                        data-target="#updateOrder{{$order->id}}"
                                                        style="cursor: pointer">{{ $loop->index+1 }}</button>
                                                <div class="modal fade" id="updateOrder{{$order->id}}" tabIndex="-1"
                                                     role="dialog"
                                                     aria-labelledby="editModalLabel">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
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
                                                                    <div class="row mb-5">
                                                                        <div class="col">
                                                                            <label for="fname">Full name:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->fullname}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Email:</label>
                                                                            <input type="text" value="{{$order->email}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Phone:</label>
                                                                            <input type="text" value="{{$order->phone}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Address:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->address}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col mt-3">
                                                                            <label for="fname">Total Price:</label>
                                                                            <input type="text"
                                                                                   value="${{$order->total}}"
                                                                                   disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around">
                                                                        @if($order->status == \App\Enums\OrderStatus::PROCESSING  || $order->status == \App\Enums\OrderStatus::WAIT_PAYMENT)
                                                                            <button type="submit"
                                                                                    class="btn w-25 btn-danger">
                                                                                Cancel
                                                                            </button>
                                                                        @else
                                                                            <button class="btn w-25 btn-danger"
                                                                                    disabled>
                                                                                Cancel
                                                                            </button>
                                                                        @endif
                                                                        <button type="button"
                                                                                class="btn w-25 btn-secondary"
                                                                                data-dismiss="modal">Back
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="float-right">
                                                {{$order->total}}
                                                <div class="small">{{$order->status}}</div>
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
                                        <th class="float-left">OrderID</th>
                                        <th class="float-right">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderWaitPay as $order)
                                        <tr>
                                            <td class="float-left">
                                                <button class="text-decoration-none" data-toggle="modal"
                                                        data-target="#updateOrderWait{{$order->id}}"
                                                        style="cursor: pointer">{{ $loop->index+1 }}</button>
                                                <div class="modal fade" id="updateOrderWait{{$order->id}}" tabIndex="-1"
                                                     role="dialog"
                                                     aria-labelledby="editModalLabel">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                    Order</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('order.cancel', $order->id)}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="row mb-5">
                                                                        <div class="col">
                                                                            <label for="fname">Full name:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->fullname}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Email:</label>
                                                                            <input type="text" value="{{$order->email}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Phone:</label>
                                                                            <input type="text" value="{{$order->phone}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Address:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->address}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col mt-3">
                                                                            <label for="fname">Total Price:</label>
                                                                            <input type="text"
                                                                                   value="${{$order->total}}"
                                                                                   disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around">
                                                                        <button type="submit"
                                                                                class="btn w-25 btn-danger">
                                                                            Cancel
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn w-25 btn-secondary"
                                                                                data-dismiss="modal">Back
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="float-right">
                                                {{$order->total}}
                                                <div class="small">{{$order->status}}</div>
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
                                        <th class="float-left">OrderID</th>
                                        <th class="float-right">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderProcessing as $order)
                                        <tr>
                                            <td class="float-left">
                                                <button class="text-decoration-none" data-toggle="modal"
                                                        data-target="#updateOrderProcess{{$order->id}}"
                                                        style="cursor: pointer">{{ $loop->index+1 }}</button>
                                                <div class="modal fade" id="updateOrderProcess{{$order->id}}" tabIndex="-1" role="dialog"
                                                     aria-labelledby="editModalLabel">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
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
                                                                    <div class="row mb-5">
                                                                        <div class="col">
                                                                            <label for="fname">Full name:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->fullname}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Email:</label>
                                                                            <input type="text" value="{{$order->email}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Phone:</label>
                                                                            <input type="text" value="{{$order->phone}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Address:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->address}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col mt-3">
                                                                            <label for="fname">Total Price:</label>
                                                                            <input type="text"
                                                                                   value="${{$order->total}}"
                                                                                   disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around">
                                                                        @if($order->status == \App\Enums\OrderStatus::PROCESSING)
                                                                            <button type="submit"
                                                                                    class="btn w-25 btn-danger">
                                                                                Cancel
                                                                            </button>
                                                                        @else
                                                                            <button type="" class="btn w-25 btn-danger"
                                                                                    disabled>
                                                                                Cancel
                                                                            </button>
                                                                        @endif

                                                                        <button type="button"
                                                                                class="btn w-25 btn-secondary"
                                                                                data-dismiss="modal">Back
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="float-right">
                                                {{$order->total}}
                                                <div class="small">{{$order->status}}</div>
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
                                        <th class="float-left">OrderID</th>
                                        <th class="float-right">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderShipping as $order)
                                        <tr>
                                            <td class="float-left">
                                                <button class="text-decoration-none" data-toggle="modal"
                                                        data-target="#updateOrderShip{{$order->id}}"
                                                        style="cursor: pointer">{{ $loop->index+1 }}</button>
                                                <div class="modal fade" id="updateOrderShip{{$order->id}}" tabIndex="-1" role="dialog"
                                                     aria-labelledby="editModalLabel">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                    Order</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="delete-account-form">
                                                                    <div class="row mb-5">
                                                                        <div class="col">
                                                                            <label for="fname">Full name:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->fullname}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Email:</label>
                                                                            <input type="text" value="{{$order->email}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Phone:</label>
                                                                            <input type="text" value="{{$order->phone}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Address:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->address}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col mt-3">
                                                                            <label for="fname">Total Price:</label>
                                                                            <input type="text"
                                                                                   value="${{$order->total}}"
                                                                                   disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around">
                                                                        <button type="submit"
                                                                                class="btn w-25 btn-danger"
                                                                                disabled>
                                                                            Cancel
                                                                        </button>

                                                                        <button type="button"
                                                                                class="btn w-25 btn-secondary"
                                                                                data-dismiss="modal">Back
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="float-right">
                                                {{$order->total}}
                                                <div class="small">{{$order->status}}</div>
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
                                        <th class="float-left">OrderID</th>
                                        <th class="float-right">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderDelivered as $order)
                                        <tr>
                                            <td class="float-left">
                                                <button class="text-decoration-none" data-toggle="modal"
                                                        data-target="#updateOrderDelivery{{$order->id}}"
                                                        style="cursor: pointer">{{ $loop->index+1 }}</button>
                                                <div class="modal fade" id="updateOrderDelivery{{$order->id}}" tabIndex="-1" role="dialog"
                                                     aria-labelledby="editModalLabel">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                    Order</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="delete-account-form">
                                                                    <div class="row mb-5">
                                                                        <div class="col">
                                                                            <label for="fname">Full name:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->fullname}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Email:</label>
                                                                            <input type="text" value="{{$order->email}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Phone:</label>
                                                                            <input type="text" value="{{$order->phone}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Address:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->address}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col mt-3">
                                                                            <label for="fname">Total Price:</label>
                                                                            <input type="text"
                                                                                   value="${{$order->total}}"
                                                                                   disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around">
                                                                        <button type="submit"
                                                                                class="btn w-25 btn-danger"
                                                                                disabled>
                                                                            Cancel
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn w-25 btn-secondary"
                                                                                data-dismiss="modal">Back
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="float-right">
                                                {{$order->total}}
                                                <div class="small">{{$order->status}}</div>
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
                                        <th class="float-left">OrderID</th>
                                        <th class="float-right">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderCancel as $order)
                                        <tr>
                                            <td class="float-left">
                                                <button class="text-decoration-none" data-toggle="modal"
                                                        data-target="#updateOrderCancel{{$order->id}}"
                                                        style="cursor: pointer">{{ $loop->index+1 }}</button>
                                                <div class="modal fade" id="updateOrderCancel{{$order->id}}" tabIndex="-1" role="dialog"
                                                     aria-labelledby="editModalLabel">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                    Order</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="delete-account-form">
                                                                    <div class="row mb-5">
                                                                        <div class="col">
                                                                            <label for="fname">Full name:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->fullname}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Email:</label>
                                                                            <input type="text" value="{{$order->email}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Phone:</label>
                                                                            <input type="text" value="{{$order->phone}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="fname">Address:</label>
                                                                            <input type="text"
                                                                                   value="{{$order->address}}"
                                                                                   disabled>
                                                                        </div>
                                                                        <div class="col mt-3">
                                                                            <label for="fname">Total Price:</label>
                                                                            <input type="text"
                                                                                   value="${{$order->total}}"
                                                                                   disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around">
                                                                        <button type="submit"
                                                                                class="btn w-25 btn-danger"
                                                                                disabled>
                                                                            Cancel
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn w-25 btn-secondary"
                                                                                data-dismiss="modal">Back
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="float-right">
                                                {{$order->total}}
                                                <div class="small">{{$order->status}}</div>
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
            @break
        @endif
    @endfor
@endsection
