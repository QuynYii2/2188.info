@extends('backend.layouts.master')

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
