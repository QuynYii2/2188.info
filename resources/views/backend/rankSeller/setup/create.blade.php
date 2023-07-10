@php @endphp
@extends('backend.layouts.master')

@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Thêm mới setup rank</h5>
        </div>
        <div class="container">
            <form action="{{route('seller.setup.create')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="copper_price">Hạn mức COPPER:</label>
                        <input type="number" min="1" class="form-control" name="copper_price" id="copper_price"
                               placeholder="20">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="silver_price">Hạn mức SILVER:</label>
                        <input type="number" min="1" class="form-control" name="silver_price" id="silver_price"
                               placeholder="40">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="gold_price">Hạn mức GOLD:</label>
                        <input type="number" min="1" class="form-control" name="gold_price" id="gold_price"
                               placeholder="60">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="diamond_price">Hạn mức DIAMOND:</label>
                        <input type="number" min="1" class="form-control" name="diamond_price" id="diamond_price"
                               placeholder="80">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
