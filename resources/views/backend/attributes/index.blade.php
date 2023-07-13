@php use App\Enums\AttributeStatus;use App\Models\Properties; @endphp
@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách thuộc tính</h5>
            <a href="{{ route('attributes.create') }}" class="btn btn-success">Thêm mới</a>
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
                        <td class="text-center" id="status{{$attribute->id}}">
                            {{ $attribute->status }}
                        </td>
                        <td class="text-center">
                            @if($attribute->status == AttributeStatus::ACTIVE)
                                <label class="switch">
                                    <input value="{{$attribute->id}}" class="inputCheckbox"
                                           name="inputCheckbox-{{$attribute->id}}" id="input-check-{{$attribute->id}}"
                                           type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            @else
                                <label class="switch">
                                    <input value="{{$attribute->id}}" class="inputCheckbox"
                                           name="inputCheckbox-{{$attribute->id}}" id="input-check-{{$attribute->id}}"
                                           type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            @endif
                        </td>
                        <input id="attributeID-{{$attribute->id}}" type="text" hidden value="{{$attribute->id}}">
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".inputCheckbox").click(function () {
                var attributeID = jQuery(this).val();
                function toggleAttribute(attributeID) {
                    $.ajax({
                        url: '/toggle-attributes/' + attributeID,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            let status = document.getElementById('status' + attributeID)
                            status.innerText = response['status'];
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                }

                toggleAttribute(attributeID);
            });
        });
    </script>
@endsection
