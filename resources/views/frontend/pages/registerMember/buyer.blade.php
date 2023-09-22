<table class="table element-bordered align-middle" align="center">
    <form action="{{route('register.member.buyer')}}" method="post"
      enctype="multipart/form-data">
    @csrf
    <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
    <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
    <tbody>
        <tr>
            <th scope="row">
                <label for="datetime_register">{{ __('home.Day register') }}: </label>
            </th>
            <td colspan="2">
                <input type="text" class="form-control" id="datetime_register"
                       name="datetime_register" disabled>
            </td>
            <th scope="row">
                <label for="number_clearance"> {{ __('home.Number clearance') }}: </label>
            </th>
            <td>
                <input type="number" class="form-control" id="number_clearance"
                       value="{{ $exitsMember ? $exitsMember->number_clearance : old('number_clearance') }}"
                       name="number_clearance">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="name_en">{{ __('home.Full Name') }}:</label>
            </th>
            <td colspan="4">
                <input type="text" class="form-control mb-2" id="name_en" name="name_en" value="{{ __('home.English only') }}" required>
                <input type="text" class="form-control" id="name" name="name" value="{{ __('home.Local language') }}" required>
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <label for="code">{{ __('home.ID') }} :</label>
            </th>
            <td colspan="4" class="item">
                <input type="text" class="form-control" id="code" name="code" required>
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <label for="password">{{ __('home.Password') }}:</label>
            </th>
            <td colspan="4" class="item">
                <input type="password" class="form-control" id="password" name="password" required>
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <label for="passwordConfirm">{{ __('home.Password') }}{{ __('home.Confirm') }}:</label>
            </th>
            <td colspan="4" class="item">
                <input type="password" class="form-control" id="passwordConfirm"
                       name="passwordConfirm"
                       required>
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <label for="phoneNumber">{{ __('home.phone number') }}:</label>
            </th>
            <td colspan="2" class="item">
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                       required>
            </td>
            <td colspan="3" class="item">
                <input type="checkbox" value="1" required>
                <span>{{ __('home.Allow receiving notifications via SMS message') }}</span>
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <label for="email">{{ __('home.email') }}:</label>
            </th>
            <td colspan="2" class="item">
                <input type="email" class="form-control" id="email" name="email" required>
            </td>
            <td colspan="3" class="item">
                <input type="checkbox" value="1" required>
                <span>{{ __('home.Allow receiving notifications via Email') }}</span>
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <label for="sns_account">{{ __('home.SNS Account') }}:</label>
            </th>
            <td colspan="4" class="item">
                <input type="text" class="form-control" id="sns_account" name="sns_account" value="{{ __('home.ID Kakao Talk') }}" required>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="type_business">{{ __('home.Career') }} :</label>
            </th>
            <td colspan="4">
                <div class="multiselect" style="position: relative">
                    <div class="selectBox" style="position: relative" id="type_business_click" onclick="showCheckboxes1()">
                        <select>
                            <option>{{ __('home.Select the applicable category') }}</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    @if($exitsMember)
                        @php
                            $listCategory = $exitsMember->type_business;
                            $arrayCategory = explode(',', $listCategory);
                        @endphp
                        <div id="type_business_checkboxes">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    @foreach($arrayCategory as $item)
                                        @php
                                            $isChecked = false;
                                            if ($category->id == $item){
                                                $isChecked = true;
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                                    <label class="ml-2 d-flex align-items-center" for="type_business-{{$category->id}}">
                                        <input type="checkbox" id="type_business-{{$category->id}}"
                                               name="type_business-{{$category->id}}"
                                               value="{{ ($category->id) }}"
                                               {{ $isChecked ? 'checked' : '' }}
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory d-flex">
                                                                @if(locationHelper() == 'kr')
                                                <div class="item-text">{{ $category->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">{{$category->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">{{$category->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">{{$category->name_vi}}</div>
                                            @else
                                                <div class="item-text">{{$category->name_en}}</div>
                                            @endif</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div id="type_business_checkboxes" class="mt-1 checkboxes">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <label class="ml-2 d-flex align-items-center" for="type_business-{{$category->id}}">
                                        <input type="checkbox" id="type_business-{{$category->id}}"
                                               name="type_business-{{$category->id}}"
                                               value="{{ ($category->id) }}"
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory ">
                                                                @if(locationHelper() == 'kr')
                                                <div class="item-text">{{ $category->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">{{$category->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">{{$category->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">{{$category->name_vi}}</div>
                                            @else
                                                <div class="item-text">{{$category->name_en}}</div>
                                            @endif
                                                            </span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="category">{{ __('home.Business') }} :</label>
            </th>
            <td colspan="4">
                <div class="multiselect" style="position: relative">
                    <div class="selectBox" style="position: relative" id="div-click" onclick="showCheckboxes()">
                        <select>
                            <option>{{ __('home.Select the applicable category') }}</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    @if($exitsMember)
                        @php
                            $listCategory = $exitsMember->code_business;
                            $arrayCategory = explode(',', $listCategory);
                        @endphp
                        <div id="checkboxes" class="mt-1  checkboxes">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    @foreach($arrayCategory as $item)
                                        @php
                                            $isChecked = false;
                                            if ($category->id == $item){
                                                $isChecked = true;
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                                    <label class="ml-2 d-flex align-items-center" for="category-{{$category->id}}">
                                        <input type="checkbox" id="category-{{$category->id}}"
                                               name="category-{{$category->id}}"
                                               value="{{ ($category->id) }}"
                                               {{ $isChecked ? 'checked' : '' }}
                                               class="inputCheckboxCategory1 mr-2 p-3"/>
                                        <span class="labelCheckboxCategory ">
                                            @if(locationHelper() == 'kr')
                                                <div class="item-text">{{ $category->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">{{$category->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">{{$category->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">{{$category->name_vi}}</div>
                                            @else
                                                <div class="item-text">{{$category->name_en}}</div>
                                            @endif</span>
                                    </label>
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            @foreach($arrayCategory as $item)
                                                @php
                                                    $isChecked1 = false;
                                                    if ($child->id == $item){
                                                        $isChecked1 = true;
                                                        break;
                                                    }
                                                @endphp
                                            @endforeach
                                            <label class="ml-4 d-flex align-items-center" for="category-{{$child->id}}">
                                                <input type="checkbox" id="category-{{$child->id}}"
                                                       name="category-{{$child->id}}"
                                                       value="{{$child->id}}"
                                                       {{ $isChecked1 ? 'checked' : '' }}
                                                       class="inputCheckboxCategory1 mr-2 p-3"/>
                                                <span class="labelCheckboxCategory ">@if(locationHelper() == 'kr')
                                                        <div class="item-text">{{ $child->name_ko }}</div>
                                                    @elseif(locationHelper() == 'cn')
                                                        <div class="item-text">{{$child->name_zh}}</div>
                                                    @elseif(locationHelper() == 'jp')
                                                        <div class="item-text">{{$child->name_ja}}</div>
                                                    @elseif(locationHelper() == 'vi')
                                                        <div class="item-text">{{$child->name_vi}}</div>
                                                    @else
                                                        <div class="item-text">{{$child->name_en}}</div>
                                                    @endif</span>
                                            </label>
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                @foreach($arrayCategory as $item)
                                                    @php
                                                        $isChecked2 = false;
                                                        if ($child2->id == $item){
                                                            $isChecked2 = true;
                                                            break;
                                                        }
                                                    @endphp
                                                @endforeach
                                                <label class="ml-5 d-flex align-items-center"
                                                       for="category-{{$child2->id}}">
                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                           name="category-{{$child2->id}}"
                                                           value="{{$child2->id}}"
                                                           {{ $isChecked2 ? 'checked' : '' }}
                                                           class="inputCheckboxCategory1 mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory ">@if(locationHelper() == 'kr')
                                                            <div class="item-text">{{ $child2->name_ko }}</div>
                                                        @elseif(locationHelper() == 'cn')
                                                            <div class="item-text">{{$child2->name_zh}}</div>
                                                        @elseif(locationHelper() == 'jp')
                                                            <div class="item-text">{{$child2->name_ja}}</div>
                                                        @elseif(locationHelper() == 'vi')
                                                            <div class="item-text">{{$child2->name_vi}}</div>
                                                        @else
                                                            <div class="item-text">{{$child2->name_en}}</div>
                                                        @endif</span>
                                                </label>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div id="checkboxes" class="mt-1  checkboxes">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <label class="ml-2 d-flex align-items-center" for="category-{{$category->id}}">
                                        <input type="checkbox" id="category-{{$category->id}}"
                                               name="category-{{$category->id}}"
                                               value="{{ ($category->id) }}"
                                               class="inputCheckboxCategory1 mr-2 p-3"/>
                                        <span class="labelCheckboxCategory ">
                                                                @if(locationHelper() == 'kr')
                                                <div class="item-text">{{ $category->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">{{$category->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">{{$category->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">{{$category->name_vi}}</div>
                                            @else
                                                <div class="item-text">{{$category->name_en}}</div>
                                            @endif
                                                            </span>
                                    </label>
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            <label class="ml-4 d-flex align-items-center " for="category-{{$child->id}}">
                                                <input type="checkbox" id="category-{{$child->id}}"
                                                       name="category-{{$child->id}}"
                                                       value="{{$child->id}}"
                                                       class="inputCheckboxCategory1 mr-2 p-3"/>
                                                <span class="labelCheckboxCategory ">
                                                                        @if(locationHelper() == 'kr')
                                                        <div class="item-text">{{ $child->name_ko }}</div>
                                                    @elseif(locationHelper() == 'cn')
                                                        <div class="item-text">{{$child->name_zh}}</div>
                                                    @elseif(locationHelper() == 'jp')
                                                        <div class="item-text">{{$child->name_ja}}</div>
                                                    @elseif(locationHelper() == 'vi')
                                                        <div class="item-text">{{$child->name_vi}}</div>
                                                    @else
                                                        <div class="item-text">{{$child->name_en}}</div>
                                                    @endif
                                                                    </span>
                                            </label>
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                <label class="ml-5 d-flex align-items-center"
                                                       for="category-{{$child2->id}}">
                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                           name="category-{{$child2->id}}"
                                                           value="{{$child2->id}}"
                                                           class="inputCheckboxCategory1 mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory ">@if(locationHelper() == 'kr')
                                                            <div class="item-text">{{ $child2->name_ko }}</div>
                                                        @elseif(locationHelper() == 'cn')
                                                            <div class="item-text">{{$child2->name_zh}}</div>
                                                        @elseif(locationHelper() == 'jp')
                                                            <div class="item-text">{{$child2->name_ja}}</div>
                                                        @elseif(locationHelper() == 'vi')
                                                            <div class="item-text">{{$child2->name_vi}}</div>
                                                        @else
                                                            <div class="item-text">{{$child2->name_en}}</div>
                                                        @endif</span>
                                                </label>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                * {{ __('home.Please enter express delivery or receiving address') }}
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <h6 class="">{{ __('home.Address English') }}:</h6>
            </th>
            <td colspan="4" class="item">
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label for="countries-select">{{ __('home.Select country') }}:</label>
                        <select class="form-control" id="countries-select" name="countries-select"
                                onchange="getListState(this.value)">
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="cities-select">{{ __('home.Choose the city') }}:</label>
                        <select class="form-control" id="cities-select" name="cities-select"
                                onchange="getListCity(this.value)">
                            <option value="">-- {{ __('home.Choose the city') }} --</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="provinces-select">{{ __('home.Select district/district') }}:</label>
                        <select class="form-control" id="provinces-select" name="provinces-select"
                                onchange="getListWard(this.value)">
                            <option value="">-- {{ __('home.Select district/district') }} --</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="address_en">{{ __('home.Address detail') }}:</label>
                    <input type="text" name="address_en" id="address_en" class="form-control" required
                           value="{{ $exitsMember ? $exitsMember->address_en : old('address_en') }}">
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" class="item">
                <h6 class="">{{ __('home.Address Korea') }}:</h6>
            </th>
            <td colspan="4" class="item">
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label for="countries-select-1">{{ __('home.Select country') }}:</label>
                        <select class="form-control" id="countries-select-1" name="countries-select-1"
                                onchange="getListState1(this.value)">
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="cities-select-1">{{ __('home.Choose the city') }}:</label>
                        <select class="form-control" id="cities-select-1" name="cities-select-1"
                                onchange="getListCity1(this.value)">
                            <option value="">-- {{ __('home.Choose the city') }} --</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="provinces-select-1">{{ __('home.Select district/district') }}:</label>
                        <select class="form-control" id="provinces-select-1" name="provinces-select-1"
                                onchange="getListWard1(this.value)">
                            <option value="">-- {{ __('home.Select district/district') }} --</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="address_kr"> {{ __('home.Address detail') }}:</label>
                    <input type="text" name="address_kr" id="address_kr" class="form-control" required
                           value="{{ $exitsMember ? $exitsMember->address_kr : old('address_kr') }}">
                </div>
            </td>
        </tr>
        <tr class="">
            <td colspan="6" class="text-center">
                <button type="button" id="buttonRegister"
                        class="btn bg-member-green solid mr-3 btn-register">{{ __('home.next') }}</button>
            </td>
        </tr>
    </tbody>
    <button type="submit" class="d-none btn btn-primary">{{ __('home.sign up') }}</button>
</form>
</table>
<script>
    $(document).ready(function () {
        $('#buttonRegister').on('click', function () {
            // $('#formRegisterMember').trigger('submit');
            $('#btnSubmitFormRegister').trigger('click');
        })
    })
</script>
