@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    @php
        $trans = \App\Http\Controllers\TranslateController::getInstance();
    @endphp
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
                        <input type="text" class="d-none" name="member" value="{{ $trans->translateText($registerMember) }}">
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
                                                           value="{{ $trans->translateText($category->id) }}"
                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory">{{ $trans->translateText($category->name) }}</span>
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
                                                            <span class="labelCheckboxCategory">{{ $trans->translateText($child->name) }}</span>
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
                                                                <span class="labelCheckboxCategory">{{ $trans->translateText($child2->name) }}</span>
                                                            </label>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-sm-3 col-form-label">Địa chỉ</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <textarea type="text" class="form-control" name="address_detail" required></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <h1>Chọn danh sách tỉnh</h1>
                            <select name="" id="province">
                            </select>
                            <select name="" id="district">
                                <option  value="">chọn quận</option>
                            </select>
                            <select name="" id="ward">
                                <option   value="">chọn phường</option>
                            </select>
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, "province");
            });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    }
    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    }

    var renderData = (array, select) => {
        let row = ' <option disable value="">chọn</option>';
        array.forEach(element => {
            row += `<option value="${element.code}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row
    }

    $("#province").change(() => {
        callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
        printResult();
    });
    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").val() + "?depth=2");
        printResult();
    });
    $("#ward").change(() => {
        printResult();
    })

    var printResult = () => {
        if ($("#district").val() != "" && $("#province").val() != "" &&
            $("#ward").val() != "") {
            let result = $("#province option:selected").text() +
                " | " + $("#district option:selected").text() + " | " +
                $("#ward option:selected").text();
            $("#result").text(result)
        }

    }
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

