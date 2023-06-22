@php use Illuminate\Support\Facades\Auth; @endphp

@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif
    <div class="container mt-5">
        <div class="card">
            <h2 class="mt-3 mb-3 text-center">Đơn hàng</h2>
                <div class="row">
                    <div class="col-75">
                        <div class="container">
                            <form method="post" action="{{route('create.payment')}}">
                                @csrf
                                <div class="col-25">
                                    <div class="container">
                                        <p>
                                        <table id="table-checkout" class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Loại</th>
                                                <th>Giá</th>
                                                <th>Thời hạn</th>
                                                <th class="float-end">Tổng</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($permissions as $permission)
                                                  <tr>
                                                      <td>{{ $loop->index + 1 }}</td>
                                                      @php
                                                          $per = \App\Models\Permission::find($permission->permission_id);
                                                      @endphp
                                                      <td class="">{{$per->name}}</td>
                                                      <td id="price-{{$permission->permission_id}}">10</td>
                                                      <td id="">1 year</td>
                                                      <td class="float-end"
                                                          id="total-quantity-{{$permission->permission_id}}">10</td>
                                                  </tr>
                                              @endforeach
                                            </tbody>
                                        </table>
                                        </p>
                                        <hr>
                                        <p>Total: <span class="price" style="color:black"><b>$ <span
                                                            id="max-total" class="text-danger">1</span></b></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="">
                                    @if(count($permissions) > 0)
                                        <button type="submit" class=" mt-3 mb-3 btn btn-danger">Checkout Now</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
        var totalPrice = document.getElementById('max-total');
        function getAllTotal() {
            var firstCells = document.querySelectorAll('#table-checkout td:nth-child(5)');
            var cellValues = [];
            firstCells.forEach(function (singleCell) {
                cellValues.push(singleCell.innerText);
            });
            let i, total = 0;
            for (i = 0; i < cellValues.length; i++) {
                total = parseFloat(total) + parseFloat(cellValues[i]);
            }

            totalPrice.innerText = total;
        }
        getAllTotal();

    </script>
@endsection
