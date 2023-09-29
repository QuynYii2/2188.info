@extends('backend.layouts.master')

@section('content')

    <div class="container-fluid" id="table-account-manage">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('home.Avatar') }}</th>
                    <th>{{ __('home.Name') }}</th>
                    <th>{{ __('home.email') }}</th>
                    <th>{{ __('home.Status') }}</th>
                    <th>Create By</th>
                    <th>{{ __('home.Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listUsers as $users)

                    @php
                    $user = \App\Models\User::where('id', $users->user_id)->first();
                    $parentUser = \App\Models\User::where('id', $users->parent_user_id)->first('name');
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
                            @endif
                        </td>
                        <td>{{ $users->parent_user_id . ' - ' . $parentUser->name }}</td>
                        <td>
                            <a href="{{ route('staff.manage.delete', $user->id) }}" class="delete" onclick="return confirmDelete()" title="Delete" data-toggle="tooltip"><i
                                        class="material-icons">&#xE5C9;</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete() {
             return confirm("{{ __('home.Bạn có chắc chắn muốn xóa') }}")
        }
    </script>
@endsection
