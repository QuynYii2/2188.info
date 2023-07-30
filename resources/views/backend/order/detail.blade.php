@extends('backend.layouts.master')
@section('title', 'Detail Order')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Detail Đơn hàng</h5>
            <a class="btn btn-warning" href="{{route('seller.order.list')}}">Back to list</a>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="fullName">Full Name11</label>
                    <input type="text" class="form-control" disabled id="fullName" value="{{$order->fullname}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" disabled id="phone" value="{{$order->phone}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" disabled id="email" value="{{$order->email}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="total">Total</label>
                    <input type="text" class="form-control" disabled id="total" value="{{$order->total}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="total_price">Total Product</label>
                    <input type="text" class="form-control" disabled id="total_price" value="{{$order->total_price}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="shipping_price">Shipping Price</label>
                    <input type="text" class="form-control" disabled id="shipping_price"
                           value="{{$order->shipping_price}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="discount_price">Discount Price</label>
                    <input type="text" class="form-control" disabled id="discount_price"
                           value="{{$order->discount_price}}">
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" disabled placeholder="1234 Main St"
                       value="{{$order->address}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="orders_method">Order Method</label>
                    <input type="text" class="form-control" disabled id="orders_method"
                           value="{{$order->orders_method}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" disabled id="status" value="{{$order->status}}">
                </div>
            </div>
        </div>
        <h3 class="text-center">Order Items</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Products Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItem)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>
                        @php
                            $product = \App\Models\Product::find($orderItem->product_id);
                        @endphp
                        @if($product)
                            {{$product->name}}
                        @endif
                    </td>
                    <td>{{$orderItem->quantity}}</td>
                    <td>{{$orderItem->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>

    </script>
@endsection
