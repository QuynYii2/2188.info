@extends('backend.layouts.master')
@section('title', 'List Order')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Đơn hàng') }}</h5>
        </div>
        <form action="{{ route('seller.search.order.list') }}" id="searchInput" class="row my-2 pl-3">
            @csrf
            <div class="col-sm-2">
                <input placeholder={{ __('home.full name') }} type="text" class="form-control" id="fullName" name="fullName" value="{{ isset($phoneNumber) ? $phoneNumber : '' }}"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder="Phone Number" type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ isset($phoneNumber) ? $phoneNumber : '' }}"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder="Email" type="text" class="form-control" id="email" name="email" value="{{ isset($email) ? $email : '' }}"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder={{ __('home.từ ngày') }}"" type="date" class="form-control" id="from_date" name="from_date" value="{{ isset($from_date) ? $from_date : '' }}"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder={{ __('home.đến ngày') }} type="date" class="form-control" id="to_date" name="to_date" value="{{ isset($to_date) ? $to_date : '' }}"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-success position-absolute" style="bottom: 0">{{ __('home.search') }}</button>
            </div>
        </form>
        <form action="{{ route('order.manage.export.excel') }}" class="pl-3" method="post" id="formExportAll">
            @csrf
            <input type="text" id="excel-value" name="excel-value" value="{{ $orders }}" hidden>
            <button type="submit" class="btn btn-success">Export Excel</button>
        </form>

        <form action="{{ route('order.manage.export.excel.detail') }}" method="post" id="formExportDetail"
              class="d-none">
            @csrf
            <input type="text" id="excel-id" name="excel-id" value="0" hidden>
            <button type="submit" class="btn btn-success">Export Excel</button>
        </form>
        <div class="card-body">
            <table class="table table-bordered sortable" id="tableOrders">
                <thead>
                <tr>
                    <th scope="col">
                        <input type="checkbox" id="order-all" name="order-all" onclick="checkBox()">
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Create At</th>
                    <th scope="col">Method Payments</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @if($orders)
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row">
                                <input class="checkbox-items" type="checkbox" id="order-{{$order->id}}"
                                       name="order-{{$order->id}}" value="{{$order->id}}">
                            </th>
                            <th scope="row">
                                {{$loop->index+1}}
                            </th>
                            <td>
                                @php
                                    $ld = new \App\Http\Controllers\TranslateController();
                                @endphp
                                {{ $ld->translateText($order->fullname, locationPermissionHelper()) }}
                            </td>
                            <td>
                                {{$order->phone}}
                            </td>
                            <td>
                                {{$order->email}}
                            </td>
                            <td>
                                {{$order->created_at}}
                            </td>
                            <td>
                                @php
                                    $ld = new \App\Http\Controllers\TranslateController();
                                @endphp
                                {{ $ld->translateText($order->orders_method, locationPermissionHelper()) }}

                            </td>
                            <td>
                                {{$order->total}}
                            </td>
                            <td>
                                @php
                                    $ld = new \App\Http\Controllers\TranslateController();
                                @endphp
                                {{ $ld->translateText($order->status, locationPermissionHelper()) }}
                            </td>
                            <td>
                                <a href="{{route('seller.order.detail', $order->id)}}"
                                   class="btn btn-warning">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <script>
        localStorage.setItem('searchInput', document.getElementById('fullName').value);
        document.getElementById('fullName').value = localStorage.getItem('searchInput');
    </script>
    <script src="{{ asset('js/backend/list.js') }}"></script>
@endsection
