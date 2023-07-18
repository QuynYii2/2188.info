@extends('frontend.layouts.master')

@section('title', 'Payment Register Member')

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card">
                <div class="form-title text-center pt-2">
                    <div class="title">Payment Register Member</div>
                </div>
                <h3 class="text-center">
                    Phí gia nhập hội viên {{$registerMember}}
                </h3>
                <div class="mt-5">
                    <div class="row p-5">
                        <br>
                        @php
                            $memberRegister = \App\Models\MemberRegisterInfo::where([
                                ['user_id', Auth::user()->id],
                                ['member', $registerMember]])->orderBy('created_at', 'desc')->first();
                        @endphp
                        <h5>Info</h5>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Fax</th>
                                <th scope="col">Company</th>
                                <th scope="col">Address</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$memberRegister->name}}</td>
                                <td>{{$memberRegister->phone}}</td>
                                <td>{{$memberRegister->fax}}</td>
                                <td>{{$memberRegister->code_business}}</td>
                                <td>{{$memberRegister->address}}</td>
                                <td>
                                    @if($memberRegister->status == \App\Enums\MemberRegisterInfoStatus::ACTIVE)
                                        <span class="text-success">PAID</span>
                                    @else
                                        <span class="text-danger">UNPAID</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @php
                            $memberRegisterSource = \App\Models\MemberRegisterPersonSource::where([
                                ['user_id', Auth::user()->id],
                                ['member_id', $memberRegister->id],
                                ['type', \App\Enums\MemberRegisterType::SOURCE]])->orderBy('created_at', 'desc')->first();
                        @endphp
                        <h5>Account Member Source</h5>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$memberRegisterSource->name}}</td>
                                <td>{{$memberRegisterSource->phone}}</td>
                                <td>{{$memberRegisterSource->email}}</td>
                                <td>{{$memberRegisterSource->status}}</td>
                            </tr>
                            </tbody>
                        </table>
                        @php
                            $memberRegisterRepresent = \App\Models\MemberRegisterPersonSource::where([
                                ['user_id', Auth::user()->id],
                                ['person', $memberRegisterSource->id],
                                ['type', \App\Enums\MemberRegisterType::REPRESENT]])->orderBy('created_at', 'desc')->first();
                        @endphp
                        <h5>Account Member Represent</h5>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$memberRegisterRepresent->name}}</td>
                                <td>{{$memberRegisterRepresent->phone}}</td>
                                <td>{{$memberRegisterRepresent->email}}</td>
                                <td>{{$memberRegisterRepresent->status}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-md-6 border">
                            <h5 class="text-center">Quyền lợi hội viên</h5>
                            <ol class="text-success">
                                <li>Tìm các sản phẩm</li>
                                <li>Quản lí và tìm kiếm giao dịch</li>
                                <li>Nhắn tin và quảng cáo sản phẩm</li>
                            </ol>
                        </div>
                        <div class="col-md-6 border">
                            <form method="post" action="{{route('payment.member')}}">
                                @csrf
                                <input hidden="" type="text" name="member_id" value="{{$memberRegister->id}}">
                                <input hidden="" type="text" name="role" value="{{$registerMember}}">
                                <h5 class="text-center">Mức giá</h5>
                                @if($registerMember == \App\Enums\RegisterMember::VENDOR)
                                    PRICE:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::VENDOR}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::VENDOR}}">
                                @elseif($registerMember == \App\Enums\RegisterMember::POWER_VENDOR)
                                    PRICE:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::POWER_VENDOR}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::POWER_VENDOR}}">
                                @elseif($registerMember == \App\Enums\RegisterMember::PRODUCTION)
                                    PRICE:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::PRODUCTION}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::PRODUCTION}}">
                                @else
                                    PRICE:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::POWER_PRODUCTION}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::POWER_PRODUCTION}}">
                                @endif
                                <div class="float-right mt-5">
                                    @if($memberRegister->status == \App\Enums\MemberRegisterInfoStatus::INACTIVE)
                                        <button type="submit" class="btn btn-warning">
                                            Payment now
                                        </button>
                                    @else
                                        <a href="{{route('show.success.payment.member', $registerMember)}}" class="btn btn-success">
                                            Review now
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script></script>

