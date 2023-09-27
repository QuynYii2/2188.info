@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="start-page mb-3" style="margin-top: 150px">
        <div class="form-title text-center">
            <h3 style="font-size: 36px">{{ __('home.Employee registration') }}</h3>
        </div>
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="form-title text-center pt-2 solid-3x bg-member-green" style="font-size: 35px; font-weight: 600">
                <div class="title">{{ __('home.Employee registed manager') }}</div>
            </div>
            <div class="">
                {{--            <nav>--}}
                {{--                <ol class="breadcrumb">--}}
                {{--                    <li class="breadcrumb-item">{{ __('home.Classification of members') }}</li>--}}
                {{--                    <li class="breadcrumb-item">{{ __('home.Agree to terms') }}</li>--}}
                {{--                    <li class="breadcrumb-item">{{ __('home.Company registration') }}</li>--}}
                {{--                    <li class="breadcrumb-item">{{ __('home.Subscriber registration') }}</li>--}}
                {{--                    <li class="breadcrumb-item">{{ __('home.Representative registration') }}</li>--}}
                {{--                    <li class="breadcrumb-item active">{{ __('home.Register as member') }}</li>--}}
                {{--                </ol>--}}
                {{--            </nav>--}}
                <table class="table element-bordered align-middle">
                    <thead>
                    <tr>
                        <th rowspan="2" scope="col">{{ __('home.Responsibility') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.Position') }}</th>
                        <th colspan="2" scope="col">{{ __('home.Name') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.ID') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.Phone Number') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.email') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.SNS Account') }}</th>
                    </tr>
                    <tr>
                        <th scope="col">{{ __('home.Name English') }}</th>
                        <th scope="col">{{ __('home.Name Korea') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($memberRepresent)
                        <tr>
                            <td>{{ __('home.Representative member') }}</td>
                            <td>{{$memberRepresent->staff}}</td>
                            <td>{{$memberRepresent->name_en}}</td>
                            <td>{{$memberRepresent->name}}</td>
                            <td>{{$memberRepresent->code}}</td>
                            <td>{{$memberRepresent->phone}}</td>
                            <td>{{$memberRepresent->email}}</td>
                            <td>{{$memberRepresent->sns_account}}</td>
                        </tr>
                    @endif
                    @if($memberSource)
                        <tr>
                            <td>{{ __('home.Registered member') }}</td>
                            <td>{{$memberSource->staff}}</td>
                            <td>{{$memberSource->name_en}}</td>
                            <td>{{$memberSource->name}}</td>
                            <td>{{$memberSource->code}}</td>
                            <td>{{$memberSource->phone}}</td>
                            <td>{{$memberSource->email}}</td>
                            <td>{{$memberSource->sns_account}}</td>
                        </tr>
                    @endif
                    <tr class="bg-member-yellow">
                        <td colspan="6"
                            style="font-weight: 400; font-size: 18px">{{ __('home.Employee registed staff') }}</td>
                        <td colspan=2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalRegisterMore" style="font-weight: 400; font-size: 18px">
                                {{ __('home.Sign up for more') }}
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="2" scope="col">{{ __('home.Responsibility') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.Position') }}</th>
                        <th colspan="2" scope="col">{{ __('home.Name') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.ID') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.Phone Number') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.email') }}</th>
                        <th rowspan="2" scope="col">{{ __('home.SNS Account') }}</th>
                    </tr>
                    <tr>
                        <th scope="col">{{ __('home.Name English') }}</th>
                        <th scope="col">{{ __('home.Name Korea') }}</th>
                    </tr>
                    @php
                        if ($memberSource){
                          $user1 = \App\Models\User::where('email', $memberSource->email)->first();
                        }
                        $staffs = null;
                        if ($memberRepresent && $memberSource){
                            $user2 = \App\Models\User::where('email', $memberRepresent->email)->first();
                            $staffs = \App\Models\StaffUsers::where('parent_user_id', $user1->id)->orWhere('parent_user_id', $user2->id)->get();
                        }
                    @endphp
                    @if($staffs)
                        @if($staffs->isNotEmpty())
                            @foreach($staffs as $staff)
                                <tr>
                                    <td>{{$staff->phu_trach}}</td>
                                    <td>{{$staff->staff}}</td>
                                    <td>{{$staff->name_en}}</td>
                                    <td>{{$staff->name}}</td>
                                    <td>{{$staff->code}}</td>
                                    <td>{{$staff->phone}}</td>
                                    <td>{{$staff->email}}</td>
                                    <td>{{$staff->sns_account}}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                    <tr class="">
                        <td colspan="9" class="">
                            <a style="font-size: 32px; font-weight: 600"
                               href="{{route('show.register.member.logistic.congratulation', $memberRepresent->id)}}"
                               class="btn btn-success mt-3 mb-5">{{ __('home.apply') }}</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class=" mt-3 ml-1">
                    <div class="">

                    </div>
                    <div id="buttonRegisterMembership">

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalRegisterMembership" tabindex="-1" role="dialog"
                         aria-labelledby="modalRegisterMembershipLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="modalRegisterMembershipLabel">{{ __('home.Employee registration') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ __('home.Close') }}</button>
                                        <button type="button" class="btn btn-primary">{{ __('home.Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalRegisterMore" tabindex="-1" role="dialog"
                         aria-labelledby="modalRegisterMoreLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="modalRegisterMoreLabel">{{ __('home.Sign up for more') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ __('home.Close') }}</button>
                                        <button type="button" class="btn btn-primary">{{ __('home.Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            if (localStorage.getItem("register_membership")) {
                let html = '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalRegisterMembership">{{ __('home.Employee registration') }}</button>';
                $('#buttonRegisterMembership').empty().append(html);
            }
        })
    </script>
@endsection