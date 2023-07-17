@extends('backend.layouts.master')

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    #table-account-manage .table-responsive {
        margin: 30px 0;
    }

    #table-account-manage .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    #table-account-manage table.table tr th, #table-account-manage table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    #table-account-manage table.table tr th:first-child {
        width: 60px;
    }

    #table-account-manage table.table tr th:last-child {
        width: 100px;
    }

    #table-account-manage table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    #table-account-manage table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    #table-account-manage table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    #table-account-manage table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    #table-account-manage table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    #table-account-manage table.table td a:hover {
        color: #2196F3;
    }

    #table-account-manage table.table td a.settings {
        color: #2196F3;
    }

    #table-account-manage table.table td a.delete {
        color: #F44336;
    }

    #table-account-manage table.table td i {
        font-size: 19px;
    }

    #table-account-manage table.table .avatar-a {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
        width: 30px !important;
        height: 30px !important;
    }

    #table-account-manage .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }

    #table-account-manage .text-success {
        color: #10c469;
    }

    #table-account-manage .text-info {
        color: #62c9e8;
    }

    #table-account-manage .text-warning {
        color: #FFC107;
    }

    #table-account-manage .text-danger {
        color: #ff5b5b;
    }

    #table-account-manage .pagination {
        float: right;
        margin: 0 0 5px;
    }

    #table-account-manage .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    #table-account-manage .pagination li a:hover {
        color: #666;
    }

    #table-account-manage .pagination li.active a, #table-account-manage .pagination li.active a.page-link {
        background: #03A9F4;
    }

    #table-account-manage .pagination li.active a:hover {
        background: #0397d6;
    }

    #table-account-manage .pagination li.disabled i {
        color: #ccc;
    }

    #table-account-manage .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    #table-account-manage .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
</style>

@section('content')

    <div class="container-fluid" id="table-account-manage">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listUsers as $users)

                    @php
                    $user = \App\Models\User::where('id', $users->user_id)->first();
                    @endphp
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ asset('storage/'.$user->image) }}" class="avatar-a"></td>
                        <td>
                                <a href="#">{{ $user->name }}</a>
                        </td>
                        <td><a href="#">{{ $user->email }}</a></td>
                        <td> @if ($user->status == 'ACTIVE')
                                <span class="status text-success">&bull;</span>{{ $user->status }}
                            @else
                                <span class="status text-danger">&bull;</span>{{ $user->status }}
                            @endif</td>
                        <td>
                            <a href="{{ route('account.delete', $user->id) }}" class="delete" onclick="return confirmDelete()" title="Delete" data-toggle="tooltip"><i
                                        class="material-icons">&#xE5C9;</i></a>
                            <a href="{{ route('account.lock', $user->id) }}" class="settings" title="Lock" data-toggle="tooltip"><i
                                        class="material-icons">&#xe897;</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            <div class="clearfix">--}}
{{--                <div class="hint-text">Showing <b>10</b> out of <b>{{ $getAllUser->total() }}</b> entries</div>--}}
{{--                <ul class="pagination">--}}
{{--                    @foreach($getAllUser->links()->elements[0] as $index => $page)--}}
{{--                        <li class="page-item"><a class="page-link" href="{{ $page }}">{{ $index }}</a></li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </div>

    <script>
        function confirmDelete() {
             return confirm("Bạn có chắc chắn muốn xóa?")
        }
    </script>
@endsection
