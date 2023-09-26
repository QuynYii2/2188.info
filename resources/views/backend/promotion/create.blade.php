@php @endphp
@extends('backend.layouts.master')

@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Thêm mới khuyến mãi') }}</h5>
        </div>
        <div class="container">
            <form action="{{route('seller.promotion.create')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">{{ __('home.Tên khuyến mãi') }}</label>
                        <input type="text" class="form-control" required name="name" id="name" placeholder={{ __('home.Nhập tên khuyến mãi') }}>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="percent">{{ __('home.Phần trăm khuyến mãi') }}</label>
                        <input type="number" min="1" max="100" required class="form-control" name="percent" id="percent"
                               placeholder="60">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="status">{{ __('home.apply') }}</label>
                        <div class="multiselect">
                            <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                <select>
                                    <option>{{ __('home.chọn sản phẩm áp dụng') }}</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div id="checkboxes" class="mt-1">
                                @if($products)
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
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="{{\App\Enums\PromotionStatus::ACTIVE}}">{{\App\Enums\PromotionStatus::ACTIVE}}</option>
                            <option value="{{\App\Enums\PromotionStatus::INACTIVE}}">{{\App\Enums\PromotionStatus::INACTIVE}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="startDate">{{ __('home.ngày bắt đầu') }}</label>
                        <input type="datetime-local" required class="form-control" name="startDate" id="startDate">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="endDate">{{ __('home.ngày kết thúc') }} </label>
                        <input type="datetime-local" required class="form-control" name="endDate" id="endDate">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">{{ __('home.Description') }}</label>
                    <textarea type="text" name="description" class="form-control" id="description"
                              placeholder="Description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
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
