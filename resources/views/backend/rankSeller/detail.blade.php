@php @endphp
@extends('backend.layouts.master')

@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Thêm mới mã giảm giá') }}</h5>
        </div>
        <div class="container">
            <form action="{{route('seller.rank.setup.update', $rankSeller->id)}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="percent">{{ __('home.Phần trăm giảm giá') }}</label>
                        <input type="number" min="1" max="100" class="form-control" name="percent" id="percent"
                               placeholder="60" value="{{$rankSeller->percent}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apply">{{ __('home.apply') }}</label>
                        <div class="multiselect">
                            <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                <select>
                                    <option>{{ __('home.Chọn rank áp dụng') }}</option>
                                </select>
                                <div class="overSelect"></div>
                            </div>
                            <div id="checkboxes" class="mt-1">
                                @foreach($levels as $level)
                                    <label class="ml-2" for="apply-{{$level}}">
                                        <input type="checkbox" id="apply-{{$level}}"
                                               name="apply-{{$level}}"
                                               value="{{$level}}"
                                               class="mr-2 p-3"/>
                                        {{$level}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <input id="rank_apply" hidden="" value="{{$rankSeller->apply}}">
                    <div class="form-group col-md-3">
                        <label for="percent">{{ __('home.Mã') }}</label>
                        <input type="text" class="form-control" disabled value="{{$rankSeller->code}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('home.Lưu') }}</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        var listIDs = document.getElementById('rank_apply').value
        $(document).ready(function () {
            myArray = listIDs.split(",");
            for (let i = 0; i < myArray.length; i++) {
                check(myArray[i])
            }

            function check(id) {
                document.getElementById("apply-" + id).checked = true;
            }
        })
    </script>
    <script>
        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    var checkboxes = document.getElementById("checkboxes");
                    var div = document.getElementById('div-click');
                    if (checkboxes.contains(e.target) || div.contains(e.target)) {
                        div.on('click', function () {
                            if (!expanded) {
                                checkboxes.style.display = "block";
                                expanded = true;
                            } else {
                                checkboxes.style.display = "none";
                                expanded = false;
                            }
                        });
                    } else {
                        checkboxes.style.display = "none";
                        expanded = false;
                    }
                })
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }
    </script>
@endsection
