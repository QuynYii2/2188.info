@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <div class="container-fluid bg-white p-3">
        <a class="back text-black d-flex align-items-center" href="{{route('admin.list.users')}}">
            <i class="fa-solid fa-angle-left mr-2" style="font-size: 20px"></i>
            <span class="s24w6">{{ __('home.back_to') }}</span>
        </a>
        <h5 class="text-center s20w6 mt-3">Company Information</h5>
        <form>
            <div class="form-group">
                <label class="s12w6" for="datetime_register">Datetime Register</label>
                <input disabled type="text" class="form-control input-custom" id="datetime_register"
                       value="{{ \Carbon\Carbon::parse($company->datetime_register)->format('Y-m-d H:i:s') }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="number_clearance">Number Clearance</label>
                    <input disabled type="text" class="form-control input-custom" id="number_clearance"
                           value="{{ $company->number_clearance }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="fax">Fax</label>
                    <input disabled type="text" class="form-control input-custom" id="fax" value="{{ $company->fax }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="email">Email</label>
                    <input disabled type="email" class="form-control input-custom" id="email"
                           value="{{ $company->email }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="phone">Phone</label>
                    <input disabled value="{{ $company->phone }}" type="text" class="form-control input-custom"
                           id="phone">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="name_en">Name EN</label>
                    <input disabled value="{{ $company->name_en }}" type="text" class="form-control input-custom"
                           id="name_en">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="name_kr">Name KR</label>
                    <input disabled value="{{ $company->name_kr }}" type="text" class="form-control input-custom"
                           id="name_kr">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="s12w6" for="number_business">Number Business</label>
                    <input disabled value="{{ $company->number_business }}" type="text"
                           class="form-control input-custom"
                           id="number_business">
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="type_business">Type Business</label>
                    <input disabled value="{{ $company->type_business }}" type="text" class="form-control input-custom"
                           id="type_business">
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="code_business">Code Business</label>
                    <input disabled value="{{ $company->code_business }}" type="text" class="form-control input-custom"
                           id="code_business">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="homepage">Homepage</label>
                    <input disabled value="{{ $company->homepage }}" type="text" class="form-control input-custom"
                           id="homepage">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="status_business">Status Business</label>
                    <input disabled value="{{ $company->status_business }}" type="text"
                           class="form-control input-custom"
                           id="status_business">
                </div>
            </div>
            @php
                $categoryList = $company->code_1;

                if ($categoryList) {
                    $categoryIds = explode(',', $categoryList);

                    $arrayCategory = \App\Models\Category::whereIn('id', $categoryIds)
                        ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                        ->get();

                    $categoryName = $arrayCategory->pluck('name')->implode(',');
                } else {
                    $categoryName = null;
                }

            @endphp
            <div class="form-group">
                <label class="s12w6" for="code_1">Code 1</label>
                <input disabled value="{{ $categoryName }}" type="text" class="form-control input-custom" id="code_1"
                       placeholder="Apartment, studio, or floor">
            </div>
            @php
                $categoryList = $company->code_2;

                if ($categoryList) {
                    $categoryIds = explode(',', $categoryList);

                    $arrayCategory = \App\Models\Category::whereIn('id', $categoryIds)
                        ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                        ->get();

                    $categoryName = $arrayCategory->pluck('name')->implode(',');
                } else {
                    $categoryName = null;
                }

            @endphp
            <div class="form-group">
                <label class="s12w6" for="code_2">Code 2</label>
                <input disabled value="{{ $categoryName }}" type="text" class="form-control input-custom" id="code_2"
                       placeholder="1234 Main St">
            </div>
            @php
                $categoryList = $company->code_3;

                if ($categoryList) {
                    $categoryIds = explode(',', $categoryList);

                    $arrayCategory = \App\Models\Category::whereIn('id', $categoryIds)
                        ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                        ->get();

                    $categoryName = $arrayCategory->pluck('name')->implode(',');
                } else {
                    $categoryName = null;
                }

            @endphp
            <div class="form-group">
                <label class="s12w6" for="code_3">Code 3</label>
                <input disabled value="{{ $categoryName }}" type="text" class="form-control input-custom" id="code_3"
                       placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label class="s12w6" for="address_en">Address En</label>
                <input disabled value="{{ $company->address_en }}" type="text" class="form-control input-custom"
                       id="address_en"
                       placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label class="s12w6" for="address_kr">Address KR</label>
                <input disabled value="{{ $company->address_kr }}" type="text" class="form-control input-custom"
                       id="address_kr" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="giay_phep_kinh_doanh">Business License</label>
                    <img src="{{ asset('storage/' . $company->giay_phep_kinh_doanh) }}" alt="" style="max-width: 100px">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="certify_business">Certify Business</label>
                    <img src="{{ asset('storage/' . $company->certify_business) }}" alt="" style="max-width: 100px">
                </div>
            </div>
        </form>
    </div>
@endsection
