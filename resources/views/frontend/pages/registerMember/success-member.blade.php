@extends('frontend.layouts.master')

@section('title', 'Payment Register Member')

@section('content')
    @php
        $trans = \App\Http\Controllers\TranslateController::getInstance();
    @endphp
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card">
                <div class="form-title text-center pt-2">
                    <div class="title">Payment Register Member</div>
                </div>
                <h3 class="text-center">
                    Gia nhập hội viên
                </h3>
                <div class="mt-5">
                    <div class="row p-5">
                        <br>
                        @php
                            $memberRegister = \App\Models\MemberRegisterInfo::where('id', $registerMember)->first();
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
                                <td>{{ $trans->translateText($memberRegister->name) }}</td>
                                <td>{{ $trans->translateText($memberRegister->phone) }}</td>
                                <td>{{ $trans->translateText($memberRegister->fax) }}</td>
                                <td>{{ $trans->translateText($memberRegister->code_business) }}</td>
                                <td>{{ $trans->translateText($memberRegister->address) }}</td>
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
                                ['member_id', $registerMember],
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
                                <td>{{ $trans->translateText($memberRegisterSource->name) }}</td>
                                <td>{{ $trans->translateText($memberRegisterSource->phone) }}</td>
                                <td>{{ $trans->translateText($memberRegisterSource->email) }}</td>
                                <td>{{ $trans->translateText($memberRegisterSource->status) }}</td>
                            </tr>
                            </tbody>
                        </table>
                        @php
                            $memberRegisterRepresent = \App\Models\MemberRegisterPersonSource::where([
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
                                <td>{{ $trans->translateText($memberRegisterRepresent->name) }}</td>
                                <td>{{ $trans->translateText($memberRegisterRepresent->phone) }}</td>
                                <td>{{ $trans->translateText($memberRegisterRepresent->email) }}</td>
                                <td>{{ $trans->translateText($memberRegisterRepresent->status) }}</td>
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
                            <p class="text-success small">Thanh toan thanh cong</p>
                            <div class="float-right mt-5">
                                <a href="{{route('home')}}" class="btn btn-success">
                                    Back to home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script></script>

