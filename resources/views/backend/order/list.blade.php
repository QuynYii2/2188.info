@extends('backend.layouts.master')
@section('title', 'List Order')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Đơn hàng</h5>
        </div>
        <form action="{{ route('seller.search.order.list') }}" class="row my-2">
            @csrf
            <div class="col-sm-2">
                <h5>Full Name</h5>
                <input type="text" class="form-control" id="fullName" name="fullName"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <h5>Phone Number</h5>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <h5>Email</h5>
                <input type="text" class="form-control" id="email" name="email"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <h5>Từ ngày</h5>
                <input type="date" class="form-control" id="from-date" name="from-date"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <h5>Đến ngày</h5>
                <input type="date" class="form-control" id="to-date" name="to-date"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary position-absolute" style="bottom: 0">Search</button>
            </div>
        </form>
        <form action="{{ route('order.manage.export.excel') }}" method="post" id="formExportAll">
            @csrf
            <input type="text" id="excel-value" name="excel-value" value="{{ $orders }}" hidden>
            <button type="submit" class="btn btn-primary">Export Excel</button>
        </form>

        <form action="{{ route('order.manage.export.excel.detail') }}" method="post" id="formExportDetail"
              class="d-none">
            @csrf
            <input type="text" id="excel-id" name="excel-id" value="0" hidden>
            <button type="submit" class="btn btn-primary">Export Excel</button>
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
                                {{$order->fullname}}
                            </td>
                            <td>
                                {{$order->phone}}
                            </td>
                            <td>
                                {{$order->email}}
                            </td>
                            <td>
                                {{$order->total}}
                            </td>
                            <td>
                                {{$order->status}}
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        function checkBox() {
            var inputAll = document.getElementById('order-all');
            var items = document.getElementsByClassName("checkbox-items");
            if (inputAll.checked) {
                for (let i = 0; i < items.length; i++) {
                    items[i].checked = true
                }
            } else {
                for (let i = 0; i < items.length; i++) {
                    items[i].checked = false
                }
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            localStorage.removeItem('listArray');
        });
        $('.checkbox-items').on('click', function () {
            var items = document.getElementsByClassName("checkbox-items");
            let array = [];
            for (let i = 0; i < items.length; i++) {
                if (items[i].checked) {
                    array.push(items[i].value);
                }
            }
            localStorage.setItem('listArray', array);
            let listIDs = document.getElementById('excel-id');
            listIDs.value = localStorage.getItem('listArray');

            if (localStorage.getItem('listArray') != null && localStorage.getItem('listArray') != 0) {
                $('#formExportDetail').removeClass("d-none");
                $('#formExportAll').addClass("d-none");
            } else {
                $('#formExportDetail').addClass("d-none");
                $('#formExportAll').removeClass("d-none");
            }
        })

        $('#order-all').on('click', function () {
            var inputAll = document.getElementById('order-all');
            let array = [];
            if (inputAll.checked) {
                var items = document.getElementsByClassName("checkbox-items");
                for (let i = 0; i < items.length; i++) {
                    array.push(items[i].value)
                }
            }
            localStorage.setItem('listArray', array);
            let listIDs = document.getElementById('excel-id');
            listIDs.value = localStorage.getItem('listArray');

            if (localStorage.getItem('listArray') != null && localStorage.getItem('listArray') != 0) {
                $('#formExportDetail').removeClass("d-none");
                $('#formExportAll').addClass("d-none");
            } else {
                $('#formExportDetail').addClass("d-none");
                $('#formExportAll').removeClass("d-none");
            }
        })
    </script>
@endsection
