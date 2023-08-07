@extends('frontend.layouts.profile')

@section('title', 'List Permission')

@section('sub-content')
    <?php
    $trans = \App\Http\Controllers\TranslateController::getInstance();
    ?>
    <div class="row mt-5 bg-white rounded">
        <div class="rounded pt-1 ml-5">
            <h5>{{ __('home.list permission') }}</h5>
        </div>
{{--        <div class="ml-5 float-right">--}}
{{--            @php--}}
{{--                use Illuminate\Support\Facades\Auth;--}}
{{--                use Illuminate\Support\Facades\DB;--}}

{{--                $roleUsers = DB::table('role_user')->where([['user_id', Auth::user()->id]])->get();--}}
{{--                $isAdmin = false;--}}

{{--                if (count($roleUsers) > 0){--}}
{{--                    foreach ($roleUsers as $roleUser){--}}
{{--                         $role = DB::table('roles')->where([['id', $roleUser->role_id]])->first() ;--}}
{{--                        if ($role->name == 'super_admin'){--}}
{{--                            $isAdmin = true;--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            @endphp--}}

{{--            @if($isAdmin === true)--}}
{{--                <form action="{{route('permission.down.rank')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    <button class="btn btn-danger" type="submit">Reset Rank</button>--}}
{{--                </form>--}}
{{--            @endif--}}
{{--        </div>--}}
        <div class="border-bottom"></div>
    </div>

    <div class="row bg-white mt-3">
        <table class="table table-bordered">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Permission Name</th>
                <th scope="col">Activation Date</th>
                <th scope="col">Period</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $userPer)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                    @php
                        $per = \App\Models\Permission::find($userPer->permission_id);
                    @endphp
                    <td class="text-center">{{ $tran->translateText($per->name) }}</td>
                    <td class="text-center">{{ $tran->translateText($userPer->created_at) }}</td>
                    <td class="text-center">
                        @php
                            $timeLevel = \App\Models\TimeLevelTable::where('permission_user_id', $userPer->id)->first();
                        @endphp
                        @if($timeLevel == null)
                            <span class="text-uppercase">infinite</span>
                        @else
                            {{ $tran->translateText($timeLevel->duration) }}year
                        @endif
                    </td>
                    <td class="text-center">{{ $tran->translateText($userPer->status) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
