@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <div class="container">
        <section class="section ">
            <div class="row">
                <div class="mb-3">
                    <h5>Search User</h5>
                    <input class="form-control" id="inputSearchUser" type="text" placeholder="Search..">
                    <br>
                </div>
                <table class="table table-bordered" id="tableUser">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">FullName</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                        <th scope="col">Member</th>
                        <th scope="col">Region</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$users->isEmpty())
                        @foreach($users as $user)
                            <tr>
                                <th scope="row"> {{$loop->index + 1}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->member}}</td>
                                <td>{{$user->region}}</td>
                                <td>{{$user->status}}</td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{route('admin.detail.users', $user->id)}}" class="btn btn-primary">Detail</a>
                                        <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </section>
    </div>
    <script>
        function SortUser() {
            $('#tableUser').DataTable();
            $('#tableUser_length').addClass('d-none');
            $('#tableUser_filter').addClass('d-none');
            $('#tableUser_paginate').addClass('d-none');
            $('#tableUser_info').addClass('d-none');
        }

        SortUser();
    </script>
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $('.toggleNews').on('click', function () {--}}
        {{--        let $newsID = $(this).data('id');--}}

        {{--        function setProduct($newsID) {--}}
        {{--            $.ajax({--}}
        {{--                url: '/admin/news/toggle/' + $newsID,--}}
        {{--                method: 'POST',--}}
        {{--                data: {--}}
        {{--                    _token: '{{ csrf_token() }}'--}}
        {{--                },--}}
        {{--                success: function (response) {--}}
        {{--                    let status = document.getElementById('newsStatus' + $newsID)--}}
        {{--                    status.innerText = response['status'];--}}
        {{--                },--}}
        {{--                error: function (exception) {--}}
        {{--                    console.log(exception)--}}
        {{--                }--}}
        {{--            });--}}
        {{--        }--}}

        {{--        setProduct($newsID);--}}
        {{--    })--}}
        {{--});--}}
    </script>
    <script>
        $(document).ready(function () {
            $("#inputSearchUser").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#tableUser tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
