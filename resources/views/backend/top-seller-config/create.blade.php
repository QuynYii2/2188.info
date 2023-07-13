@extends('backend.layouts.master')
@section('title', 'Create Top Seller')
@section('content')
    <div class="container">
        <h5 class="text-center">Create marketing</h5>
        <div class="card p-3">
            <form action="{{route('seller.config.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thumbnail">Choosing banner...</label>
                    <input type="file" class="form-control-file" accept="image/*" id="thumbnail" name="thumbnail">
                </div>
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
        </div>
    </div>
@endsection
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
    }

    checkTien();
</script>
