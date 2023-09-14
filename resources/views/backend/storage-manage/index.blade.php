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
    <div class="container-fluid">

        {{--        <a href="{{ route('storage.manage.export.pdf') }}"><button>Pdf</button></a>--}}
        <h2>{{ __('home.quản lý kho hàng') }}</h2>

        <form action="{{ route('storage.manage.search') }}" class="row my-2 ">
            @csrf
            <div class="col-sm-2">
                <input placeholder={{ __('home.Tên sản phẩm') }} type="text" class="form-control" id="name-search" name="name-search"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder={{ __('home.Giá bán') }} type="number" class="form-control" id="price-search" name="price-search"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder={{ __('home.Xuất xứ') }} type="text" class="form-control" id="origin-search" name="origin-search"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder={{ __('home.từ ngày') }} type="date" class="form-control" id="from-date" name="from-date"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <input placeholder={{ __('home.đến ngày') }} type="date" class="form-control" id="to-date" name="to-date"
                       data-date-split-input="true">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-success position-absolute" style="bottom: 0">{{ __('home.search') }}</button>
            </div>
        </form>
        <form action="{{ route('storage.manage.export.excel') }}" method="post">
            @csrf
            <input type="text" name="excel-value" value="{{ $storages }}" hidden>
            <button type="submit" class="btn btn-primary">Export Excel</button>
        </form>
        <table class="order-table table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ __('home.Tên sản phẩm') }}</th>
                <th>{{ __('home.Giá bán') }}</th>
                <th>{{ __('home.Số lượng') }}</th>
                <th>{{ __('home.Xuất xứ') }}</th>
                <th>{{ __('home.người nhập kho') }}</th>
                <th>{{ __('home.ngày nhập kho') }}</th>
                <th>{{ __('home.hành động') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($storages as $index => $storage)
                @php
                    $username = Illuminate\Support\Facades\DB::table('users')->where('id', $storage->create_by)->first('name');
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @php
                            $ld = new \App\Http\Controllers\TranslateController();
                        @endphp
                        {{ $ld->translateText($storage->name, locationPermissionHelper()) }}
                    </td>
                    <td>{{ $storage->price }}</td>
                    <td>{{ $storage->quantity }}</td>
                    <td>
                        @php
                        @endphp
                        {{ $ld->translateText($storage->origin, locationPermissionHelper()) }}
                       </td>
                    <td>{{ $username === null ? "" : $storage->create_by. ' - ' . $username->name }}</td>
                    <td>{{ $storage->created_at }}</td>
                    <td class="">
                        <a href="{{ route('storage.manage.edit', $storage->id) }}"><i
                                    style="color: black; margin-right: 15px" class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
