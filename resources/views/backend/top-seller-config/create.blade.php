@extends('backend.layouts.master')
@section('title', 'Create Top Seller')
@section('content')
    <h5 class="text-center mt-3 mb-4">Create marketing</h5>
    <div class="card p-3">
        <select class="form-select mb-4" aria-label="Default select example" id="selectMarketing">
            <option id="marketing_product" value="1">Product</option>
            <option id="marketing_category" value="2">Category</option>
            <option id="marketing_custom" value="3">Custom</option>
        </select>
        <form id="marketing_product_form" class="marketing_product" action="{{route('seller.config.create')}}"
              method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="select_url">Select products</label>
                    <select class="form-control" name="product" id="select_url">
                        <option value="0">Shop</option>
                        @php
                            $products = \Illuminate\Support\Facades\DB::table('products')->get();
                        @endphp
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="local">Choosing location...</label>
                    <select class="form-control" name="local" id="local" onchange="checkTien();">
                        @foreach($options as $option)
                            <option value="{{$option}}">
                                {{$option}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="money" class="text-danger">Price</label>
                    <input type="text" disabled class="form-control" id="money" value="100">
                </div>
                <input type="text" hidden class="form-control" id="moneyLocal" name="moneyLocal" value="100">
                <button class="btn btn-primary" type="submit">Create</button>
        </form>
        <form id="marketing_category_form" class="marketing_category d-none " action="{{route('seller.config.create')}}"
              method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="select_url">Select products</label>
                <select class="form-control" name="url_tag" id="select_url">
                    <option value="0">Shop</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="local">Choosing location...</label>
                <select class="form-control" name="local" id="local1" onchange="checkTien();">
                    @foreach($options as $option)
                        <option value="{{$option}}">
                            {{$option}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="money" class="text-danger">Price</label>
                <input type="text" disabled class="form-control" id="money1" value="100">
            </div>
            <input type="text" hidden class="form-control" id="moneyLocal1" name="moneyLocal" value="100">
            <button class="btn btn-primary" type="submit">Create</button>
        </form>
        <form id="marketing_custom_form" class="marketing_custom d-none" action="{{route('seller.config.create')}}"
              method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="thumbnail">Choosing banner...</label>
                <input type="file" class="form-control-file" accept="image/*" id="thumbnail" name="thumbnail">
            </div>
            <div class="form-group">
                <label for="money">Name...</label>
                <input type="text" name="name_custom"  class="form-control">
            </div>
            <div class="form-group">
                <label for="local">Choosing location...</label>
                <select class="form-control" name="local" id="local2" onchange="checkTien();">
                    @foreach($options as $option)
                        <option value="{{$option}}">
                            {{$option}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="money" class="text-danger">Price</label>
                <input type="text" disabled class="form-control" id="money2" value="100">
            </div>
            <input type="text" hidden class="form-control" id="moneyLocal2" name="moneyLocal" value="100">
            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    function checkTien() {
        var local = document.getElementById("local").value;
        var money = document.getElementById("money");
        var moneyLocal = document.getElementById("moneyLocal");
        if (local == 1) {
            money.value = 100;
            moneyLocal.value = 100;
        } else if (local == 2) {
            money.value = 80;
            moneyLocal.value = 80;
        } else if (local == 3) {
            money.value = 60;
            moneyLocal.value = 60;
        } else if (local == 4) {
            money.value = 30;
            moneyLocal.value = 30;
        } else {
            money.value = 10;
            moneyLocal.value = 10;
        }
        var local = document.getElementById("local1").value;
        var money = document.getElementById("money1");
        var moneyLocal = document.getElementById("moneyLocal1");
        if (local == 1) {
            money.value = 100;
            moneyLocal.value = 100;
        } else if (local == 2) {
            money.value = 80;
            moneyLocal.value = 80;
        } else if (local == 3) {
            money.value = 60;
            moneyLocal.value = 60;
        } else if (local == 4) {
            money.value = 30;
            moneyLocal.value = 30;
        } else {
            money.value = 10;
            moneyLocal.value = 10;
        }
        var local = document.getElementById("local2").value;
        var money = document.getElementById("money2");
        var moneyLocal = document.getElementById("moneyLocal2");
        if (local == 1) {
            money.value = 100;
            moneyLocal.value = 100;
        } else if (local == 2) {
            money.value = 80;
            moneyLocal.value = 80;
        } else if (local == 3) {
            money.value = 60;
            moneyLocal.value = 60;
        } else if (local == 4) {
            money.value = 30;
            moneyLocal.value = 30;
        } else {
            money.value = 10;
            moneyLocal.value = 10;
        }
    }
    checkTien();
</script>
<script>

    $(document).ready(function () {
        $('#selectMarketing').on('change', function () {
            let value = $(this).val();
            Marketing(value);
        })
    })

    function Marketing(value) {
        switch (value) {
            case '1':
                document.getElementById("marketing_product_form").classList.remove('d-none');
                document.getElementById("marketing_category_form").classList.add('d-none');
                document.getElementById("marketing_custom_form").classList.add('d-none');
                break;
            case '2':
                document.getElementById("marketing_product_form").classList.add('d-none');
                document.getElementById("marketing_category_form").classList.remove('d-none');
                document.getElementById("marketing_custom_form").classList.add('d-none')
                break;
            default:
                document.getElementById("marketing_product_form").classList.add('d-none');
                document.getElementById("marketing_category_form").classList.add('d-none');
                document.getElementById("marketing_custom_form").classList.remove('d-none');
                break;
        }
    }
</script>
