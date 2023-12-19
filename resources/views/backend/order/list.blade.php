@extends('backend.layouts.master')
@section('title', 'List Order')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="d-flex justify-content-between align-items-center">
        <div class="card-title order-managers">{{ __('home.Đơn hàng') }}</div>
    </div>
    <div class="search-order" >
        <form action="{{ route('seller.search.order.list') }}" id="searchInput" class="d-flex my-2 w-100">
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
            <div class="col-sm-2 d-flex">
                <button type="submit" class="btn btn-success" style="bottom: 0">{{ __('home.search') }}</button>
                <div class="btn-clear"><a href="#" class="">Clear all</a></div>

            </div>

        </form>
    </div>
    <div class="mt-4 card border-0">
        <div class="card-body">
            <form action="{{ route('order.manage.export.excel') }}" class="export-excel" method="post" id="formExportAll">
                @csrf
                <input type="text" id="excel-value" name="excel-value" value="{{ $orders }}" hidden>
                <button type="submit" class="btn btn-success">Export Excel</button>
            </form>
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
                                <a class="btn btn-warning btn-order"
                                   data-toggle="modal" data-target="#modal-detail-order" data-order-id="{{ $order->id }}">Detail</a>

                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-detail-order" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered cus-mr-modal" style="max-width: 970px;">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="border-0">&times;</span>
                    </button>
                </div>
                    <div  class="modal-body" id="modal-body-content">
                    </div>
            </div>
        </div>
    </div>
    <script>
        localStorage.setItem('searchInput', document.getElementById('fullName').value);
        document.getElementById('fullName').value = localStorage.getItem('searchInput');
    </script>
    <script src="{{ asset('js/backend/list.js') }}"></script>
    <script>
        $('#modal-detail-order').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút đã kích hoạt modal
            var orderId = button.data('order-id'); // Lấy giá trị từ data-order-id
            var url = '{{ route('seller.order.detail', ':id') }}';
            url = url.replace(':id', orderId);
            // Gửi AJAX request để lấy thông tin chi tiết về đơn hàng dựa trên orderId
            $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('.modal-title').text('Order Details');
                    $('#modal-body-content').html(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>

@endsection
