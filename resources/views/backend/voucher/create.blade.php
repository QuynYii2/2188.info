@php @endphp
@extends('backend.layouts.master')

@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Thêm mới mã giảm giá</h5>
        </div>
        <div class="container">
            <form action="{{route('seller.vouchers.create')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nameVoucher">Tên mã giảm giá</label>
                        <input type="text" class="form-control" required name="nameVoucher" id="nameVoucher" placeholder="Nhập tên ãm giảm giá">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="quantity">Số lượng</label>
                        <input type="number" min="1" class="form-control" required name="quantity" id="quantity" placeholder="123">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="percent">Phần trăm giảm giá</label>
                        <input type="number" min="1" max="100" class="form-control" required name="percent" id="percent" placeholder="60">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="status">Apply</label>
                        <div class="multiselect">
                            <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                <select>
                                    <option>Chọn sản phẩm áp dụng</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div id="checkboxes" class="mt-1">
                                @foreach($products as $ID)
                                    @php
                                        $product = \App\Models\Product::find($ID);
                                    @endphp
                                    <label class="ml-2" for="category-{{$product->id}}">
                                        <input type="checkbox" id="category-{{$product->id}}"
                                               name="category-{{$product->id}}"
                                               value="{{$product->id}}"
                                               class="mr-2 p-3"/>
                                        {{$product->name}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="assign_to">Assign To</label>
                        <select id="assign_to" name="assign_to" class="form-control">
                            <option value="0">No Assgin</option>
                            @foreach($levels as $level)
                                <option value="{{$level}}">{{$level}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="{{\App\Enums\VoucherStatus::ACTIVE}}">{{\App\Enums\VoucherStatus::ACTIVE}}</option>
                            <option value="{{\App\Enums\VoucherStatus::INACTIVE}}">{{\App\Enums\VoucherStatus::INACTIVE}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="startDate">Ngày bắt đầu</label>
                        <input type="datetime-local" required class="form-control" name="startDate" id="startDate">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="endDate">Ngày kết thúc </label>
                        <input type="datetime-local" required class="form-control" name="endDate" id="endDate">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    var checkboxes = document.getElementById("checkboxes");
                    var div = document.getElementById('div-click');
                    if (checkboxes.contains(e.target) || div.contains(e.target)) {
                        div.on('click', function () {
                            if (!expanded) {
                                checkboxes.style.display = "block";
                                expanded = true;
                            } else {
                                checkboxes.style.display = "none";
                                expanded = false;
                            }
                        });
                    } else {
                        checkboxes.style.display = "none";
                        expanded = false;
                    }
                })
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }
    </script>
@endsection
