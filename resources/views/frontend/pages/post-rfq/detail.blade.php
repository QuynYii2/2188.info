@extends('backend.layouts.master')
@section('title', 'Detail Post')
@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <h3 class="text-center">Detail Post</h3>
    <div class="mb-5">
        <form action="{{ route('user.post.rfq.update', $post->id) }}" class="form-detail_postRFQ" method="post"
              enctype="multipart/form-data">
            @csrf
            <h5 class="title">Basic product information</h5>
            <div class="form-group">
                <label for="product_name" class="main-text">Product name <span
                            class="protected">*</span></label>
                <input type="text" class="form-control" id="product_name" name="product_name" required
                       value="{{ $post->product_name }}"
                       placeholder="Enter a specific product name">
            </div>
            <div class="title-input main-text">Category</div>
            @php
                $data_1 = null;
                foreach ($category_1 as $item){
                    if ($data_1){
                        $data_1 = $data_1 .', '. $item->name;
                    } else {
                        $data_1 = $item->name;
                    }
                }
            @endphp
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="code-1sl" class="main-text category-select">1st classification</label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" id="code_1_item" onclick="showCheckboxes()">
                            <select id="code-1sl" class="w-100">
{{--                                <option id="inputCheckboxCategory">{{ __('home.Select the applicable category') }}</option>--}}
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
                    <div class="text-bold mt-3">1st classification: <span>{{ $data_1 }}</span></div>
                </div>
                @php
                    $data_2 = null;
                    foreach ($category_2 as $item){
                        if ($data_2){
                            $data_2 = $data_2 .', '. $item->name;
                        } else {
                            $data_2 = $item->name;
                        }
                    }
                @endphp
                <div class="form-group col-md-4">
                    <label for="code-2sl" class="main-text category-select">2nd classification</label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" id="code_2_item" onclick="showCheckboxes2()">
                            <select id="code-2sl" class="w-100">
{{--                                <option id="inputCheckboxCategory1">{{ __('home.Select the applicable category') }}</option>--}}
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        <div id="code_2" class="mt-1  checkboxes">

                        </div>
                    </div>
                    <div class="text-bold mt-3">2nd classification: <span>{{ $data_2 }}</span></div>
                </div>
                @php
                    $data_3 = null;
                    foreach ($category_3 as $item){
                        if ($data_3){
                            $data_3 = $data_3 .', '. $item->name;
                        } else {
                            $data_3 = $item->name;
                        }
                    }
                @endphp
                <div class="form-group col-md-4">
                    <label for="code-3sl" class="main-text category-select">3rd classification</label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" id="code_3_item" onclick="showCheckboxes1()">
                            <select id="code-3sl" class="w-100">
                                <option id="inputCheckboxCategory2">{{ __('home.Select the applicable category') }}</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        <div id="code_3" class="mt-1  checkboxes">

                        </div>
                    </div>
                    <div class="text-bold mt-3">3rd classification: <span>{{ $data_3 }}</span></div>
                </div>
            </div>
            <div class="title-input main-text mt-2">Purchase Quantity <span class="protected">*</span></div>
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="number" min="0" class="form-control" value="{{ $post->purchase_quantity }}"
                           id="purchase_quantity" name="purchase_quantity"
                           required>
                </div>
                <div class="form-group col-md-4">
                    <select id="unit_quantity" class="form-control" name="unit_quantity">
                        <option {{ $post->unit_quantity == '20 Container' ? 'selected' : ''}} value="20 Container">20'
                            Container
                        </option>
                        <option {{ $post->unit_quantity == "40' Container" ? 'selected' : ''}} value="40' Container">40'
                            Container
                        </option>
                        <option {{ $post->unit_quantity == '20 HQ Container' ? 'selected' : ''}} value="20 HQ Container">
                            20 HQ Container
                        </option>
                        <option {{ $post->unit_quantity == 'Piece(s)' ? 'selected' : ''}} value="Piece(s)">Piece(s)
                        </option>
                        <option {{ $post->unit_quantity == 'Bag(s)' ? 'selected' : ''}} value="Bag(s)">Bag(s)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="business_terms" class="main-text">Business terms <span
                                class="protected">*</span></label>
                    <select id="business_terms" class="form-control" name="business_terms">
                        <option {{ $post->business_terms == 'FOB' ? 'selected' : ''}} value="FOB">FOB</option>
                        <option {{ $post->business_terms == 'EXW' ? 'selected' : ''}} value="EXW">EXW</option>
                        <option {{ $post->business_terms == 'FCA' ? 'selected' : ''}} value="FCA">FCA</option>
                        <option {{ $post->business_terms == 'FAS' ? 'selected' : ''}} value="FAS">FAS</option>
                    </select>
                </div>
            </div>
            <div class="title-input main-text">Target unit price <span class="protected">*</span></div>
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="number" min="0" class="form-control" id="target_price"
                           value="{{ $post->target_price }}" name="target_price">
                </div>
                <div class="form-group col-md-4">
                    <select id="unit_price" class="form-control" name="unit_price">
                        <option {{ $post->unit_price == 'USD' ? 'selected' : ''}} value="USD">USD</option>
                        <option {{ $post->unit_price == 'KWR' ? 'selected' : ''}} value="KWR">KWR</option>
                        <option {{ $post->unit_price == 'VND' ? 'selected' : ''}} value="VND">VND</option>
                        <option {{ $post->unit_price == 'Other' ? 'selected' : ''}} value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12"><label for="max_budget" class="main-text">Max Budget <span
                                class="protected">*</span></label></div>
                    <div class="form-group d-flex col-md-12">
                        <div class="d-flex align-items-center col-md-4 pl-0">
                            <select id="max_budget" class="form-control" name="max_budget">
                                <option {{ $post->max_budget == '0-1000' ? 'selected' : ''}} value="0-1000">0 - 1000
                                </option>
                                <option {{ $post->max_budget == '1000-5000' ? 'selected' : ''}} value="1000-5000">1000 -
                                    5000
                                </option>
                                <option {{ $post->max_budget == '5000-10000' ? 'selected' : ''}} value="5000-10000">5000
                                    -
                                    10000
                                </option>
                                <option {{ $post->max_budget == '10000-10000000' ? 'selected' : ''}} value="10000-10000000">
                                    10000 and bigger
                                </option>
                            </select>
                        </div>
                        <div><span class="unit col-md-4">USD</span></div>
                    </div>
                </div>
            <div class="form-group">
                <label for="description" class="main-text">Detail <span class="protected">*</span></label>
                <textarea class="form-control" id="description" name="description"
                          rows="6">{{ $post->description }}</textarea>
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
                       name="thumbnails[]">
            </div>
            <span>List Image:</span>
            <div class="d-flex">
                @php
                    $thumbnails = $post->thumbnails;
                    $arrayThumbnails = explode(',', $thumbnails);
                @endphp
                @foreach($arrayThumbnails as $image)
                    <img class="m-3" src="{{ asset('storage/'.$image) }}" alt=""
                         style="max-width: 100px; object-fit: cover">
                @endforeach
            </div>
            <h5 class="title">Basic product information</h5>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="shipping_method" class="main-text">
                        Shipping method <span class="protected">*</span>
                    </label>
                    <select id="shipping_method" class="form-control" name="shipping_method">
                        <option {{ $post->shipping_method == 'Sea freight' ? 'selected' : ''}} value="Sea freight">Sea
                            freight
                        </option>
                        <option {{ $post->shipping_method == 'Express' ? 'selected' : ''}} value="Express">Express
                        </option>
                        <option {{ $post->shipping_method == 'Land freight' ? 'selected' : ''}} value="Land freight">
                            Land freight
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="destination_port" class="main-text">
                        Destination Port <span class="protected">*</span>
                    </label>
                    <input type="text" class="form-control" id="destination_port" name="destination_port"
                           value="{{ $post->destination_port }}"
                           required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 lead-time d-flex align-items-center w-100">
                    <div>
                       <span class="text-nowrap span-one">
                                    Lead Time:
                    </span>
                        <span class="text-nowrap span-two">
                                    Ship in
                        </span>
                    </div>
                    <div><input type="number" min="0" value="{{ $post->ship_in }}" class="form-control" id="ship_in"
                                name="ship_in" required></div>
                    <div><span class="text-nowrap span-end">
                                    day(s) after supplier receives the initial payment.
                                </span></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="payment_terms" class="main-text">
                        Payment Terms <span class="protected">*</span>
                    </label>
                    <select id="payment_terms" class="form-control" name="payment_terms">
                        <option {{ $post->payment_terms == 'T/T' ? 'selected' : ''}} value="T/T">T/T</option>
                        <option {{ $post->payment_terms == 'L/C' ? 'selected' : '' }} value="L/C">L/C</option>
                        <option {{ $post->payment_terms == 'D/P' ? 'selected' : '' }} value="D/P">D/P</option>
                    </select>
                </div>
            </div>
            <input type="text" name="code_1" class="d-none" id="input_code1" value="{{ $post->code_1 }}">
            <input type="text" name="code_2" class="d-none" id="input_code2" value="{{ $post->code_2 }}">
            <input type="text" name="code_3" class="d-none" id="input_code3" value="{{ $post->code_3 }}">
            <div class="button-submit text-center w-100">
                <button type="submit" class="btn text-center btn-primary">Submit</button>
            </div>
        </form>
    </div>
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
