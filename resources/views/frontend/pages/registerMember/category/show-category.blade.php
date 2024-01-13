<style>
    /* normal menu css */
    .main_menu > ul > li {
        display: inline-block;
        position: relative;
        margin: 0 -2px;
    }

    .main_menu ul li {
        position: relative;
    }

    .main_menu ul li p {
        font-size: 16px;
        color: #353535;
        padding: 20px 25px;
        display: block;
        font-weight: 400;
    }

    .main_menu ul li .active,
    .main_menu ul li:hover > p {
        color: rgb(102, 40, 245);
        cursor: pointer;
    }

    /* Normal Dropdown menu */
    .main_menu ul li ul {
        width: 200px;
        background: #fff;
        transition: 0.5s;
        box-shadow: 0px 5px 15px 0px rgba(212, 201, 201, 0.75);
    }

    .main_menu ul li ul li p {
        padding: 10px 25px;
        font-size: 15px;
    }

    .main_menu ul li ul li p i {
        float: right;
    }

    .main_menu ul li ul li ul {
        left: 100%;
        top: 0;
    }

    /* mega menu css */
    .mega_menu_dropdown {
        position: static !important;
    }

    .mega_menu {
        left: 0;
        right: 0;
        background: #fff;
        display: flex;
        flex-wrap: wrap;
        transition: 0.5s;
        box-shadow: 0px 5px 15px 0px rgba(212, 201, 201, 0.75);
    }

    .mega_menu_item {
        width: 50%;
        padding: 30px 20px;
    }

    .main_menu ul li .mega_menu_item p {
        padding: 10px 0;
    }

    .main_menu ul li .mega_menu_item p:hover {
        color: rgb(102, 40, 245);
    }

    .mega_menu_item h3 {
        margin-bottom: 15px;
    }

    .mega_menu_item img {
        width: 100%;
    }

    /* demo_2 css */
    .mega_menu_demo_2 .mega_menu {
        left: 50%;
        transform: translateX(-50%);
        width: 1140px;
    }

    .mobile_btn {
        display: none;
    }

    /* responsive css */
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .mega_menu_demo_2 .mega_menu {
            width: 940px;
        }

        .main_menu ul li ul {
            width: 150px;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .mega_menu_demo_2 .mega_menu {
            width: 700px;
        }

        .main_menu ul li p {
            font-size: 15px;
            padding: 20px 16px;
        }

        .main_menu ul li ul {
            width: 150px;
        }
    }

    @media (min-width: 768px) {
        .main_menu ul li ul {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            margin-top: 50px;
        }

        .main_menu ul li .mega_menu {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            margin-top: 50px;
        }

        .main_menu ul li:hover > ul {
            visibility: visible;
            opacity: 1;
            margin-top: 0px;
            z-index: 99;
        }

        .main_menu ul li:hover > .mega_menu {
            visibility: visible;
            opacity: 1;
            margin-top: 0;
            z-index: 99;
        }
    }

    @media (max-width: 767.98px) {
        .mega_menu_demo_2 .mega_menu,
        .container {
            width: 100%;
        }

        nav {
            padding: 15px;
        }

        .mobile_btn {
            cursor: pointer;
            display: block;
        }

        .main_menu {
            display: none;
            width: 100%;
        }

        .main_menu ul li {
            display: block;
        }

        .main_menu ul li p i {
            float: right;
        }

        .main_menu ul li p {
            border-bottom: 1px solid #ddd;
        }

        .main_menu ul li ul {
            width: 100%;
        }

        .main_menu ul li ul li ul {
            left: 0;
            top: auto;
        }

        .mega_menu .mega_menu_item {
            width: 50%;
        }

        .main_menu ul li ul {
            display: none;
            transition: none;
        }

        .main_menu ul li .mega_menu {
            display: none;
            transition: none;
        }

        .mega_menu_demo_2 .mega_menu {
            transform: translateX(0);
        }
    }

    @media (max-width: 575.98px) {
        .mega_menu .mega_menu_item {
            width: 100%;
        }
    }
</style>
<div class="label_form">{{ __('home.PLU') }} <span class="text-danger">*</span></div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="code_1" class="label_item-member">{{ __('home.1st classification') }} <span
                    class="text-danger">*</span></label>
        @php
            $code_1 = null;
        @endphp
        @if($exitsMember)
            @php
                $code_1 = \App\Models\Category::find($exitsMember->code_1);
            @endphp
        @endif
        <input type="text" class="d-none" value="{{ $code_1 }}" id="code_1" name="code_1">
        <nav>
            <div class="main_menu" id="main_menu_code_1">
                <ul>
                    <li class="has_dropdown w-100 bg-white">
                        <p>
                            <span class="title_code_1">{{ $code_1 ? $code_1->name :  __('home.Choose category')  }}</span>
                            <i class="fas fa-angle-down"></i>
                        </p>
                        <ul class="sub_menu">
                            @foreach($categories_no_parent as $category)
                                @php
                                    $child_categories = \App\Models\Category::where([
                                                            ['status', \App\Enums\CategoryStatus::ACTIVE],
                                                            ['parent_id', $category->id]
                                                        ])->get();
                                @endphp
                                @if(count($child_categories) > 0)
                                    <li class="has_dropdown">
                                        <p> {{ $category->name }} <i
                                                    class="fas fa-angle-right"></i></p>
                                        <ul class="sub_menu">
                                            @foreach($child_categories as $child_category)
                                                @php
                                                    $child_categories_2 = \App\Models\Category::where([
                                                                            ['status', \App\Enums\CategoryStatus::ACTIVE],
                                                                            ['parent_id', $child_category->id]
                                                                        ])->get();
                                                @endphp
                                                @if(count($child_categories_2) > 0)
                                                    <li class="has_dropdown">
                                                        <p>{{ $child_category->name }}<i
                                                                    class="fas fa-angle-right"></i></p>
                                                        <ul class="sub_menu">
                                                            @foreach($child_categories_2 as $child_category2)
                                                                <li>
                                                                    <p class="option_code_1"
                                                                       data-id="{{ $child_category2->id }}"
                                                                       p>{{ $child_category2->name }}</p>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li><p>{{ $child_category->name }}</p>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><p>{{ $category->name }}</p></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="form-group col-md-6">
        <label for="code_2" class="label_item-member">
            {{ __('home.2nd classification') }}<span class="text-danger">*</span>
        </label>
        @php
            $code_2 = null;
        @endphp
        @if($exitsMember)
            @php
                $code_2 = \App\Models\Category::find($exitsMember->code_2);
            @endphp
        @endif
        <input type="text" class="d-none" value="{{ $code_2 }}" id="code_2" name="code_2">
        <nav>
            <div class="main_menu" id="main_menu_code_2">
                <ul>
                    <li class="has_dropdown w-100 bg-white">
                        <p>
                            <span class="title_code_3">{{ $code_2 ? $code_2->name : __('home.Choose category') }}</span>
                            <i class="fas fa-angle-down"></i>
                        </p>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="code_3" class="label_item-member">
            {{ __('home.3rd classification') }} <span class="text-danger">*</span>
        </label>
        @php
            $code_3 = null;
        @endphp
        @if($exitsMember)
            @php
                $code_3 = \App\Models\Category::find($exitsMember->code_3);
            @endphp
        @endif
        <input type="text" class="d-none" value="{{ $code_3 }}" id="code_3" name="code_3">
        <nav>
            <div class="main_menu" id="main_menu_code_3">
                <ul>
                    <li class="has_dropdown w-100 bg-white">
                        <p>
                            <span class="title_code_3">{{ $code_3 ? $code_3->name : __('home.Choose category') }}</span>
                            <i class="fas fa-angle-down"></i>
                        </p>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="form-group col-md-6">
        <label for="code_4" class="label_item-member">
            {{ __('home.4th classification') }} <span class="text-danger">*</span>
        </label>
        @php
            $code_4 = null;
        @endphp
        @if($exitsMember)
            @php
                $code_4 = \App\Models\Category::find($exitsMember->code_4);
            @endphp
        @endif
        <input type="text" class="d-none" value="{{ $code_4 }}" id="code_4" name="code_4">
        <nav>
            <div class="main_menu" id="main_menu_code_4">
                <ul>
                    <li class="has_dropdown w-100 bg-white">
                        <p>
                            <span class="title_code_4">{{ $code_4 ? $code_4->name : __('home.Choose category') }}</span> <i
                                    class="fas fa-angle-down"></i>
                        </p>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.option_code_1').on('click', function () {
            let id = $(this).data('id');
            for (let i = 2; i < 5; i++) {
                callListCategory(id, i);
            }
        })
    })

    async function callListCategory(id, data) {
        let url = `{{ route('categories.show.all.same.category', ['id'=>':id']) }}`;
        url = url.replace(':id', id);
        url = url + `?sort_by=desc`;
        await $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                renderCategory(response, data);
            },
            error: function (error) {
                console.log(error);
            }
        });

    }

    function renderCategory(response, data) {
        let main_html = ``;
        let category = response.category;
        let list_child_one = response.child;
        let html = ``;
        for (let i = 0; i < list_child_one.length; i++) {
            let child_one = list_child_one[i];
            let list_child_two = child_one.child;
            let count = child_one.total_child;
            let option = ``;
            for (let j = 0; j < list_child_two.length; j++) {
                let child_two = list_child_two[j];
                option = option + `<li><p class="option_code_${data}"
                                       data-id="${child_two.id}">${child_two.name}</p></li>`;
            }
            if (count < 1) {
                html = html + `<li><p>${child_one.name}</p></li>`;
            } else {
                html = html + `<li class="has_dropdown">
                                    <p >${child_one.name} <i class="fas fa-angle-right"></i></p>
                                     <ul class="sub_menu">
                                        ${option}
                                    </ul>
                                  </li>`;
            }
        }
        main_html = `<ul>
                         <li class="has_dropdown w-100 bg-white"><p>  <span class="title_code_${data}">{{ __('home.Choose category') }}</span> <i class="fas fa-angle-down"></i></p>
                            <ul class="sub_menu">
                              <li class="has_dropdown"><p> ${category.name} <i class="fas fa-angle-right"></i></p>
                                <ul class="sub_menu">
                                    ${html}
                                </ul>
                              </li>
                            </ul>
                          </li>
                        </ul>`;
        $('#main_menu_code_' + data).empty().append(main_html);
        loadTitleAndValue();
    }

    function loadTitleAndValue() {
        for (let i = 1; i < 5; i++) {
            setTitleAndValue(i);
        }
    }

    loadTitleAndValue();

    function setTitleAndValue(id) {
        let element = $('.option_code_' + id);
        element.on('click', function () {
            let val = $(this).data('id');
            let title = $(this).text();

            $('#code_' + id).val(val);
            $('.title_code_' + id).text(title);
        })
    }
</script>