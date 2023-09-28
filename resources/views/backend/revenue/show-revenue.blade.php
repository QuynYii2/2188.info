@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Doanh thu') }}</h5>
        </div>
    </div>

    <form method="post" action="{{route('revenues.filter')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="startDate">{{ __('home.từ ngày') }} :</label>
                <input class="form-control" type="date" id="startDate" name="startDate">
            </div>
            <div class="form-group col-md-3">
                <label for="endDate">{{ __('home.đến ngày') }} :</label>
                <input class="form-control" type="date" id="endDate" name="endDate">
            </div>
            @if($isAdmin && $arraySeller)
                <div class="form-group col-md-3">
                    <label for="inputState">{{ __('home.seller name') }}</label>
                    <select id="inputState" name="seller" class="form-control">
                        @for($i=0; $i<count($arraySeller); $i++)
                            @php
                                $user = \App\Models\User::find($arraySeller[$i])
                            @endphp
                            <option value="{{$arraySeller[$i]}}">{{$user->name}}</option>
                        @endfor
                    </select>
                </div>
            @endif
            <div class="form-group col-md-3">
                <label for="inputState">{{ __('home.Quốc gia') }}</label>
                <select id="inputState" name="location" class="form-control">
                    <option value="all">{{ __('home.All') }}</option>
                    <option value="vi">{{ __('home.VietNam') }}</option>
                    <option value="kr">{{ __('home.Korea') }}</option>
                    <option value="cn">{{ __('home.China') }}</option>
                    <option value="jp">{{ __('home.Japan') }}</option>
                </select>
            </div>
        </div>
        <a href="{{ route('revenues.excel') }}" class="btn btn-success">{{ __('home.Excel') }}</a>
        <button type="submit" class="btn btn-success">{{ __('home.search') }}</button>
        <a href="{{route('revenues.index')}}" class="btn btn-secondary">{{ __('home.Back') }}</a>
    </form>

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="th-sm">#</th>
            <th class="th-sm">{{ __('home.seller name') }}</th>
            <th class="th-sm">{{ __('home.Xếp hạng') }}</th>
            <th class="th-sm">{{ __('home.Quốc gia') }}</th>
            <th class="th-sm">{{ __('home.Ngày') }}</th>
            <th class="th-sm">{{ __('home.Doanh thu') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(!$revenues->isEmpty())
            @foreach($revenues as $item)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        @php
                            $user = \App\Models\User::find($item->seller_id);
                        @endphp
                        {{$user->name}}
                    </td>
                    <td>{{$item->rank}}</td>
                    <td>{{$item->location}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->revenue}}</td>

                </tr>
            @endforeach
            <hr>
        @endif
        </tbody>
    </table>
    <div class="container-fluid" style="text-align: end">
        Tổng doanh thu : {{$revenues->sum('revenue')}}
    </div>
    <script>
        $(document).ready(function() {
            $("#example").DataTable();
        });
    </script>
@endsection