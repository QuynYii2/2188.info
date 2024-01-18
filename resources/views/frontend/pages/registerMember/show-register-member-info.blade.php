@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="container">
        <div class="start-page mb-3">
            <div class="background container-fluid pt-3 justify-content-center pb-3">
                <div class="form-title text-center pt-2 pb-3 ">
                    @if($member->name == \App\Enums\RegisterMember::BUYER)
                        <div class="title text-primary">{{ __('auth.Register member buyer') }}</div>
                    @elseif($member->name == \App\Enums\RegisterMember::TRUST)
                        <div class="title text-primary">{{ __('auth.Register member trust') }}</div>
                    @else
                        <div class="title text-primary">{{ __('auth.Register member logistic') }}</div>
                    @endif
                </div>
                @php
                    $create = null;
                    if(session('create')){
                          $create =  session('create');
                    }

                @endphp
                <div>
                    @if($member->name == \App\Enums\RegisterMember::BUYER)
                        @include('frontend.pages.registerMember.buyer')
                    @else
                        @include('frontend.pages.registerMember.more-member-other')
                    @endif
                    <h2 id="result"></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modal-addressLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modalAddress">
            <div class="modal-content modalAddressContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.address') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 65vh; overflow-y: auto">
                    @include('frontend.pages.registerMember.regionAddress')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                            onclick="handleSelectRegion()">{{ __('home.save changes') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.inputCheckboxCategory').on('click', function () {
                let count = document.querySelectorAll('.inputCheckboxCategory:checked').length
                if (count > 3) {
                    $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', true);
                } else {
                    $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', false);
                }
            })

            $('.form-group.address-above').on('click', function () {
                whereSelectRegion = 0;
            });

            $('.form-group.address-below').on('click', function () {
                whereSelectRegion = 1;
            });
        })

        function getDate() {
            let nowTime = new Date().toLocaleDateString('en-GB');
            $('#datetime_register').val(nowTime);
            let text = `{{ __('home.Day register') }}` + ': ' + nowTime;
            $('.day_register').text(text);
        }

        getDate();
    </script>
    <script>
        var expanded = false, expanded1 = false, expanded2 = false;

        function showCheckboxes() {
            var code_1 = document.getElementById("code_1");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    var code_1_item = document.getElementById('code_1_item');
                    if (code_1.contains(e.target) || code_1_item.contains(e.target)) {
                        $('#code_1_item').on('click', function () {
                            if (!expanded) {
                                code_1.style.display = "block";
                                expanded = true;
                            } else {
                                code_1.style.display = "none";
                                expanded = false;
                            }
                        });
                    } else {
                        code_1.style.display = "none";
                        expanded = false;
                    }
                })
                code_1.style.display = "block";
                expanded = true;
            } else {
                code_1.style.display = "none";
                expanded = false;
            }
        }

        function showCheckboxes1() {
            var code_3 = document.getElementById("code_3");
            if (!expanded1) {
                window.addEventListener('click', function (e) {
                    let code_3_item = document.getElementById('code_3_item');
                    if (code_3.contains(e.target) || code_3_item.contains(e.target)) {
                        $('#code_3_item').on('click', function () {
                            if (!expanded1) {
                                code_3.style.display = "block";
                                expanded1 = true;
                            } else {
                                code_3.style.display = "none";
                                expanded1 = false;
                            }
                        });
                    } else {
                        code_3.style.display = "none";
                        expanded1 = false;
                    }
                })
                code_3.style.display = "block";
                expanded1 = true;
            } else {
                code_3.style.display = "none";
                expanded1 = false;
            }
        }

        function showCheckboxes2() {
            var code_2 = document.getElementById("code_2");
            if (!expanded2) {
                window.addEventListener('click', function (e) {
                    let code_2_item = document.getElementById('code_2_item');
                    if (code_2.contains(e.target) || code_2_item.contains(e.target)) {
                        $('#code_2_item').on('click', function () {
                            if (!expanded2) {
                                code_2.style.display = "block";
                                expanded2 = true;
                            } else {
                                code_2.style.display = "none";
                                expanded2 = false;
                            }
                        });
                    } else {
                        code_2.style.display = "none";
                        expanded2 = false;
                    }
                })
                code_2.style.display = "block";
                expanded2 = true;
            } else {
                code_2.style.display = "none";
                expanded2 = false;
            }
        }
    </script>
@endsection



