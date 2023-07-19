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
                <div class="mt-5">
                    <form class="p-3" action="{{route('register.member.info')}}" method="post">
                        @csrf
                        <input type="text" class="d-none" name="member" value="{{$registerMember}}">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="companyName" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numberBusiness">Number Business</label>
                                <input type="text" class="form-control" id="numberBusiness" name="numberBusiness"
                                       required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="codeBusiness">Code Business</label>
                                <input type="text" class="form-control" id="codeBusiness" name="codeBusiness"
                                       required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phoneNumber">PhoneNumber</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="type">Status Company</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="{{\App\Enums\StatusBusiness::ACTIVE}}">ACTIVE</option>
                                    <option value="{{\App\Enums\StatusBusiness::INACTIVE}}">INACTIVE</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="category">Category</label>
                                <div class="multiselect">
                                    <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                        <select>
                                            <option>Chọn category áp dụng</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="checkboxes" class="mt-1">
                                        @foreach($categories as $category)
                                            <label class="ml-2" for="category-{{$category->id}}">
                                                <input type="checkbox" id="category-{{$category->id}}"
                                                       name="category-{{$category->id}}"
                                                       value="{{$category->id}}"
                                                       class="mr-2 p-3"/>
                                                {{$category->name}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

