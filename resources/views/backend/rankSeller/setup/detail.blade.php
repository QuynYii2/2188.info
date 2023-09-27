@php @endphp
@extends('backend.layouts.master')

@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Chi tiết mã giảm giá') }}</h5>
        </div>
        <div class="container">
            <form action="{{route('seller.setup.update', $rankSetup->id)}}" method="post">
                @csrf
                @for($i=0; $i<count($myArray);$i++)
                    @php
                        $listItem = $myArray[$i];
                        $arrayItem = explode(':', $listItem);
                        $value = (int)$arrayItem[1];
                        $string = str_replace(' ', '', $arrayItem[0]);
                    @endphp
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="{{$string}}_price">{{ __('home.Hạn mức') }} {{$string}}:</label>
                            <input type="number" min="1" class="form-control" name="{{$string}}_price" id="{{$string}}_price"
                                   placeholder="20" value="{{$value}}">
                        </div>
                    </div>
                @endfor
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
