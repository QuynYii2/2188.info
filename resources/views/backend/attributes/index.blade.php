@php use App\Enums\AttributeStatus;use App\Models\Properties; @endphp
@extends('backend.layouts.master')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách thuộc tính</h5>
            <a href="{{ route('attributes.create') }}" class="btn btn-primary">Thêm mới</a>
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('success_update_product') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th>Tên thuộc tính</th>
                    <th>Số lượng thuộc tính con</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                    <th>Thêm</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attributes as $attribute)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $attribute->name }}</td>
                        @php
                            $properties = Properties::where('attribute_id', $attribute->id)->get();
                        @endphp
                        <td class="text-center">{{ count($properties) }}</td>
                        <td class="text-center">
                            {{ $attribute->status }}
                        </td>
                        <td class="text-center">
                            @if($attribute->status == AttributeStatus::ACTIVE)
                                <label class="switch">
                                    <input id="input-check" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            @else
                                <label class="switch">
                                    <input id="input-check" type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="">
                                <a href="{{route('attributes.detail', $attribute->id)}}" class="btn btn-success">Chi
                                    tiết</a>
                                <form action="{{route('attributes.delete', $attribute->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Xoá</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <script>

    </script>
@endsection
