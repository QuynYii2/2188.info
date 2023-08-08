@extends('frontend.layouts.master')

@section('title', 'Verify Member')

@section('content')
    @php

    @endphp
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">Xac thuc thông tin</div>
                </div>
                <div class="mt-5">
                    <form class="p-3" action="{{route('verify.register.member')}}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" disabled required value="{{ ($email) }}">
                            </div>
                            <input type="text" class="form-control" name="processEmail" hidden="" value="{{ ($email) }}" required>
                            <div class="form-group col-md-4">
                                <label for="code">Verify Code</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

