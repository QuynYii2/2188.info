@extends('frontend.layouts.master')

@section('title', ' Posted my RFQ')

@section('content')
    <div class="container">
        <div class="main-post-rfq">
            <div class="breadcrumbs_filter">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Posted my RFQ
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="main-create d-flex">
                <div class="basic-product w-75 bg-white mr-5">
                    <form action="{{ route('create.post.rfq') }}" class="form-create" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <h5 class="title">Basic product information</h5>
                        <div class="form-group">
                            <label for="product_name" class="main-text">Product name <span
                                        class="protected">*</span></label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required
                                   oninput="checkInput('product_name', 'icon_product_name')"
                                   placeholder="Enter a specific product name">
                        </div>
                        <div class="title-input main-text">Category</div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="code_1" class="main-text category-select">1st classification</label>
                                <div class="multiselect" style="position: relative">
                                    <div class="selectBox" id="code_1_item" onclick="showCheckboxes()">
                                        <select>
                                            <option id="inputCheckboxCategory">{{ __('home.Select the applicable category') }}</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="code_1" class="mt-1 checkboxes">
                                        @foreach($categories_no_parent as $category)
                                            <label class="ml-2 d-flex align-items-center"
                                                   for="type_business-{{$category->id}}">
                                                <input type="checkbox" id="type_business-{{$category->id}}"
                                                       {{--                                           name="code_1[]"--}}
                                                       value="{{ ($category->id) }}"
                                                       class="inputCheckboxCategory mr-2 p-3"/>
                                                <span class="labelCheckboxCategory">
                                                     @if(locationHelper() == 'kr')
                                                        <div class="item-text">{{ $category->name_ko }}</div>
                                                    @elseif(locationHelper() == 'cn')
                                                        <div class="item-text">{{$category->name_zh}}</div>
                                                    @elseif(locationHelper() == 'jp')
                                                        <div class="item-text">{{$category->name_ja}}</div>
                                                    @elseif(locationHelper() == 'vi')
                                                        <div class="item-text">{{$category->name_vi}}</div>
                                                    @else
                                                        <div class="item-text">{{$category->name_en}}</div>
                                                    @endif
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="code_2" class="main-text category-select">2nd classification</label>
                                <div class="multiselect" style="position: relative">
                                    <div class="selectBox" id="code_2_item" onclick="showCheckboxes2()">
                                        <select>
                                            <option id="inputCheckboxCategory1">{{ __('home.Select the applicable category') }}</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="code_2" class="mt-1  checkboxes">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="code_3" class="main-text category-select">3rd classification</label>
                                <div class="multiselect" style="position: relative">
                                    <div class="selectBox" id="code_3_item" onclick="showCheckboxes1()">
                                        <select>
                                            <option id="inputCheckboxCategory2">{{ __('home.Select the applicable category') }}</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="code_3" class="mt-1  checkboxes">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title-input main-text">Purchase Quantity <span class="protected">*</span></div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="number" min="0" class="form-control" id="purchase_quantity" name="purchase_quantity"
                                       oninput="checkInput('purchase_quantity', 'icon_purchase_quantity')" required>
                            </div>
                            <div class="form-group col-md-3">
                                <select id="unit_quantity" class="form-control" name="unit_quantity">
                                    <option value="20 Container">20' Container</option>
                                    <option value="40' Container">40' Container</option>
                                    <option value="20 HQ Container">20 HQ Container</option>
                                    <option value="Piece(s)">Piece(s)</option>
                                    <option value="Bag(s)">Bag(s)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="business_terms" class="main-text">Business terms <span
                                            class="protected">*</span></label>
                                <select id="business_terms" class="form-control" name="business_terms"
                                        onchange="checkInput('business_terms', 'icon_trade_terms')">
                                    <option value="FOB">FOB</option>
                                    <option value="EXW">EXW</option>
                                    <option value="FCA">FCA</option>
                                    <option value="FAS">FAS</option>
                                </select>
                            </div>
                        </div>
                        <div class="title-input main-text">Target unit price <span class="protected">*</span></div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="number" min="0" class="form-control" id="target_price" name="target_price">
                            </div>
                            <div class="form-group col-md-3">
                                <select id="unit_price" class="form-control" name="unit_price">
                                    <option value="USD">USD</option>
                                    <option value="KWR">KWR</option>
                                    <option value="VND">VND</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="max_budget" class="main-text">Max Budget <span
                                            class="protected">*</span></label>
                                <div class="d-flex align-items-center">
                                    <select id="max_budget" class="form-control" name="max_budget"
                                            onchange="checkInput('max_budget', 'icon_max_budget')">
                                        <option value="0-1000">0 - 1000</option>
                                        <option value="1000-5000">1000 - 5000</option>
                                        <option value="5000-10000">5000 - 10000</option>
                                        <option value="10000-10000000">10000 and bigger</option>
                                    </select>
                                    <span class="unit">USD</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="main-text">Detail <span class="protected">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="6"
                                      onchange="checkInput('description', 'icon_detail')"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="label_item main-text">
                                <span class="photo">Photo</span> <span class="protected">*</span>
                                <p class="text-desc">Please upload product images or files (maximum 5 photos)</p>
                            </div>
                            <label id="thumbnailsLabel" for="thumbnails"
                                   class="upload-item-input d-flex justify-content-between">
                                <div class="upload-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61"
                                         fill="none">
                                        <path d="M30 13V48M12.5 30.5H47.5" stroke="#929292" stroke-width="6"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </label>
                            <input type="file" class="form-control" id="thumbnails" accept="image/*" multiple
                                   style="visibility:hidden;"
                                   name="thumbnails[]" onchange="checkInput('thumbnails', 'icon_photo')" required>
                        </div>
                        <h5 class="title">Basic product information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="shipping_method" class="main-text">
                                    Shipping method <span class="protected">*</span>
                                </label>
                                <select id="shipping_method" class="form-control" name="shipping_method"
                                        onchange="checkInput('shipping_method', 'icon_shipping_method')">
                                    <option value="Sea freight">Sea freight</option>
                                    <option value="Express">Express</option>
                                    <option value="Land freight">Land freight</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="destination_port" class="main-text">
                                    Destination Port <span class="protected">*</span>
                                </label>
                                <input type="text" class="form-control" id="destination_port" name="destination_port"
                                       required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 lead-time d-flex align-items-center w-100">
                                <span class="text-nowrap span-one">
                                    Lead Time:
                                </span>
                                <span class="text-nowrap span-two">
                                    Ship in
                                </span>
                                <input type="number" min="0" class="form-control" id="ship_in" name="ship_in" required>
                                <span class="text-nowrap span-end">
                                    day(s) after supplier receives the initial payment.
                                </span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="payment_terms" class="main-text">
                                    Payment Terms <span class="protected">*</span>
                                </label>
                                <select id="payment_terms" class="form-control" name="payment_terms"
                                        onchange="checkInput('payment_terms', 'icon_payment_terms')">
                                    <option value="T/T">T/T</option>
                                    <option value="L/C">L/C</option>
                                    <option value="D/P">D/P</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" name="code_1" class="d-none" id="input_code1">
                        <input type="text" name="code_2" class="d-none" id="input_code2">
                        <input type="text" name="code_3" class="d-none" id="input_code3">
                        <div class="button-submit text-center w-100">
                            <button type="submit" class="btn text-center">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="completeness w-25 bg-white ">
                    <h5 class="text-center title">Completeness</h5>
                    <div class="image-circle" id="circleContainer">
                        <div class="percent">
                            <svg>
                                <circle cx="105" cy="105" r="100"></circle>
                                <circle id="circleLimitPercent" cx="105" cy="105" r="100"></circle>
                            </svg>
                            <div class="title" id="circleText">
                                incomplete
                            </div>
                        </div>
                    </div>
                    <div class="short-desc">
                        The more precise information you write,the better response you will get.
                    </div>
                    <div class="long-desc">
                        Provide as many details as possible about your request to ensure a faster response from the
                        right suppliers. The higher the score the better responses you will get.
                    </div>
                    <div class="list-fn">
                        <div class="fn-item">
                            <span class="icon" id="icon_product_name">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Product Name
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_category">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Category
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_purchase_quantity">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Purchase Quantity
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_trade_terms">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Trade Terms
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_max_budget">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Max Budget
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_detail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Details
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_photo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                               Photos
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_shipping_method">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                                Shipping Method
                            </span>
                        </div>
                        <div class="fn-item">
                            <span class="icon" id="icon_payment_terms">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="text">
                               Payment Terms
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setCirclePercentage(10);

        let htmlChecked = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#33A753" stroke="#33A753" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>`;
        let htmlUnChecked = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                     fill="none">
                                  <path d="M8.00065 14.6667C11.6673 14.6667 14.6673 11.6667 14.6673 8.00004C14.6673 4.33337 11.6673 1.33337 8.00065 1.33337C4.33398 1.33337 1.33398 4.33337 1.33398 8.00004C1.33398 11.6667 4.33398 14.6667 8.00065 14.6667Z"
                                        fill="#BFBFBF" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M5.16602 7.99995L7.05268 9.88661L10.8327 6.11328" stroke="#F3F3F3"
                                        stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>`;

        function checkInput(id, sid) {
            let arrayID = ['product_name', 'input_code1', 'purchase_quantity', 'business_terms', 'max_budget', 'description', 'thumbnails', 'shipping_method', 'payment_terms'];
            let count = 100;
            for (let i = 0; i < arrayID.length; i++) {
                let elementID = arrayID[i];
                let value = null;
                if (elementID == 'thumbnails') {
                    value = document.getElementById(elementID).files[0];
                } else {
                    value = document.getElementById(elementID).value;
                }
                if (!value) {
                    count = parseInt(count) - 10;
                    document.getElementById(sid).innerHTML = htmlUnChecked;
                } else {
                    document.getElementById(sid).innerHTML = htmlChecked;
                }
            }

            setCirclePercentage(count);
        }

        function setCirclePercentage(percent) {
            const circle = document.getElementById('circleLimitPercent');
            const circumference = 625;
            const dashOffset = circumference * (100 - percent) / 100;
            let text = `Incomplete`;
            if (percent > 30) {
                if (percent < 70){
                    text = 'Basic'
                } else {
                    text = 'Excellent';
                }
            }
            document.getElementById('circleText').innerText = text;
            circle.style.strokeDashoffset = dashOffset;
        }
    </script>
    <script>
        $(document).ready(function () {
            $("#thumbnails").change(function () {
                filename = this.files[0].name;
                $('#thumbnailsLabel').text(filename);
            });

            let arrayItem = [];
            let arrayNameCategory = [];
            $('.inputCheckboxCategory').on('click', function () {
                getInput();

                let count = document.querySelectorAll('.inputCheckboxCategory:checked').length
                if (count > 3) {
                    $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', true);
                } else {
                    $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', false);
                }
            })

            async function getInput() {
                let items = document.getElementsByClassName('inputCheckboxCategory');

                arrayItem = checkArray(arrayItem, items);
                arrayNameCategory = getListName(arrayNameCategory, items)

                let listName = arrayNameCategory.toString();

                if (listName) {
                    $('#inputCheckboxCategory').text(listName);
                    await renderCategory2(arrayItem);
                } else {
                    $('#inputCheckboxCategory').text(`{{ __('home.Select the applicable category') }}`);
                }

                arrayItem.sort();
                let value = arrayItem.toString();
                $('#input_code1').val(value);
                checkInput('input_code1', 'icon_category');
            }
        })
    </script>
    <script>
        var expanded = false, expanded1 = false, expanded2 = false;

        function showCheckboxes() {
            var code_1 = document.getElementById("code_1");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    var code_1_item = document.getElementById('code_1_item');
                    if (code_1.contains(e.target) || code_1_item.contains(e.target)) {
                        $('#code_1_item').on('click', function () {
                            if (!expanded) {
                                code_1.style.display = "block";
                                expanded = true;
                            } else {
                                code_1.style.display = "none";
                                expanded = false;
                            }
                        });
                    } else {
                        code_1.style.display = "none";
                        expanded = false;
                    }
                })
                code_1.style.display = "block";
                expanded = true;
            } else {
                code_1.style.display = "none";
                expanded = false;
            }
        }

        function showCheckboxes1() {
            var code_3 = document.getElementById("code_3");
            if (!expanded1) {
                window.addEventListener('click', function (e) {
                    let code_3_item = document.getElementById('code_3_item');
                    if (code_3.contains(e.target) || code_3_item.contains(e.target)) {
                        $('#code_3_item').on('click', function () {
                            if (!expanded1) {
                                code_3.style.display = "block";
                                expanded1 = true;
                            } else {
                                code_3.style.display = "none";
                                expanded1 = false;
                            }
                        });
                    } else {
                        code_3.style.display = "none";
                        expanded1 = false;
                    }
                })
                code_3.style.display = "block";
                expanded1 = true;
            } else {
                code_3.style.display = "none";
                expanded1 = false;
            }
        }

        function showCheckboxes2() {
            var code_2 = document.getElementById("code_2");
            if (!expanded2) {
                window.addEventListener('click', function (e) {
                    let code_2_item = document.getElementById('code_2_item');
                    if (code_2.contains(e.target) || code_2_item.contains(e.target)) {
                        $('#code_2_item').on('click', function () {
                            if (!expanded2) {
                                code_2.style.display = "block";
                                expanded2 = true;
                            } else {
                                code_2.style.display = "none";
                                expanded2 = false;
                            }
                        });
                    } else {
                        code_2.style.display = "none";
                        expanded2 = false;
                    }
                })
                code_2.style.display = "block";
                expanded2 = true;
            } else {
                code_2.style.display = "none";
                expanded2 = false;
            }
        }
    </script>
    <script>
        async function renderCategory2(value) {
            let url = '{{ route('get.category.one.parent') }}';

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    listCategoryID: value,
                    arrayCategory: $('#inputArrayCategory').val(),
                    _token: '{{ csrf_token() }}',
                }
            })
                .done(function (response) {
                    $('#code_2').empty().append(response);
                })
                .fail(function (_, textStatus) {

                });
        }

        function removeArray(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax = arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        function getListName(array, items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].checked) {
                    if (array.length == 0) {
                        array.push(items[i].nextElementSibling.innerText);
                    } else {
                        let name = array.includes(items[i].nextElementSibling.innerText);
                        if (!name) {
                            array.push(items[i].nextElementSibling.innerText);
                        }
                    }
                } else {
                    removeArray(array, items[i].nextElementSibling.innerText)
                }
            }
            return array;
        }

        function checkArray(array, listItems) {
            for (let i = 0; i < listItems.length; i++) {
                if (listItems[i].checked) {
                    if (array.length == 0) {
                        array.push(listItems[i].value);
                    } else {
                        let check = array.includes(listItems[i].value);
                        if (!check) {
                            array.push(listItems[i].value);
                        }
                    }
                } else {
                    removeArray(array, listItems[i].value);
                }
            }
            return array;
        }
    </script>
@endsection
