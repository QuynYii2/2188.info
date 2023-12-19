@php use App\Models\MemberRegisterInfo;use App\Models\Role; @endphp
@php use App\Models\Order; @endphp
@php use App\Models\Product; @endphp
@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <style>
        .pagination {
            height: 100px;
            font-size: 24px;
        }

        .pagination li a {
            margin: 4px;
            padding: 4px;
            color: #cccccc;
            text-decoration: none;
        }

        .pagination li.active {
            color: rgba(255, 165, 0, 0.93);
        }

        .pagination li a:hover {
            color: rgba(238, 207, 51, 0.82);
        }

        ul.pagination > li:first-child {
            margin-right: 8px;
        }

        ul.pagination > li:last-child {
            margin-left: 8px;
        }
    </style>
    <div class="container-fluid list-user-page">
        <div class="title s24w6">
            List user
        </div>
        <form class="form-search mt-3">
            <div class="search-user bg-white d-flex justify-content-between align-items-center">
                <div class="list-input d-flex align-items-center">
                    <input type="text" class="form-control c929292s16w6" id="keyword" placeholder="Name/email/phone">
                    <select id="member" class="form-control c929292s16w6" name="member">
                        <option value="" selected>Member</option>
                        @if($members->isNotEmpty())
                            @foreach($members as $member)
                                <option value="{{$member->name}}">{{$member->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <select id="category" class="form-control c929292s16w6" name="category">
                        <option value="" selected>Category</option>
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
                <div class="list-button d-flex align-items-center">
                    <button type="button" onclick="searchListUser();" class="btn btnSearchProduct cFFFs16w6">
                        Submit
                    </button>
                    <button type="reset" class="btn brnClear cF00s14w6">Clear All</button>
                </div>
            </div>
        </form>
        <div class="list-user mt-3 bg-white">
            <div class="button-create text-right">
                <a href="{{ route('admin.processCreate.users') }}" class="btn btnCreate">
                    <i class="fa-solid fa-plus"></i>
                    Add new member
                </a>
            </div>
            <table class="table mt-3" id="tableUser">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">FullName</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Member</th>
                    <th scope="col">Category</th>
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
                            <th scope="row">
                                {{ $loop->index + 1 }}
                            </th>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                {{$user->phone}}
                            </td>
                            <td>
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
                            <td>
                                {{$user->member}}
                            </td>
                            @php
                                $cates = MemberRegisterInfo::where('user_id', $user->id)->first('category_id');
                                $cateName = [];
                                if($cates){
                                $cates = explode(',', $cates->category_id);
                                $listCate = \App\Models\Category::whereIn('id', $cates)->get();
                                foreach ($listCate as $cate) {
                                    switch (locationHelper()) {
                                        case 'kr':
                                            array_push($cateName, $cate->name_kr);
                                            break;
                                        case 'cn':
                                            array_push($cateName, $cate->name_zh);
                                            break;
                                        case 'jp':
                                            array_push($cateName, $cate->name_ja);
                                            break;
                                        case 'vi':
                                            array_push($cateName, $cate->name_vi);
                                            break;
                                        default:
                                            array_push($cateName, $cate->name_en);
                                    }
                                }
                                }
                            @endphp
                            <td>
                                {{ implode(', ', $cateName) }}
                            </td>
                            <td>
                                {{$user->region}}
                            </td>
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
                            <td>
                                {{$user->status}}
                            </td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center list-icon-action">
                                    <a href="{{route('admin.private.update.users', $user->id)}}"
                                       class="iconDetail">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn iconDelete">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function searchListUser() {
            let keyword = $('#keyword').val();
            let member = $('#member').val();
            let category = $('#category').val();

            let url = "{{route('admin.search.users')}}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    keyword: keyword,
                    member: member,
                    category: category,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    $('#tbody-user').html(data);
                }
            });
        }
    </script>
@endsection
