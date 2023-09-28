@php @endphp
@extends('backend.layouts.master')

@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Chi tiết khuyến mãi') }}</h5>
        </div>
        <div class="container">
            <form action="{{route('seller.promotion.update', $promotion->id)}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">{{ __('home.Tên khuyến mãi') }}</label>
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{$promotion->name}}" required
                               placeholder="Nhập tên khuyến mãi">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="percent">{{ __('home.Phần trăm giảm giá') }}</label>
                        <input type="number" min="1" max="100" class="form-control" name="percent" id="percent"
                               value="{{$promotion->percent}}" required
                               placeholder="60">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="percent">{{ __('home.Mã khuyến mãi') }}</label>
                        <input type="text" class="form-control"
                               value="{{$promotion->code}}"
                               disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">{{ __('home.apply') }}</label>
                        <div class="multiselect">
                            <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                <select>
                                    <option>{{ __('home.chọn sản phẩm áp dụng') }}</option>
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
                    <input type="text" id="category_apply" value="{{$promotion->apply}}" hidden>
                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            @if($promotion->status == \App\Enums\PromotionStatus::ACTIVE)
                                <option value="{{\App\Enums\PromotionStatus::ACTIVE}}">{{\App\Enums\PromotionStatus::ACTIVE}}</option>
                                <option value="{{\App\Enums\PromotionStatus::INACTIVE}}">{{\App\Enums\PromotionStatus::INACTIVE}}</option>
                            @else
                                <option value="{{\App\Enums\PromotionStatus::INACTIVE}}">{{\App\Enums\PromotionStatus::INACTIVE}}</option>
                                <option value="{{\App\Enums\PromotionStatus::ACTIVE}}">{{\App\Enums\PromotionStatus::ACTIVE}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="startDate">{{ __('home.ngày bắt đầu') }}</label>
                        <input type="datetime-local" class="form-control" name="startDate" id="startDate"
                               required value="{{$promotion->startDate}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="endDate">{{ __('home.dgày kết thúc') }} </label>
                        <input type="datetime-local" class="form-control" name="endDate" id="endDate"
                               required value="{{$promotion->endDate}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">{{ __('home.Description') }}</label>
                    <textarea type="text" name="description" class="form-control" id="description"
                              placeholder="Description"
                    >{{$promotion->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('home.despdate') }}</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/backend/promotion-detail.js') }}"></script>
@endsection
