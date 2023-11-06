<style>
    #tableMemberRepresent th, #tableMemberRepresent td {
        vertical-align: middle !important;
    }
</style>
@php
    $create = null;
    if(session('create')){
          $create =  session('create');
    }

@endphp
<table class="table element-bordered" id="tableMemberRepresent">
    <form class="p-3" action="{{route('register.member.represent')}}" method="post">
        @csrf
        <input type="text" class="form-control" name="person" value="{{ ($person) }}" hidden="">
        <tbody>
        <tr class="text-center">
            <th scope="row">
                <label for="datetime_register">{{ __('home.Day register') }}</label>
            </th>
            <td colspan="6">
                <input type="text" class="form-control" id="datetime_register"
                       name="datetime_register" disabled>
            </td>
        </tr>
        <tr class="text-center">
            <th rowspan="2">
                <label for="name_en">{{ __('home.full name') }}</label>
            </th>
            <th>
                <label>{{ __('home.Name English') }}</label>
            </th>
            <td colspan="5">
                <input type="text" class="form-control" id="name_en" name="name_en"
                       placeholder="{{ __('home.Name English') }}"
                       value="{{$create ? $create['name_en'] : old('name_en', $memberPerson ? $memberPerson->name_en : '')}}"
                       required>
            </td>
        </tr>
        <tr class="text-center">
            <th>
                <label>{{ __('home.Name Default') }}</label>
            </th>
            <td colspan="5">
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="{{ __('home.Name Default') }}"
                       value="{{$create ? $create['name'] : old('', $memberPerson ? $memberPerson->name : '')}}"
                       required>
            </td>
        </tr>
        <tr class="text-center">
            <th rowspan="2">
                <label for="code">{{ __('home.ID') }}</label>
            </th>
            <td rowspan="2" colspan="3">
                <input type="text" class="form-control" id="code" name="code"
                       placeholder="{{ __('home.ID') }}"
                       value="{{$create ? $create['code'] : old('', $memberPerson ? $memberPerson->code : '')}}"
                       required>
            </td>
            <th rowspan="2">
                <button id="buttonCheckID" type="button" class="btn btn-secondary">{{ __('home.Duplicate') }}</button>
            </th>
            @if(!Auth::check())
                <th>
                    <label for="password">{{ __('home.Password') }}</label>
                </th>
                <td>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="{{ __('home.Password') }}" required>
                </td>
            @endif
        </tr>
        <tr class="text-center">
            @if(!Auth::check())
                <th>
                    <label for="passwordConfirm">{{ __('home.Re-Password') }}</label>
                </th>
                <td>
                    <input type="password" class="form-control" id="passwordConfirm"
                           name="passwordConfirm" placeholder="{{ __('home.Re-Password') }}"
                           required>
                </td>
            @endif
        </tr>
        <tr class="text-center">
            <th rowspan="2">
                <label>{{ __('home.Phone Number') }}</label>
            </th>
            <td colspan="4">
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                       placeholder="{{ __('home.Phone Number') }}"
                       value="{{$create ? $create['phone'] : old('phone', $memberPerson ? $memberPerson->phone : '')}}"
                       required>
            </td>
            <td>
                <input type="checkbox" id="checkBoxPhone">
            </td>
            <td>
                <label for="checkBoxPhone">{{ __('home.Apply notification SMS') }}</label>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <label for="checkBoxPhone">{{ __('home.Confirm apply notification SMS') }}</label>
            </td>
        </tr>
        <tr class="text-center">
            <th rowspan="2">
                <label>{{ __('home.email') }}</label>
            </th>
            <td colspan="4">
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="{{ __('home.email') }}"
                       value="{{$create ? $create['email'] : old('email', $memberPerson ? $memberPerson->email : '')}}"
                       required>
            </td>
            <td>
                <input type="checkbox" id="checkBoxEmail">
            </td>
            <td>
                <label for="checkBoxEmail">{{ __('home.Apply notification Email') }}</label>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <label for="checkBoxEmail">{{ __('home.Confirm apply notification Email') }}</label>
            </td>
        </tr>
        <tr class="text-center">
            <th>
                <label for="sns_account">{{ __('home.SNS Account') }}</label>
            </th>
            <td colspan="6">
                <input type="text" class="form-control" id="sns_account" name="sns_account"
                       placeholder="{{ __('home.SNS Account') }}"
                       value="{{$create ? $create['sns_account'] : old('sns_account', $memberPerson ? $memberPerson->sns_account : '')}}"
                       required>
            </td>
        </tr>
        <tr class="text-center">
            <td colspan="7" class="bg-member-green">
                <button type="button" id="buttonRegister"
                        class="btn btn-warning mr-3 btn-register">{{ __('home.Confirm') }}</button>
            </td>
        </tr>

        </tbody>
        <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
    </form>
    <input type="text" class="d-none" id="valueID">
</table>
<script>
    function getDate() {
        let nowTime = new Date().toLocaleDateString('en-GB');
        $('#datetime_register').val(nowTime);
    }

    getDate();

    let message;
    const memberInput = $('#code');
    const valueInput = $('#valueID');
    $(document).ready(function () {
        memberInput.on('keyup', checkID);

        $('#buttonCheckID').on('click', function () {
            checkID();
            let message = localStorage.getItem('message');
            alert(message);
            let value = localStorage.getItem('valueInput');
            valueInput.val(value);
        })

        $('#buttonRegister').on('click', function () {
            // $('#formRegisterMember').trigger('submit');
            let item = valueInput.val();
            if (!item || item == 'null' || item == '') {
                alert('Please click button check ID!');
            } else {
                localStorage.clear();
                $('#btnSubmitFormRegister').trigger('click');
            }
        })

    })

    async function checkID() {
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