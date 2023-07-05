@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Doanh thu</h5>
        </div>
    </div>

    <form method="post" action="{{route('revenues.filter')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="startDate">Từ ngày :</label>
                <input class="form-control" type="date" id="startDate" name="startDate">
            </div>
            <div class="form-group col-md-3">
                <label for="endDate">Đến ngày :</label>
                <input class="form-control" type="date" id="endDate" name="endDate">
            </div>
{{--            <div class="form-group col-md-3">--}}
{{--                <label for="inputState">Quốc gia</label>--}}
{{--                <select id="inputState" class="form-control">--}}
{{--                    <option>Việt Nam</option>--}}
{{--                    <option>Trung Quốc</option>--}}
{{--                    <option>Hàn Quốc</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            @if($isAdmin)
                <div class="form-group col-md-3">
                    <label for="inputState">Seller name</label>
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
        </div>
        <button type="submit" class="btn">Export excel/pdf</button>
        <button type="submit" class="btn btn-success">Sign in</button>
        <a href="{{route('revenues.index')}}" class="btn btn-secondary">Back</a>
    </form>

    <div class="card-body p-0 mt-3">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Seller name</th>
                    <th>Xếp hạng</th>
                    <th>Ngày</th>
                    <th>Doanh thu</th>
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
                            <td>{{$item->date}}</td>
                            <td>{{$item->revenue}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection