<style>
    #tableMemberRepresent th, #tableMemberRepresent td {
        vertical-align: middle !important;
    }

    #tableMemberRepresent th {
        width: 250px !important;
    }

    #tableMemberRepresent td {
        width: 500px !important;
    }
</style>
@php
    $create = null;
    if(session('create')){
          $create =  session('create');
    }

@endphp
@if($memberPerson)
    <input type="text" class="d-none" id="inputCheckExitMember" value="{{$memberPerson->code}}">
@endif
<div class="container">
    <form class="p-3" action="{{route('register.member.represent')}}" method="post">
        @csrf
        <input type="text" class="form-control" name="person" value="{{ ($person) }}" hidden="">
        <div class="day_register title-input">Day register:</div>
        <div class="label_form">{{ __('home.full name') }} <span class="text-danger">*</span></div>
        <div class="form-group">
            <input type="text" class="form-control" id="name_en" name="name_en"
                   placeholder="{{ __('home.Name English') }}"
                   value="{{$create ? $create['name_en'] : old('name_en', $memberPerson ? $memberPerson->name_en : '')}}"
                   required>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="{{ __('home.Name Default') }}"
                   value="{{$create ? $create['name'] : old('', $memberPerson ? $memberPerson->name : '')}}"
                   required>
        </div>
        <div class="label_form">{{ __('home.ID') }} <span class="text-danger">*</span></div>
        <div class="form-row">
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="code" name="code"
                       placeholder="{{ __('home.ID') }}"
                       value="{{$create ? $create['code'] : old('', $memberPerson ? $memberPerson->code : '')}}"
                       required>
            </div>
            <div class="form-group col-md-3">
                <button id="buttonCheckID" type="button"
                        class="btn btn-secondary w-100" disabled>{{ __('home.Duplicate') }}</button>
            </div>
        </div>
        @if(!Auth::check())
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password" class="label_form">{{ __('home.Password') }} <span
                                class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="{{ __('home.Password') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="passwordConfirm" class="label_form">{{ __('home.Re-Password') }} <span
                                class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="passwordConfirm"
                           name="passwordConfirm" placeholder="{{ __('home.Re-Password') }}"
                           required>
                </div>
            </div>
        @endif
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phoneNumber" class="label_form">{{ __('home.Phone Number') }} <span
                            class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                       placeholder="{{ __('home.Phone Number') }}"
                       value="{{$create ? $create['phone'] : old('phone', $memberPerson  ? $memberPerson ->phone : '')}}"
                       required>
            </div>
            <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="checkBoxPhone">
                    <label class="form-check-label" for="checkBoxPhone">
                        {{ __('home.Apply notification SMS') }}
                    </label>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="email" class="label_form">{{ __('home.email') }} <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="{{ __('home.email') }}"
                       value="{{$create ? $create['email'] : old('email', $memberPerson  ? $memberPerson ->email : '')}}"
                       required>
            </div>
            <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="checkBoxEmail">
                    <label class="form-check-label" for="checkBoxEmail">
                        {{ __('home.Confirm apply notification Email') }}
                    </label>
                </div>
            </div>
        </div>
        <label for="sns_account" class="label_form">{{ __('home.SNS Account') }} <span
                    class="text-danger">*</span></label>
        <div class="form-group">
            <input type="text" class="form-control" id="sns_account" name="sns_account"
                   placeholder="{{ __('home.SNS Account') }}"
                   value="{{$create ? $create['sns_account'] : old('sns_account', $memberPerson  ? $memberPerson ->sns_account : '')}}"
                   required>
        </div>
        <div class="text-center">
            <button type="button" id="buttonRegister"
                    class="w-50 btn bg-member-primary mr-3 btn-register">{{ __('home.sign up') }}</button>
        </div>
        <input id="localeInput" name="locale" class="d-none">
        <input type="text" class="d-none" id="valueID">
        <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
    </form>
</div>
<script>
    function getDate() {
        let nowTime = new Date().toLocaleDateString('en-GB');
        $('#datetime_register').val(nowTime);
        let text = 'Day register: ' + nowTime;
        $('.day_register').text(text);
    }

    getDate();

    $(document).ready(function () {
        const memberInput = $('#code');
        let check = $('#inputCheckExitMember').val();
        if (!check) {
            submitBtn();
        } else {
            if (check == memberInput.val()) {
                submitBtnDefault();
            }
        }
        const valueInput = $('#valueID');

        memberInput.on('keyup', checkID);

        async function checkIDBtn() {
            await $('#buttonCheckID').on('click', function () {
                checkID();
                let message = localStorage.getItem('message');
                if (message) {
                    alert(message);
                }

                console.log(memberInput.val());

                let value = memberInput.val();

                // value = localStorage.getItem('valueInput');
                valueInput.val(value);
                if (!value) {
                    alert('Please enter member ID!')
                }
            })
        }

        checkIDBtn();

        memberInput.on('change', submitBtn);

        function submitBtn() {
            $('#buttonCheckID').attr('disabled', false);

            $('#buttonRegister').on('click', function () {
                // $('#formRegisterMember').trigger('submit');
                localStorage.removeItem('message');
                localStorage.removeItem('valueInput');
                let item = valueInput.val();
                if (!item || item == 'null' || item == '') {
                    alert('Please click button check ID!');
                } else {
                    localStorage.clear();
                    $('#btnSubmitFormRegister').trigger('click');
                }
            })
        }

        function submitBtnDefault() {
            $('#buttonRegister').on('click', function () {
                $('#btnSubmitFormRegister').trigger('click');
            })
        }
    })

    async function checkID() {
        $('#buttonCheckID').attr('disabled', false);
        let message;
        const memberInput = $('#code');
        let urlCheckID = `{{route('member.checkId')}}`;
        let code = memberInput.val();

        if (code) {
            await $.ajax({
                url: urlCheckID,
                method: 'POST',
                data: {
                    _token: `{{ csrf_token() }}`,
                    memberID: code,
                },
            })
                .done(function (response) {
                    message = response;
                    localStorage.setItem('message', message);
                    localStorage.setItem('valueInput', code);
                    // alert(message)
                })
                .fail(function (response) {
                    message = response.responseText;
                    localStorage.setItem('message', message);
                    localStorage.setItem('valueInput', null);
                    // alert(message);
                });
        } else {
            localStorage.setItem('message', 'Please enter member ID!');
            localStorage.setItem('valueInput', null);
            // alert('Please enter member ID!');
        }
    }
</script>