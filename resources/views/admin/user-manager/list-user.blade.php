@php use App\Models\Role; @endphp
@php use App\Models\Order; @endphp
@php use App\Models\Product; @endphp
@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <div class="container">
        <section class="section ">
            <div class="">
                <form id="form-search">
                    <div class="row mt-3 mb-3">
                        <div class="form-group col-md-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="phone">
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="form-group col-md-4">
                            <label for="member">Member</label>
                            <select id="member" class="form-control" name="member">
                                <option value="" selected></option>
                                @if($members->isNotEmpty())
                                    @foreach($members as $member)
                                        <option value="{{$member->name}}">{{$member->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="role">Role</label>
                            <select id="role" class="form-control" name="role">
                                <option value="" selected></option>
                                @if($roles->isNotEmpty())
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="role">Category</label>
                            <select id="category" class="form-control" name="category">
                                <option value="" selected></option>
                                @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                        @switch(locationHelper())
                                            @case('kr')
                                                <option value="{{ $category->id }}">{{ $category->name_kr }}</option>
                                                @break
                                            @case('cn')
                                                <option value="{{ $category->id }}">{{ $category->name_zh }}</option>
                                                @break
                                            @case('jp')
                                                <option value="{{ $category->id }}">{{ $category->name_ja }}</option>
                                                @break
                                            @case('vi')
                                                <option value="{{ $category->id }}">{{ $category->name_vi }}</option>
                                                @break
                                            @default
                                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                        @endswitch
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row float-right mb-3">
                        <button class="btn btn-primary" type="button" onclick="searchListUser()">search</button>
                    </div>
                </form>
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
                    <tbody id="tbody-user">
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
                                            $role = Role::find($user_role->role_id)
                                        @endphp
                                        {{$role->name}}
                                        <br>
                                    @endforeach
                                </td>
                                <td class="table-member">{{$user->member}}</td>
                                <td>{{$user->region}}</td>

                                <td>
                                    @php
                                        $orders = Order::where('user_id', $user->id)->get();
                                    @endphp
                                    {{count($orders)}}
                                </td>

                                <td>
                                    @php
                                        $products = Product::where('user_id', $user->id)->get();
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
        function searchListUser() {
            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let member = $('#member').val();
            let role = $('#role').val();
            let category = $('#category').val();

            let url = "{{route('admin.search.users')}}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    member: member,
                    role: role,
                    category: category,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    $('#tbody-user').html(data);
                }
            });
        }

        function renderJson2Html() {

        }
    </script>
@endsection
