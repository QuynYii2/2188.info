@extends('frontend.layouts.profile')

@section('title', 'List Permission')

@section('sub-content')
    <div class="row mt-5 bg-white rounded">
        <div class="row  rounded pt-1 ml-5">
            <h5>{{ __('home.list permission') }}</h5>
        </div>
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
                    <td class="text-center">{{$per->name}}</td>
                    <td class="text-center">{{$userPer->created_at}}</td>
                    <td class="text-center">
                        @php
                        $timeLevel = \App\Models\TimeLevelTable::where('permission_user_id', $userPer->id)->first();
                        @endphp
                        @if($timeLevel == null)
                            <span class="text-uppercase">infinite</span>
                        @else
                            {{$timeLevel->duration}} year
                        @endif
                    </td>
                    <td class="text-center">{{$userPer->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
