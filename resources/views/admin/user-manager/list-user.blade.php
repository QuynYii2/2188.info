@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
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

    <script src="{{ asset('js/admin/list-user.js') }}"></script>
@endsection
