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
            <div class="">
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <h5>Search User</h5>
                        <input class="form-control" id="inputSearchUser" type="text" placeholder="Search..">
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="form-group col-md-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="email">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="member">Member</label>
                        <select id="member" class="form-control" name="member">
                            @if($members->isNotEmpty())
                                @foreach($members as $member)
                                    <option value="{{$member->name}}">{{$member->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="role">Role</label>
                        <select id="role" class="form-control" name="role">
                            <option value="buyer">BUYER</option>
                            <option value="seller">SELLER</option>
                            <option value="super_admin">ADMIN</option>
                        </select>
                    </div>
                </div>
                <br>
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
                        <th scope="col">Order</th>
                        <th scope="col">Products</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$users->isEmpty())
                        @foreach($users as $user)
                            <tr>
                                <th scope="row"> {{$loop->index + 1}}</th>
                                <td class="table-name">{{$user->name}}</td>
                                <td class="table-email">{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td class="table-role">
                                    @php
                                        $user_roles = DB::table('role_user')->where('user_id', $user->id)->get();
                                    @endphp
                                    @if($user_roles->isEmpty())
                                        buyer
                                    @endif
                                    @foreach($user_roles as $user_role)
                                        @php
                                            $role = \App\Models\Role::find($user_role->role_id)
                                        @endphp
                                        {{$role->name}}
                                        <br>
                                    @endforeach
                                </td>
                                <td class="table-member">{{$user->member}}</td>
                                <td>{{$user->region}}</td>

                                <td>
                                    @php
                                        $orders = \App\Models\Order::where('user_id', $user->id)->get();
                                    @endphp
                                    {{count($orders)}}
                                </td>

                                <td>
                                    @php
                                        $products = \App\Models\Product::where('user_id', $user->id)->get();
                                    @endphp
                                    {{count($products)}}
                                </td>
                                <td>{{$user->status}}</td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{route('admin.private.update.users', $user->id)}}"
                                           class="btn btn-primary">Detail</a>
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
        $(document).ready(function () {
            $("#name").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $('#tableUser tr').each(function () {
                    var found = false;
                    $(this).find("td.table-name").each(function () {
                        if ($(this).text().toLowerCase().includes(value)) {
                            found = true;
                        }
                    });
                    $(this).toggle(found);
                });
            });

            $("#email").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $('#tableUser tr').each(function () {
                    var found = false;
                    $(this).find("td.table-email").each(function () {
                        if ($(this).text().toLowerCase().includes(value)) {
                            found = true;
                        }
                    });
                    $(this).toggle(found);
                });
            });

            $("#member").on("change", function () {
                var value = $(this).val().toLowerCase();
                $('#tableUser tr').each(function () {
                    var found = false;
                    $(this).find("td.table-member").each(function () {
                        if ($(this).text().toLowerCase().includes(value)) {
                            found = true;
                        }
                    });
                    $(this).toggle(found);
                });
            });

            $("#role").on("change", function () {
                var value = $(this).val().toLowerCase();
                $('#tableUser tr').each(function () {
                    var found = false;
                    $(this).find("td.table-role").each(function () {
                        if ($(this).text().toLowerCase().includes(value)) {
                            found = true;
                        }
                    });
                    $(this).toggle(found);
                });
            });
        });
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
