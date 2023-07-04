@extends('backend.layouts.master')

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    #table-account-manage .table-responsive {
        margin: 30px 0;
    }

    #table-account-manage .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    #table-account-manage table.table tr th, #table-account-manage table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    #table-account-manage table.table tr th:first-child {
        width: 60px;
    }

    #table-account-manage table.table tr th:last-child {
        width: 100px;
    }

    #table-account-manage table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    #table-account-manage table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    #table-account-manage table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    #table-account-manage table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    #table-account-manage table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    #table-account-manage table.table td a:hover {
        color: #2196F3;
    }

    #table-account-manage table.table td a.settings {
        color: #2196F3;
    }

    #table-account-manage table.table td a.delete {
        color: #F44336;
    }

    #table-account-manage table.table td i {
        font-size: 19px;
    }

    #table-account-manage table.table .avatar-a {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
        width: 30px !important;
        height: 30px !important;
    }

    #table-account-manage .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }

    #table-account-manage .text-success {
        color: #10c469;
    }

    #table-account-manage .text-info {
        color: #62c9e8;
    }

    #table-account-manage .text-warning {
        color: #FFC107;
    }

    #table-account-manage .text-danger {
        color: #ff5b5b;
    }

    #table-account-manage .pagination {
        float: right;
        margin: 0 0 5px;
    }

    #table-account-manage .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    #table-account-manage .pagination li a:hover {
        color: #666;
    }

    #table-account-manage .pagination li.active a, #table-account-manage .pagination li.active a.page-link {
        background: #03A9F4;
    }

    #table-account-manage .pagination li.active a:hover {
        background: #0397d6;
    }

    #table-account-manage .pagination li.disabled i {
        color: #ccc;
    }

    #table-account-manage .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    #table-account-manage .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
</style>

@section('content')
    <section class="container-fluid">

        <h2>Light Javascript Table Filter</h2>

        <input type="search" class="light-table-filter form-control" data-table="order-table" placeholder="Filter"/>

        <table class="order-table table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Mã sản phẩm</th>
                <th>Giá nhập</th>
                <th>Giá bán</th>
                <th>Số lượng</th>
                <th>Xuất xứ</th>
                <th>Danh mục sản phẩm</th>
                <th>Người nhập kho</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $index => $product)
                @php
                    $username = Illuminate\Support\Facades\DB::table('users')->where('id', $product->importer)->first('name');
                    $category_name = Illuminate\Support\Facades\DB::table('categories')->where('id', $product->category_id)->first('name');
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->import_price }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->origin }}</td>
                    <td>{{ $category_name->name }}</td>
                    <td>{{ $username === null ? "" : $product->importer. ' - ' . $username->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>

    <script>
        (function (document) {
            'use strict';

            var LightTableFilter = (function (Arr) {

                var _input;

                function _onInputEvent(e) {
                    _input = e.target;
                    var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                    Arr.forEach.call(tables, function (table) {
                        Arr.forEach.call(table.tBodies, function (tbody) {
                            Arr.forEach.call(tbody.rows, _filter);
                        });
                    });
                }

                function _filter(row) {
                    var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                    row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
                }

                return {
                    init: function () {
                        var inputs = document.getElementsByClassName('light-table-filter');
                        Arr.forEach.call(inputs, function (input) {
                            input.oninput = _onInputEvent;
                        });
                    }
                };
            })(Array.prototype);

            document.addEventListener('readystatechange', function () {
                if (document.readyState === 'complete') {
                    LightTableFilter.init();
                }
            });

        })(document);
    </script>
@endsection
