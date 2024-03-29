@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <div id="table-user">
        <div class="container-fluid list-user-page">
            <div class="title s24w6">
                List user
            </div>
            <form class="form-search mt-3" method="GET" action="{{ route('admin.search.users') }}">
                <div class="search-user bg-white d-flex justify-content-between align-items-center">
                    <div class="list-input d-flex align-items-center">
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
                    </div>
                    <div class="list-button d-flex align-items-center">
                        <button type="submit" class="btn btnSearchProduct cFFFs16w6">
                            Submit
                        </button>
                        <a href="{{route('admin.list.users')}}" class="btn brnClear cF00s14w6">Clear All</a>
                    </div>
                </div>
            </form>
            <div class="list-user mt-3 bg-white" id="renderTableUser">
                <div class="d-flex align-items-center justify-content-end">
                    <a class="btn btnCreateDefault" href="{{ route('admin.member.process.create.company') }}">
                        <i class="fa-solid fa-plus"></i>
                        Add new company</a>
                </div>
                @include('admin.user-manager.layout.table-user')
            </div>
        </div>
    </div>
    <script>

    </script>
    <script>
        const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

        const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
        )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

        document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
            const table = th.closest('table');
            Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
                .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                .forEach(tr => table.appendChild(tr));
        })));
    </script>
@endsection
