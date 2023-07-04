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
        <div class="pt-4 d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách thuộc tính con</h5>
            <a href="{{ route('properties.create') }}" class="btn btn-success">Thêm mới</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th>Tên thuộc tính</th>
                    <th>Tên thuộc tính cha</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                    <th>Thêm</th>
                </tr>
                </thead>
                <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $property->name }}</td>
                        @php
                            $attribute = \App\Models\Attribute::find($property->attribute_id);
                        @endphp
                        <td class="text-center">{{ $attribute->name }}</td>
                        <td class="text-center" id="status{{$property->id}}">
                            {{ $property->status }}
                        </td>
                        <td class="text-center">
                            @if($property->status == \App\Enums\PropertiStatus::ACTIVE)
                                <label class="switch">
                                    <input value="{{$property->id}}" class="inputCheckbox"
                                           name="inputCheckbox-{{$property->id}}" id="input-check-{{$property->id}}"
                                           type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            @else
                                <label class="switch">
                                    <input value="{{$property->id}}" class="inputCheckbox"
                                           name="inputCheckbox-{{$property->id}}" id="input-check-{{$property->id}}"
                                           type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{route('properties.detail', $property->id)}}" class="btn btn-success">Chi tiết</a>
{{--                            <form action="{{ route('properties.delete', $property->id) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                <button id="deleteButton"--}}
{{--                                        class="btn btn-danger" type="submit">Xoá--}}
{{--                                </button>--}}
{{--                            </form>--}}
                            <form action="{{route('properties.delete', $property->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Xoá</button>
                            </form>

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
                        url: '/toggle-properties/' + attributeID,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            console.log(response)
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

        function deleteProperty(id) {
            if (confirm('Bạn có chắc chắn muốn xoá?')) {
                fetch('/delete-properties/' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Đảm bảo gửi CSRF token
                    },
                })
            }
        }
    </script>
@endsection
