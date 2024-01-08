@extends('backend.layouts.master')
@section('title')
    Create Company
@endsection
@section('content')
    <h3 class="text-center mt-3">
        Create Company
    </h3>
    <div class="container-fluid p-3">
        <form action="{{ route('admin.member.create.company') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="" for="datetime_register">Datetime Register</label>
                <input type="text" class="form-control" id="datetime_register" disabled
                       value="{{ \Carbon\Carbon::now()->addHours(7)->format('Y-m-d H:i:s') }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="" for="number_clearance">Number Clearance <span
                                class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="number_clearance"  name="number_clearance"
                           value="">
                </div>
                <div class="form-group col-md-6">
                    <label class="" for="fax">Fax <span
                                class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="fax" value="" name="fax">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="" for="email">Email <span
                                class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="">
                </div>
                <div class="form-group col-md-6">
                    <label class="" for="phone">Phone <span
                                class="text-danger">*</span></label>
                    <input value="" type="number" class="form-control" name="phone"
                           id="phone">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="" for="name_en">Name EN <span
                                class="text-danger">*</span></label>
                    <input value="" type="text" class="form-control" name="name_en"
                           id="name_en">
                </div>
                <div class="form-group col-md-6">
                    <label class="" for="name_kr">Name KR <span
                                class="text-danger">*</span></label>
                    <input value="" type="text" class="form-control" name="name_kr"
                           id="name_kr">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="" for="number_business">Number Business <span
                                class="text-danger">*</span></label>
                    <input value="" type="number"
                           class="form-control" name="number_business"
                           id="number_business">
                </div>
                <div class="form-group col-md-4">
                    <label class="" for="type_business">Type Business <span
                                class="text-danger">*</span></label>
                    <select id="type_business" name="type_business" class="form-control">
                        <option value="distributive">{{ __('home.distributive') }}</option>
                        <option value="manufacture">{{ __('home.manufacture') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="" for="code_business">Code Business <span
                                class="text-danger">*</span></label>

                    <select id="code_business" name="code_business" class="form-control">
                        <option class="distributive"
                                value="wholesale">{{ __('home.wholesale') }}</option>
                        <option class="distributive" value="retail">{{ __('home.retail') }}</option>
                        <option class="distributive"
                                value="ecommerce">{{ __('home.ecommerce') }}</option>
                        <option class="distributive"
                                value="home shopping">{{ __('home.home shopping') }}</option>
                        <option class="distributive" value="commerce">{{ __('home.commerce') }}</option>

                        <option class="manufacture d-none"
                                value="manufacture">{{ __('home.manufacture') }}</option>
                        <option class="manufacture d-none"
                                value="assemble">{{ __('home.assemble') }}</option>
                        <option class="manufacture d-none"
                                value="machining">{{ __('home.machining') }}</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="" for="homepage">Homepage <span
                                class="text-danger">*</span></label>
                    <input value="" type="text" class="form-control" name="homepage"
                           id="homepage">
                </div>
                <div class="form-group col-md-4">
                    <label class="" for="status_business">Status Business</label>
                    <select id="status_business" name="status_business" class="form-control">
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="" for="member">Member<span
                                class="text-danger">*</span></label>
                    <select id="member" name="member" class="form-control">
                        <option value="TRUST">TRUST</option>
                        <option value="LOGISTIC">LOGISTIC</option>
                    </select>
                </div>
            </div>
            @include('frontend.pages.registerMember.category.show-category')
            <div class="form-group">
                <label class="" for="address_en">Address En <span
                            class="text-danger">*</span></label>
                <input value="" type="text" class="form-control"
                       id="address_en" name="address_en"
                       placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label class="" for="address_kr">Address KR <span
                            class="text-danger">*</span></label>
                <input value="" type="text" class="form-control" name="address_kr"
                       id="address_kr" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="" for="giay_phep_kinh_doanh">Business License <span
                                class="text-danger">*</span></label>
                    <input accept="image/*" type="file"
                           class="form-control" name="giay_phep_kinh_doanh"
                           id="giay_phep_kinh_doanh">
                </div>
                <div class="form-group col-md-6">
                    <label class="" for="certify_business">Certify Business <span
                                class="text-danger">*</span></label>
                    <input accept="image/*" type="file"
                           class="form-control" name="certify_business"
                           id="certify_business">
                </div>
            </div>
            <div class="action-form text-center">
                <button class="btn btnCreateDefault">Create</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            let type_business = $('#type_business');
            let manufacture = $('.manufacture');
            let distributive = $('.distributive');

            type_business.on('change', function () {
                let value = $(this).val();
                if (value == 'distributive') {
                    manufacture.addClass('d-none');
                    distributive.removeClass('d-none');
                } else {
                    distributive.addClass('d-none');
                    manufacture.removeClass('d-none');
                }
            })

            let item = type_business.val();
            if (item == 'distributive') {
                manufacture.addClass('d-none');
                distributive.removeClass('d-none');
            } else {
                distributive.addClass('d-none');
                manufacture.removeClass('d-none');
            }
        })
    </script>
@endsection
