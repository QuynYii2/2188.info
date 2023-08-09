@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">Đăng kí thông tin</div>
                </div>
                <div class="container mt-5">
                    <form class="p-3" action="{{route('register.member.info')}}" method="post">
                        @csrf
                        <input type="text" class="d-none" name="member" value="{{ ($registerMember) }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="companyName" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="codeBusiness">Code Business</label>
                                <input type="text" class="form-control" id="codeBusiness" name="codeBusiness"
                                       required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phoneNumber">PhoneNumber</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="form-group col-md-6 register-member">
                                <label for="category">Category</label>
                                <div class="multiselect" style="position: relative">
                                    <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                        <select>
                                            <option>Chọn category áp dụng</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="checkboxes" class="mt-1  checkboxes" >
                                        @foreach($categories as $category)
                                            @if(!$category->parent_id)
                                                <label class="ml-2" for="category-{{$category->id}}">
                                                    <input type="checkbox" id="category-{{$category->id}}"
                                                           name="category-{{$category->id}}"
                                                           value="{{ ($category->id) }}"
                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory">{{ ($category->name) }}</span>
                                                </label>
                                                @if(!$categories->isEmpty())
                                                    @php
                                                        $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                                    @endphp
                                                    @foreach($categories as $child)
                                                        <label class="ml-4" for="category-{{$child->id}}">
                                                            <input type="checkbox" id="category-{{$child->id}}"
                                                                   name="category-{{$child->id}}"
                                                                   value="{{$child->id}}"
                                                                   class="inputCheckboxCategory mr-2 p-3"/>
                                                            <span class="labelCheckboxCategory">{{ ($child->name) }}</span>
                                                        </label>
                                                        @php
                                                            $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                                        @endphp
                                                        @foreach($listChild2 as $child2)
                                                            <label class="ml-5" for="category-{{$child2->id}}">
                                                                <input type="checkbox" id="category-{{$child2->id}}"
                                                                       name="category-{{$child2->id}}"
                                                                       value="{{$child2->id}}"
                                                                       class="inputCheckboxCategory mr-2 p-3"/>
                                                                <span class="labelCheckboxCategory">{{ ($child2->name) }}</span>
                                                            </label>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="countries-select">Chọn quốc gia:</label>
                                <select class="form-control" id="countries-select" name="countries-select" onchange="getListState(this.value)">
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cities-select">Chọn thành phố:</label>
                                <select class="form-control" id="cities-select" name="cities-select" onchange="getListCity(this.value)">
                                    <option value="">-- Chọn thành phố --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="provinces-select">Chọn quận/huyện:</label>
                                <select class="form-control" id="provinces-select" name="provinces-select" onchange="getListState(this.value)">
                                    <option value="">-- Chọn quận/huyện --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="wards-select">Chọn phường/xã:</label>
                                <select class="form-control" name="wards-select" id="wards-select">
                                    <option value="">-- Chọn phường/xã --</option>
                                </select>
                            </div>

                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-sm-3 col-form-label">Địa chỉ</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <textarea type="text" class="form-control" name="address_detail" required></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </form>
                    <h2 id="result"></h2>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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


        const ID_COUNTRY = 'countries-select'
        const ID_STATE = 'cities-select'
        const ID_CITY = 'provinces-select'

        getListNation();

        function getListNation() {
            let url = '{{ route('location.nation.get') }}'
            fetch(url)
                .then( async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_COUNTRY)
                });
        }

        function getListState(id) {
            let url = '{{ route('location.state.get', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            fetch(url)
                .then( async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_STATE)
                });
        }

        function getListCity(id) {
            let url = '{{ route('location.city.get', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            fetch(url)
                .then( async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_CITY)
                });
        }

        function makeHTMLFromJson(data, id_where) {
            const selectElement = document.getElementById(id_where);
            selectElement.innerHTML = '';
            data.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.name;
                selectElement.appendChild(optionElement);
            })
        }

    </script>
@endsection



