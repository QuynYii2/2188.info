@extends('backend.layouts.master')
@section('title')
    {{ __('home.quản lý kho hàng') }}
@endsection
@section('content')
    <div class="container-fluid warehouse-page p-3">
        <h3 class="s24w6">{{ __('home.quản lý kho hàng') }}</h3>

        <form action="{{ route('storage.manage.search') }}"
              class="form-search d-flex align-items-center justify-content-between bg-white my-2 ">
            @csrf
            <div class="input-item">
                <input placeholder={{ __('home.Tên sản phẩm') }} type="text" class="form-control input-custom"
                       id="name-search" name="name-search"
                       data-date-split-input="true">
            </div>
            <div class="input-item">
                <input placeholder={{ __('home.Giá bán') }} type="number" class="form-control input-custom"
                       id="price-search" name="price-search"
                       data-date-split-input="true">
            </div>
            <div class="input-item">
                <input placeholder={{ __('home.Xuất xứ') }} type="text" class="form-control input-custom"
                       id="origin-search" name="origin-search"
                       data-date-split-input="true">
            </div>
            <div class="input-item">
                <input placeholder={{ __('home.từ ngày') }} type="date" class="form-control input-custom" id="from-date"
                       name="from-date"
                       data-date-split-input="true">
            </div>
            <div class="input-item">
                <input placeholder={{ __('home.đến ngày') }} type="date" class="form-control input-custom" id="to-date"
                       name="to-date"
                       data-date-split-input="true">
            </div>
            <div class="list-button d-flex align-items-center">
                <button type="submit" class="btn btnSearchProduct cFFFs16w6">
                    Search
                </button>
                <a href="{{route('storage.manage.show.all')}}" class="btn brnClear cF00s14w6">Clear All</a>
            </div>
        </form>
        <div class="bg-white warehouse-table">
            <form action="{{ route('storage.manage.export.excel') }}" method="post">
                @csrf
                <input type="text" name="excel-value" value="{{ $storages }}" hidden>
                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btnCreateDefault">Export Excel</button>
                    <a class="btn btnCreateDefault" href="{{ route('storage.manage.create') }}">
                        <i class="fa-solid fa-plus"></i>
                        Add new warehouse</a>
                </div>
            </form>
            <table class="bg-white table p-3">
                <thead>
                <tr class="c929292s12w5">
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
                    <tr class="s12w5">
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
    </div>
@endsection
