@extends('backend.layouts.master')
@section('title', 'Create Top Seller')
@section('content')
    <h5 class="text-center mt-3 mb-4">Create marketing</h5>
    <div class="card p-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#exampleModal">
            Preview
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 70vw">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img style="width: 100%" src="{{asset('images/z4629273739159_20f1e3ae8cdfc03ea6413d0fe4affab5 (1).jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
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
                <input type="text" hidden class="form-control" id="moneyLocal" name="moneyLocal" value="100">
                <button class="btn btn-primary" type="submit">Create</button>
        </form>
        <form id="marketing_category_form" class="marketing_category d-none " action="{{route('seller.config.create')}}"
              method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="select_url">Select products</label>
                <select class="form-control" name="category" id="category">
                    <option value="0">Shop</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="local">Choosing location...</label>
                <select class="form-control" name="local" id="local">
                    @foreach($options as $option)
                        <option value="{{$option}}">
                            {{$option}}
                        </option>
                    @endforeach
                </select>
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
                <label for="name">Name...</label>
                <input type="text" name="name_custom"  class="form-control">
            </div>
            <div class="form-group">
                <label for="url">Enter an https:// URL:</label>
                <input type="url" name="url" id="url" class="form-control" placeholder="https://example.com" required />
            </div>
            <div class="form-group">
                <label for="local">Choosing location...</label>
                <select class="form-control" name="local" id="local2">
                    @foreach($options as $option)
                        <option value="{{$option}}">
                            {{$option}}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="text" hidden class="form-control" id="moneyLocal2" name="moneyLocal" value="100">
            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
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
