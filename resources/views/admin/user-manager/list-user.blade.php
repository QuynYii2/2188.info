@php use App\Models\MemberRegisterInfo;use App\Models\Order;use App\Models\Product; @endphp
@php @endphp
@php @endphp
@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <div class="container-fluid list-user-page">
        <div class="title s24w6">
            List user
        </div>
        <form class="form-search mt-3" method="post" action="{{ route('admin.search.users') }}">
            @csrf
            <div class="search-user bg-white d-flex justify-content-between align-items-center">
                <div class="list-input d-flex align-items-center">
                    <input type="text" class="form-control c929292s16w6" name="keyword" id="keyword"
                           placeholder="Name/email/phone" value="{{ isset($keyword) ? $keyword : ''}}">
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
                    @php
                        $isAdmin = checkAdmin();
                    @endphp
                    @if($isAdmin && Auth::user()->is_admin == 1)
                        <select id="region" class="form-control c929292s16w6" name="region">
                            <option value="" selected>Region</option>
                            <option value="kr">Korea</option>
                            <option value="vi">VietNam</option>
                            <option value="cn">China</option>
                            <option value="jp">Japan</option>
                            <option value="en">Other</option>
                        </select>
                    @endif
                </div>
                <div class="list-button d-flex align-items-center">
                    <button type="submit" class="btn btnSearchProduct cFFFs16w6">
                        Submit
                    </button>
                    <a href="{{route('admin.list.users')}}" class="btn brnClear cF00s14w6">Clear All</a>
                </div>
            </div>
        </form>
        <div class="list-user mt-3 bg-white">
            <table class="table mt-3" id="tableUser">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">FullName</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Company Name</th>
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
                        @php
                            $memberPerson = \App\Models\MemberRegisterPersonSource::where('email', $user->email)
                                ->where('status', \App\Enums\MemberRegisterPersonSourceStatus::ACTIVE)
                                ->first();
                            $company = null;
                            if ($memberPerson){
                                $company = MemberRegisterInfo::find($memberPerson->member_id);
                            }
                        @endphp
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
                                @if($company)
                                    {{ $company->name_en }}
                                @endif
                            </td>
                            <td>
                                {{$user->member}}
                            </td>
                            @php
                                $cateName = null;
                                if ($company){
                                    $list_categories = \App\Models\Category::whereIn('id', explode(',', $company->category_id))
                                    ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                                    ->get();
                                    foreach ($list_categories as $item){
                                        if ($cateName){
                                            $cateName = $cateName .','. $item->name;
                                        } else{
                                             $cateName = $item->name;
                                        }
                                    }
                                }
                            @endphp
                            <td>
                                {{ $cateName }}
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
                                <div class="d-flex align-items-center list-icon-action">
                                    @if($company)
                                        <a href="{{route('stand.register.member.index', $company->id)}}"
                                           class="iconView">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    @endif
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
            <div class="d-flex align-items-center justify-content-between">
                {{ $users->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
