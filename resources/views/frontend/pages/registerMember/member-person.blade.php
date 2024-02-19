<style>
    #tableMemberPerson th, #tableMemberPerson td {
        vertical-align: middle !important;
    }

    #tableMemberPerson th {
        width: 250px !important;
    }

    #tableMemberPerson td {
        width: 500px !important;
    }
</style>
@php
    $create = null;
    if(session('create')){
          $create =  session('create');
    }

@endphp
@if($memberPersonSource)
    <input type="text" class="d-none" id="inputCheckExitMember" value="{{$memberPersonSource->code}}">
@endif

<div class="">
    <form autocomplete="off" class="p-3 form_info-member-person" action="{{route('register.member.source')}}"
          method="post"
          id="formRegisterMember">
        @csrf
        <div class="day_register title-input">{{ __('home.Day register') }}:</div>
        <div class="label_form">{{ __('auth.Position') }} <span class="text-danger">*</span></div>
        <div class="form-row">
            @if(!Auth::check())
                <div class="form-group col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="checkMember">
                        <label class="form-check-label" for="gridCheck">
                            {{ __('home.Checkbox compare source and represent') }}
                        </label>
                    </div>
                </div>
            @endif
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="position" name="position"
                       placeholder="{{ __('auth.Position') }}"
                       value="{{ $create ? $create['position'] : old('position', $memberPersonSource ? $memberPersonSource->position : '')}}"
                       required>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="rank" name="rank"
                       placeholder="{{ __('auth.Work') }}"
                       value="{{$create ? $create['rank'] : old('rank', $memberPersonSource ? $memberPersonSource->rank : '')}}"
                       required>
            </div>
        </div>
        <div class="label_form">{{ __('home.full name') }} <span class="text-danger">*</span></div>
        <div class="form-group">
            <input type="text" class="form-control" id="name_en" name="name_en"
                   placeholder="{{ __('auth.Name English') }}"
                   value="{{$create ? $create['name_en'] : old('name_en', $memberPersonSource ? $memberPersonSource->name_en : '')}}"
                   required>
            <input type="text" class="form-control mt-2" id="name" name="name"
                   placeholder="{{ __('auth.Name Default') }}"
                   value="{{$create ? $create['name'] : old('name', $memberPersonSource ? $memberPersonSource->name : '')}}"
                   required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phoneNumber" class="label_form">{{ __('auth.Cell phone number') }} <span
                            class="text-danger">*</span></label>
                <input type="number" class="form-control" id="phoneNumber" name="phoneNumber"
                       placeholder="{{ __('auth.Please enter only numbers') }}"
                       value="{{$create ? $create['phone'] : old('phone', $memberPersonSource ? $memberPersonSource->phone : '')}}"
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
                <label for="email" class="label_form">{{ __('home.email') }} <span class="text-danger">*</span>
                    <span class="small">{{ __('auth.If you lose your ID or password, a temporary number will be sent to the email address registered here') }}</span>
                </label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="{{ __('home.email') }}"
                           value="{{$create ? $create['email'] : old('email', $memberPersonSource ? $memberPersonSource->email : '')}}"
                           required>
                    <button type="button" id="btnChecking"
                            class="btn btn-outline-warning">{{ __('auth.Check email') }}</button>
                </div>
            </div>
            <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="checkBoxEmail">
                    <label class="form-check-label" for="checkBoxEmail">
                        {{ __('auth.Receive message') }}
                    </label>
                </div>
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
        <label for="sns_account" class="label_form">{{ __('home.SNS Account') }}</label>
        <div class="form-group">
            <input type="text" class="form-control" id="sns_account" name="sns_account"
                   placeholder="{{ __('home.SNS Account') }}"
                   value="{{$create ? $create['sns_account'] : old('sns_account', $memberPersonSource ? $memberPersonSource->sns_account : '')}}">
        </div>
        <div class="text-center">
            <p class="text-center text-danger" id="messageValid">{{ __('auth.Please check email to continue...') }}</p>
            <button type="button" id="buttonRegisterPerson"
                    class="w-50 btn bg-member-primary mr-3 btn-register">{{ __('home.next') }}</button>
        </div>
        <input type="text" class="form-control" name="member_id" value="{{$member_id}}" hidden="">
        <input id="localeInput" name="locale" class="d-none">
        <input type="text" class="d-none" id="valueID">
        <button class="d-none" id="btnSubmitFormRegisterPerson" type="submit">Done</button>
    </form>
</div>
<script>
    function getDate() {
        let nowTime = new Date().toLocaleDateString('en-GB');
        $('#datetime_register').val(nowTime);
        let text = `{{ __('home.Day register') }}` + ': ' + nowTime;
        $('.day_register').text(text);
    }

    getDate();

    $(document).ready(function () {
        $('#buttonRegisterPerson').on('click', function () {
            $('#btnSubmitFormRegisterPerson').trigger('click');
        })
        {{--$('.navlink').on('click', function () {--}}
        {{--    loadNav();--}}
        {{--})--}}

        {{--function checkActive() {--}}
        {{--    let element = document.getElementById("nav-2");--}}
        {{--    if (element.classList.contains('show')) {--}}
        {{--        loadNav();--}}
        {{--    }--}}
        {{--}--}}

{{--        @if(Auth::check())--}}
{{--        checkActive();--}}
{{--        @else--}}
{{--        loadNav();--}}
{{--        @endif--}}

        {{--function loadNav() {--}}
        {{--    const memberInput = $('#code');--}}
        {{--    let check = $('#inputCheckExitMember').val();--}}
        {{--    if (!check) {--}}
        {{--        submitBtn();--}}
        {{--    } else {--}}
        {{--        if (check == memberInput.val()) {--}}
        {{--            submitBtnDefault();--}}
        {{--        }--}}
        {{--    }--}}
        {{--    const valueInput = $('#valueID');--}}

        {{--    memberInput.on('keyup', checkID);--}}

        {{--    async function checkIDBtn() {--}}
        {{--        await $('#buttonCheckID').on('click', function () {--}}
        {{--            checkID();--}}
        {{--            let message = localStorage.getItem('message');--}}
        {{--            if (message) {--}}
        {{--                alert(message);--}}
        {{--            }--}}

        {{--            console.log(memberInput.val());--}}

        {{--            let value = memberInput.val();--}}

        {{--            // value = localStorage.getItem('valueInput');--}}
        {{--            valueInput.val(value);--}}
        {{--            if (!value) {--}}
        {{--                alert('Please enter member ID!')--}}
        {{--            }--}}
        {{--        })--}}
        {{--    }--}}

        {{--    checkIDBtn();--}}

        {{--    memberInput.on('change', submitBtn);--}}

        {{--    function submitBtn() {--}}
        {{--        $('#buttonCheckID').attr('disabled', false);--}}

        {{--        $('#buttonRegisterPerson').on('click', function () {--}}
        {{--            // $('#formRegisterMember').trigger('submit');--}}
        {{--            localStorage.removeItem('message');--}}
        {{--            localStorage.removeItem('valueInput');--}}
        {{--            let item = valueInput.val();--}}
        {{--            if (!item || item == 'null' || item == '') {--}}
        {{--                alert('Please click button check ID!');--}}
        {{--            } else {--}}
        {{--                $('#btnSubmitFormRegisterPerson').trigger('click');--}}
        {{--            }--}}
        {{--        })--}}
        {{--    }--}}

        {{--    function submitBtnDefault() {--}}
        {{--        $('#buttonRegisterPerson').on('click', function () {--}}
        {{--            $('#btnSubmitFormRegisterPerson').trigger('click');--}}
        {{--        })--}}
        {{--    }--}}

        {{--    async function checkID() {--}}
        {{--        $('#buttonCheckID').attr('disabled', false);--}}
        {{--        let message;--}}
        {{--        const memberInput = $('#code');--}}
        {{--        let urlCheckID = `{{route('member.checkId')}}`;--}}
        {{--        let code = memberInput.val();--}}

        {{--        if (code) {--}}
        {{--            await $.ajax({--}}
        {{--                url: urlCheckID,--}}
        {{--                method: 'POST',--}}
        {{--                data: {--}}
        {{--                    _token: `{{ csrf_token() }}`,--}}
        {{--                    memberID: code,--}}
        {{--                },--}}
        {{--            })--}}
        {{--                .done(function (response) {--}}
        {{--                    message = response;--}}
        {{--                    localStorage.setItem('message', message);--}}
        {{--                    localStorage.setItem('valueInput', code);--}}
        {{--                    // alert(message)--}}
        {{--                })--}}
        {{--                .fail(function (response) {--}}
        {{--                    message = response.responseText;--}}
        {{--                    localStorage.setItem('message', message);--}}
        {{--                    localStorage.setItem('valueInput', null);--}}
        {{--                    // alert(message);--}}
        {{--                });--}}
        {{--        } else {--}}
        {{--            localStorage.setItem('message', 'Please enter member ID!');--}}
        {{--            localStorage.setItem('valueInput', null);--}}
        {{--            // alert('Please enter member ID!');--}}
        {{--        }--}}
        {{--    }--}}
        {{--}--}}
    })
</script>
<script>
    let index = 0;
    let buttonRegister = $('#buttonRegisterPerson');
    let messageValid = $('#messageValid');

    $(document).ready(function () {
        handleClickBtnAndShowValid(index);

        $('#btnChecking').click(function () {
            handleCheckEmail();
        })
    })

    async function handleCheckEmail() {
        let checkUrl = `{{ route('api.checking.email.all') }}`;
        let email = $('#email').val();
        if (!email) {
            alert('Please enter your email!');
            return;
        }
        await $.ajax({
            url: checkUrl,
            method: 'POST',
            data: {
                email: email
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response, textStatus, jqXHR) {
                if (jqXHR.status === 200) {
                    index = 1;
                    alert(response.message);
                    handleClickBtnAndShowValid(index);
                } else {
                    index = 0;
                    alert(response.message);
                    handleClickBtnAndShowValid(index);
                }
            },
            error: function (error) {
                console.log(error);
                index = 0;
                alert(error.responseJSON.message);
                handleClickBtnAndShowValid(index);
            }
        });
    }

    function handleClickBtnAndShowValid(index) {
        if (index === 0) {
            messageValid.removeClass('d-none');
            buttonRegister.prop('disabled', true);
        } else {
            messageValid.addClass('d-none');
            buttonRegister.prop('disabled', false);
        }
    }
</script>