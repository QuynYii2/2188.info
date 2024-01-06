@extends('backend.layouts.master')
@section('title')
    Create Company
@endsection
@section('content')
    <h3 class="text-center mt-3">
        Create Company
    </h3>
    <div class="container-fluid p-3">
        <form>
            <div class="form-group">
                <label class="s12w6" for="datetime_register">Datetime Register</label>
                <input type="text" class="form-control" id="datetime_register" disabled
                       value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="number_clearance">Number Clearance</label>
                    <input type="text" class="form-control" id="number_clearance"
                           value="">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="fax">Fax</label>
                    <input type="text" class="form-control" id="fax" value="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="email">Email</label>
                    <input type="email" class="form-control" id="email"
                           value="">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="phone">Phone</label>
                    <input value="" type="text" class="form-control"
                           id="phone">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="name_en">Name EN</label>
                    <input value="" type="text" class="form-control"
                           id="name_en">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="name_kr">Name KR</label>
                    <input value="" type="text" class="form-control"
                           id="name_kr">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="s12w6" for="number_business">Number Business</label>
                    <input value="" type="text"
                           class="form-control"
                           id="number_business">
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="type_business">Type Business</label>
                    <label for="type_business" class="label_item-member">{{ __('home.Business') }}</label>
                    <select id="type_business" name="type_business" class="form-control">
                        <option value="distributive">{{ __('home.distributive') }}</option>
                        <option value="manufacture">{{ __('home.manufacture') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="code_business">Code Business</label>

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
                <div class="form-group col-md-6">
                    <label class="s12w6" for="homepage">Homepage</label>
                    <input value="" type="text" class="form-control"
                           id="homepage">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="status_business">Status Business</label>
                    <input value="" type="text"
                           class="form-control"
                           id="status_business">
                </div>
            </div>
            @include('frontend.pages.registerMember.category.show-category')
            <div class="form-group">
                <label class="s12w6" for="address_en">Address En</label>
                <input value="" type="text" class="form-control"
                       id="address_en"
                       placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label class="s12w6" for="address_kr">Address KR</label>
                <input value="" type="text" class="form-control"
                       id="address_kr" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="s12w6" for="giay_phep_kinh_doanh">Business License</label>
                    <input accept="image/*" type="file"
                           class="form-control"
                           id="giay_phep_kinh_doanh">
                </div>
                <div class="form-group col-md-6">
                    <label class="s12w6" for="certify_business">Certify Business</label>
                    <input accept="image/*" type="file"
                           class="form-control"
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
