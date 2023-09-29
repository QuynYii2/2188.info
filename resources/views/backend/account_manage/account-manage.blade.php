@extends('backend.layouts.master')
@section('content')

    <div class="container-fluid table-account-manage" id="table-account-manage">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('home.Avatar') }}</th>
                    <th>{{ __('home.name') }}</th>
                    <th>{{ __('home.email') }}</th>
                    <th>{{ __('home.role') }}</th>
                    <th>{{ __('home.Loại hội viên') }}</th>
                    <th>{{ __('home.Status') }}</th>
                    <th>{{ __('home.Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($getAllUser as $user)
                    @php
                        $roleUsers = DB::table('role_user')
                        ->where('user_id', $user->id)
                        ->orderBy('role_id', 'asc')
                        ->get('role_id');
                       $role = "";
                       $isSeller = false;
                       $isBuyer = false;
                    foreach ($roleUsers as $item) {
                           switch ($item->role_id){
                               case 1: $role .= "Admin "; break;
                               case 2: $role .= "Seller "; $isSeller = true; break;
                               case 3: $role .= "Buyer"; $isBuyer = true; break;
                            }
                    }
                    @endphp
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ asset('storage/'.$user->image) }}" class="avatar-a"></td>
                        <td>
                                <a href="#">{{ $user->name }}</a>
                        </td>
                        <td><a href="#">{{ $user->email }}</a></td>
                        <td>{{ $role }}</td>
                        <td>{{ $user->member }}</td>
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
                            @if ($isSeller)
                                <a href="{{ route('account.show.shop', $user->id) }}" class="settings" title="Lock" data-toggle="tooltip"><i
                                            class="material-icons">&#xf05b;</i></a>
                            @endif
                            @if ($isBuyer)
                                <a href="{{ route('account.show.order', $user->id) }}" class="settings" title="Lock" data-toggle="tooltip"><i
                                            class="material-icons">&#xe8cc;</i></a>
                            @endif
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
             return confirm({{ __('home.Bạn có chắc chắn muốn xóa?') }})
        }
    </script>
@endsection
