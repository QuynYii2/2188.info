@extends('frontend.layouts.profile')

@section('title', 'List Permission')

@section('sub-content')
    @php

    @endphp
    <div class="row mt-2 bg-white rounded">
        <div class="row  rounded pt-1 ml-5">
            <h5>{{ __('home.upgrade permission') }}</h5>
        </div>
        <div class="border-bottom"></div>
    </div>

    <div class="row bg-white mt-3">
        <table class="table table-bordered">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Permission Name</th>
                <th scope="col">Price</th>
                <th scope="col">Duration</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <input type="text" name="permission-id-{{ $loop->index + 1 }}" id="permission-id-{{ $loop->index + 1 }}"
                       value="{{$permission->id}}" hidden="">
                <input type="text" name="permission-name-{{ $loop->index + 1 }}"
                       id="permission-name-{{ $loop->index + 1 }}" value="{{$permission->name}}" hidden="">
                <input type="text" name="permission-price-{{ $loop->index + 1 }}"
                       id="permission-price-{{ $loop->index + 1 }}" value="10" hidden="">
                <input type="text" name="permission-duration-{{ $loop->index + 1 }}"
                       id="permission-duration-{{ $loop->index + 1 }}" value="1" hidden="">
                <tr>
                    <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                    <td>{{ ($permission->name) }}</td>
                    <td class="text-center">
                        $10
                    </td>
                    <td class="text-center">
                        1 year
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success mr-2 full-width" data-toggle="modal"
                                data-target="#choosePermissionUpgrade"
                                aria-expanded="false" onclick="myFun({{$loop->index + 1}})">
                            {{ __('home.upgrade') }}
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="choosePermissionUpgrade" tabIndex="-1" role="dialog"
             aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{route('permission.create')}}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Register New Permission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="permission-name">Permission name:</label>
                                <input type="text" name="permission-name" id="permission-name"
                                       value="1" disabled>
                                <input type="text" name="permission-id" id="permission-id"
                                       value="1" hidden="">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="permission-price" id="price" value="$10" disabled>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration:</label>
                                <input type="text" value="1 year"
                                       disabled>
                                <input type="text" name="permission" id="duration" value="1"
                                       hidden="">
                            </div>
                            <div class="form-group">
                                <label for="datetime">Activation date:</label>
                                <input type="text" name="permission-activation" id="datetime"
                                       value="{{\Carbon\Carbon::now()->addHours(7)}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="datetime">Expiration date:</label>
                                <input type="text" name="permission-expiration" id="datetime"
                                       value="{{\Carbon\Carbon::now()->addHours(7)->addYear()}}" disabled>
                            </div>
                            <button class="btn btn-danger" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function myFun(x) {
            var name = document.getElementById('permission-name');
            var id = document.getElementById('permission-id');
            var price = document.getElementById('price');
            var duration = document.getElementById('duration');

            name.value = document.getElementById('permission-name-' + x).value;
            id.value = document.getElementById('permission-id-' + x).value;
            price.value = document.getElementById('permission-price-' + x).value;
            duration.value = document.getElementById('permission-duration-' + x).value;
        }
    </script>
@endsection
