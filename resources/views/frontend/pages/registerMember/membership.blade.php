@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container">
        <h3 class="text-center">{{ __('home.Employee registration') }}</h3>
        <div class="container mt-3">
            <h5 class="">
                {{ __('home.Registration order') }}:
            </h5>
            <br>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('home.Classification of members') }}</li>
                    <li class="breadcrumb-item">{{ __('home.Agree to terms') }}</li>
                    <li class="breadcrumb-item">{{ __('home.Company registration') }}</li>
                    <li class="breadcrumb-item">{{ __('home.Subscriber registration') }}</li>
                    <li class="breadcrumb-item">{{ __('home.Representative registration') }}</li>
                    <li class="breadcrumb-item active">{{ __('home.Register as member') }}</li>
                </ol>
            </nav>
            <h5 class="text-center mt-3">{{ __('home.List of registered managers') }}</h5>
            <table class="table border">
                <thead>
                <tr>
                    <th scope="col">{{ __('home.Responsibility') }}</th>
                    <th scope="col">{{ __('home.Position') }}</th>
                    <th scope="col">{{ __('home.Name English') }}</th>
                    <th scope="col">{{ __('home.Name Korea') }}</th>
                    <th scope="col">{{ __('home.ID') }}</th>
                    <th scope="col">{{ __('home.Phone Number') }}</th>
                    <th scope="col">{{ __('home.email') }}</th>
                    <th scope="col">{{ __('home.SNS Account') }}</th>
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
                </tbody>
            </table>
            <div class="row mt-3 border ml-1">
                <div class="col-md-4">

                </div>
                <div class="col-md-4" id="buttonRegisterMembership">

                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalRegisterMembership" tabindex="-1" role="dialog"
                     aria-labelledby="modalRegisterMembershipLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalRegisterMembershipLabel">{{ __('home.Employee registration') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
                                    <button type="button" class="btn btn-primary">{{ __('home.Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegisterMore">
                        {{ __('home.Sign up for more') }}
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalRegisterMore" tabindex="-1" role="dialog"
                     aria-labelledby="modalRegisterMoreLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalRegisterMoreLabel">{{ __('home.Sign up for more') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
                                    <button type="button" class="btn btn-primary">{{ __('home.Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('show.register.member.congratulation', $memberRepresent->id)}}"
               class="btn btn-success mt-3 mb-5">{{ __('home.apply') }}</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            if (localStorage.getItem("register_membership")) {
                let html = '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalRegisterMembership">{{ __('home.Employee registration') }}</button>';
                $('#buttonRegisterMembership').empty().append(html);
            }
        })
    </script>
@endsection