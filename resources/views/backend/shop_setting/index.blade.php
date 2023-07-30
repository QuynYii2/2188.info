@extends('backend.layouts.master')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#payment-method" type="button" role="tab" aria-controls="home" aria-selected="true">Thiết lập phương thức thanh toán</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#transport-method" type="button" role="tab" aria-controls="profile" aria-selected="false">Thiết lập phương thức vận chuyển</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="payment-method" role="tabpanel" aria-labelledby="home-tab">
            <div class="col-sm-12 d-inline-block ">
                <label class="name" for="date_start">Hình thức thanh toán</label>
                <div class="dropdown-content" id="payment-dropdownList">
                    <form action="{{ route('setting.shop.payment.save') }}" method="post">
                        @csrf
                        @foreach($listPayment as $payment)
                            <label>
                                <input name="payment_method[]" type="checkbox" value="{{ $payment->id }}">
                                {{ $payment->name }}
                            </label>
                        @endforeach
                        <button type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="transport-method" role="tabpanel" aria-labelledby="profile-tab">
            <div class="form-group col-sm-12 d-inline-block">
                <label class="control-label small" for="date_start">Hình thức vận chuyển</label>
                <div class="dropdown-content" id="transport-dropdownList">
                    <form action="{{ route('setting.shop.transport.save') }}" method="post">
                        @csrf
                        @foreach($listTransport as $transport)
                            <label>
                                <input name="transport_method[]" type="checkbox" value="{{ $transport->id }}">
                                {{ $transport->name }}
                            </label>
                        @endforeach
                        <button type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
    </div>

    <script>
  
    </script>

@endsection
