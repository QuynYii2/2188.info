@php @endphp
@extends('backend.layouts.master')
@section('title')
    {{ __('home.Chi tiết mã giảm giá') }}
@endsection
@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Chi tiết mã giảm giá') }}</h5>
        </div>
        <div class="container">
            <form action="{{route('seller.vouchers.update', $voucher->id)}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nameVoucher">{{ __('home.Tên mã giảm giá') }}</label>
                        <input type="text" class="form-control" name="nameVoucher" id="nameVoucher"
                               value="{{$voucher->name}}" required
                               placeholder="Nhập tên ãm giảm giá">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="quantity">{{ __('home.Số lượng') }}</label>
                        <input type="number" min="1" class="form-control" name="quantity" id="quantity"
                               value="{{$voucher->quantity}}" required
                               placeholder="123">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="percent">{{ __('home.Phần trăm giảm giá') }}</label>
                        <input type="number" min="1" max="100" class="form-control" name="percent" id="percent"
                               value="{{$voucher->percent}}" required
                               placeholder="60">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="percent">Mã voucher</label>
                        <input type="text" class="form-control"
                               value="{{$voucher->code}}"
                               disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Apply</label>
                        <div class="multiselect">
                            <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                <select>
                                    <option>{{ __('home.Chọn sản phẩm áp dụng') }}</option>
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
                    <input type="text" id="category_apply" value="{{$voucher->apply}}" hidden>
                    <div class="form-group col-md-3">
                        <label for="assign_to">{{ __('home.assign to') }}</label>
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
                            @if($voucher->status == \App\Enums\VoucherStatus::ACTIVE)
                                <option value="{{\App\Enums\VoucherStatus::ACTIVE}}">{{\App\Enums\VoucherStatus::ACTIVE}}</option>
                                <option value="{{\App\Enums\VoucherStatus::INACTIVE}}">{{\App\Enums\VoucherStatus::INACTIVE}}</option>
                            @else
                                <option value="{{\App\Enums\VoucherStatus::INACTIVE}}">{{\App\Enums\VoucherStatus::INACTIVE}}</option>
                                <option value="{{\App\Enums\VoucherStatus::ACTIVE}}">{{\App\Enums\VoucherStatus::ACTIVE}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="startDate">{{ __('home.ngày bắt đầu') }}</label>
                        <input type="datetime-local" class="form-control" name="startDate" id="startDate"
                               required value="{{$voucher->startDate}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="endDate">{{ __('home.ngày kết thúc') }} </label>
                        <input type="datetime-local" class="form-control" name="endDate" id="endDate"
                               required value="{{$voucher->endDate}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">{{ __('home.Description') }}</label>
                    <textarea type="text" name="description" class="form-control" id="description"
                              placeholder="Description"
                    >{{$voucher->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('home.update') }}/button>
            </form>
        </div>
    </div>
    <script>
        var listIDs = document.getElementById('category_apply').value
        $(document).ready(function () {
            myArray = listIDs.split(",");
            for (let i = 0; i < myArray.length; i++) {
                check(myArray[i])
            }

            function check(id) {
                document.getElementById("category-" + id).checked = true;
            }
        })
    </script>
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
