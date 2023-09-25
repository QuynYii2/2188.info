<table class="table element-bordered align-middle" align="center">
    <form class="p-3" action="{{route('register.member.source')}}" method="post">
        @csrf
        <tbody>
        <tr>
            <th scope="row">
                <label for="datetime_register">{{ __('home.Day register') }}</label>
            </th>
            <td colspan="4">
                <input type="text" class="form-control" id="datetime_register"
                       name="datetime_register" disabled>
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label for="position">{{ __('home.Position') }}</label>
            </th>
            @if(!Auth::check())
                <td colspan="4">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" name="checkMember">
                            <label class="form-check-label" for="gridCheck">
                                {{ __('home.Checkbox compare source and represent') }}
                            </label>
                        </div>
                    </div>
                </td>
            @endif
        </tr>
        <tr>
            <th>
                <label for="position">{{ __('home.Position') }}</label>
            </th>
            <td>
                <input type="text" class="form-control" id="position" name="position"
                       placeholder="{{ __('home.Position') }}"
                       value="{{ $memberPersonSource ? $memberPersonSource->position : ''}}" required>
            </td>
            <th>
                <label for="rank">{{ __('home.Rank') }}</label>
            </th>
            <td>
                <input type="text" class="form-control" id="rank" name="rank"
                       placeholder="{{ __('home.Rank') }}"
                       value="{{$memberPersonSource ? $memberPersonSource->rank : ''}}"
                       required>
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label for="name_en">{{ __('home.full name') }}</label>
            </th>
            <th>
                <label>{{ __('home.Name English') }}</label>
            </th>
            <td colspan="3">
                <input type="text" class="form-control" id="name_en" name="name_en"
                       placeholder="{{ __('home.Name English') }}"
                       value="{{$memberPersonSource ? $memberPersonSource->name_en : ''}}" required>
            </td>
        </tr>
        <tr>
            <th>
                <label>{{ __('home.Name Default') }}</label>
            </th>
            <td colspan="3">
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="{{ __('home.Name Default') }}"
                       value="{{$memberPersonSource ? $memberPersonSource->name : ''}}" required>
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label for="code">{{ __('home.ID') }}</label>
            </th>
            <td rowspan="2">
                <input type="text" class="form-control" id="code" name="code"
                       placeholder="{{ __('home.ID') }}" value="{{$memberPersonSource ? $memberPersonSource->code : ''}}" required>
            </td>
            <th rowspan="2">
                <label for="password">{{ __('home.Duplicate') }}</label>
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
        <tr>
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
        <tr>
            <th rowspan="2">
                <label>{{ __('home.Phone Number') }}</label>
            </th>
            <td colspan="2">
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                       placeholder="{{ __('home.Phone Number') }}"
                       value="{{$memberPersonSource ? $memberPersonSource->phone : ''}}"
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
            <td colspan="4">
                <label for="checkBoxPhone">{{ __('home.Confirm apply notification SMS') }}</label>
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label>{{ __('home.email') }}</label>
            </th>
            <td colspan="2">
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="{{ __('home.email') }}"
                       value="{{$memberPersonSource ? $memberPersonSource->email : ''}}"
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
            <td colspan="4">
                <label for="checkBoxEmail">{{ __('home.Confirm apply notification Email') }}</label>
            </td>
        </tr>
        <tr>
            <th>
                <label for="sns_account">{{ __('home.SNS Account') }}</label>
            </th>
            <td colspan="4">
                <input type="text" class="form-control" id="sns_account" name="sns_account"
                       placeholder="{{ __('home.SNS Account') }}"
                       value="{{$memberPersonSource ? $memberPersonSource->sns_account : ''}}" required>
            </td>
        </tr>
        <tr class="">
            <td colspan="6" class="bg-member-green">
                <button type="button" id="buttonRegister"
                        class="btn btn-warning mr-3 btn-register">{{ __('home.sign up') }}</button>
            </td>
        </tr>
        <input type="text" class="form-control" name="member" value="{{$member}}" hidden="">
        </tbody>
        <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
    </form>
</table>
<script>
    function getDate() {
        let nowTime = new Date().toLocaleDateString('en-GB');
        $('#datetime_register').val(nowTime);
    }

    getDate();

    $(document).ready(function () {
        $('#buttonRegister').on('click', function () {
            // $('#formRegisterMember').trigger('submit');
            $('#btnSubmitFormRegister').trigger('click');
        })
    })
</script>