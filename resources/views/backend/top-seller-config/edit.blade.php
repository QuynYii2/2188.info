@extends('backend.layouts.master')
@section('title', 'Create Top Seller')
@section('content')
    <h5 class="text-center mt-3 mb-4">Create marketing</h5>
    <div class="card p-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#exampleModal">Preview
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
                        <img style="width: 100%"
                             src="{{asset('images/z4629273739159_20f1e3ae8cdfc03ea6413d0fe4affab5 (1).jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <select class="form-select mb-4" aria-label="Default select example" id="selectMarketing">
            <option id="marketing_product" value="1">Product</option>
        </select>

        <form id="marketing_product_form" class="marketing_product" action="{{route('seller.config.create')}}"
              method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="local">Choosing location...</label>
                <select class="form-control" name="local" id="local">
                    @php
                        $locations = \App\Models\SetupMarketing::all();
                    @endphp
                    @foreach($locations as $location)
                        <option value="{{$location->id}}">
                            {{$location->stt}} - {{$location->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="text" hidden class="form-control" id="moneyLocal" name="moneyLocal" value="100">
            <label for="select_url">Select products</label>
            <div class="list-product_show">
                @php
                    $products = \Illuminate\Support\Facades\DB::table('products')->get();
                @endphp
                @foreach($products as $product)
                    <div class=" ">
                        <label class="image-checkbox d-flex align-items-center">
                            <input class="inputCheckbox" type="checkbox" name="arrayProduct[]" value="{{$product->id}}"/>
                            <div class="check_url">
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" class="img img-100">
                            </div>
                            <a href="{{route('detail_product.show', $product->id)}}">{{ ($product->name) }}</a>
                        </label>
                    </div>
                @endforeach
            </div>
            <input type="text" hidden class="form-control" id="moneyLocal" name="moneyLocal" value="100">
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

    $(".image-checkbox").each(function () {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        } else {
            $(this).removeClass('image-checkbox-checked');
        }
    });

    // sync the state to the input
    $(".image-checkbox").on("click", function (e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked", !$checkbox.prop("checked"))

        e.preventDefault();
    });
</script>
