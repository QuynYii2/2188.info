@php
    $create = null;
    if(session('create')){
          $create =  session('create');
    }

@endphp
<div class="">
    @if(isset($isAdminUpdate))
        <form class="form_memberInfo" action="{{route('admin.edit.users.company', $isAdminUpdate->id)}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
    @else
        <form class="form_memberInfo" action="{{route('register.member.buyer')}}" method="post"
                      enctype="multipart/form-data">
            @csrf
    @endif
          <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
          <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
          <div class="d-none" id="text-category">{{ __('home.Select the applicable category') }}</div>
            <div class="day_register title-input">{{ __('home.Day register') }}: <span id="formattedDate"></span></div>
          <div class="form-group">
                        <label for="number_clearance" class="label_item-member clearance-member">{{ __('home.Number clearance')}} <span
                                    class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="number_clearance"
                               placeholder="{{ __('home.Number clearance')}}"
                               value="{{ $create ? $create['number_clearance'] : old('number_clearance', $exitsMember ? $exitsMember->number_clearance : '') }}"
                               name="number_clearance">
                    </div>
          <label for="name_en" class="label_item-member">{{ __('home.Full Name') }}
                        <span class="text-danger">*</span></label>
          <div class="form-group">
                        <input type="text" class="form-control mb-2" id="name_en" name="name_en"
                               value="{{ $create ? $create['name_en'] : old('name_en', $exitsMember ? $exitsMember->name_en : '') }}"
                               placeholder="{{ __('home.English only') }}" required>
                        <input type="text" class="form-control mt-2" id="name" name="name"
                               value="{{ $create ? $create['name'] : old('name', $exitsMember ? $exitsMember->name : '') }}"
                               placeholder="{{ __('home.Local language') }}" required>
                    </div>
          <label for="code" class="label_item-member">{{ __('home.ID') }} <span
                                class="text-danger">*</span></label>
          <div class="form-group">
                        <input type="text" class="form-control" id="code" name="code"
                               value="{{ $create ? $create['code'] : old('code', $exitsMember ? $exitsMember->code : '') }}"
                               required>
                    </div>
          @if(!$exitsMember)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="label_item-member">{{ __('home.Password') }} <span
                                            class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="*********" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="passwordConfirm" class="label_item-member">{{ __('home.Password') }} <span
                                            class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="passwordConfirm"
                                       name="passwordConfirm" placeholder="*********"
                                       required>
                            </div>
                        </div>
                    @endif
          <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNumber" class="label_item-member">{{ __('home.phone number') }} <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                   value="{{ $create ? $create['phone'] : old('phone', $exitsMember ? $exitsMember->phone : '') }}"
                                   required>
                        </div>
                        <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                                <label class="form-check-label label_item-member" for="gridCheck1">
                                    {{ __('home.Allow receiving notifications via SMS message') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="label_item-member">{{ __('home.email') }} <span
                                        class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ $create ? $create['email'] : old('email', $exitsMember ? $exitsMember->email : '') }}"
                                   required>
                        </div>
                        <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="gridCheck2" required>
                                <label class="form-check-label label_item-member" for="gridCheck2">
                                    {{ __('home.Allow receiving notifications via Email') }}
                                </label>
                            </div>
                        </div>
                    </div>
          <div class="form-group">
                        <label for="sns_account" class="label_item-member">{{ __('home.SNS Account') }}
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sns_account" name="sns_account"
                               value="{{ $create ? $create['sns_account'] : old('sns_account', $exitsMember ? $exitsMember->sns_account : '') }}"
                               placeholder="{{ __('home.ID Kakao Talk') }}" required>
                    </div>
          <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="type_business" class="label_item-member">{{ __('home.Career') }}
                                <span class="text-danger">*</span></label>
                            <div class="multiselect" style="position: relative">
                                <div class="selectBox" style="position: relative" id="code_2_item"
                                     onclick="showCheckboxes2()">
                                    <select id="type_business">
                                        <option class="label_item-member">{{ __('home.Select the applicable category') }}</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                @if($exitsMember)
                                    @php
                                        $listCategory = $exitsMember->type_business;
                                        $arrayCategory = explode(',', $listCategory);
                                    @endphp
                                    <div id="code_2">
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
                                                <label class="ml-2 d-flex align-items-center"
                                                       for="code_2-{{$category->id}}">
                                                    <input type="checkbox" id="code_2-{{$category->id}}"
                                                           name="code_2[]"
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
                                    <div id="code_2" class="mt-1 checkboxes">
                                        @foreach($categories as $category)
                                            @if(!$category->parent_id)
                                                <label class="ml-2 d-flex align-items-center"
                                                       for="code_2-{{$category->id}}">
                                                    <input type="checkbox" id="code_2-{{$category->id}}"
                                                           name="code_2[]"
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
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category" class="label_item-member">{{ __('home.Business') }}
                                <span class="text-danger">*</span></label>
                            <div class="multiselect" style="position: relative">
                                <div class="selectBox" style="position: relative" id="code_1_item"
                                     onclick="showCheckboxes()">
                                    <select id="category">
                                        <option class="label_item-member">{{ __('home.Select the applicable category') }}</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                @if($exitsMember)
                                    @php
                                        $listCategory = $exitsMember->code_business;
                                        $arrayCategory = explode(',', $listCategory);
                                    @endphp
                                    <div id="code_1" class="mt-1  checkboxes">
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
                                                <label class="ml-2 d-flex align-items-center"
                                                       for="code_1-{{$category->id}}">
                                                    <input type="checkbox" id="code_1-{{$category->id}}"
                                                           name="code_1[]"
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
                                                        <label class="ml-4 d-flex align-items-center"
                                                               for="code_1-{{$child->id}}">
                                                            <input type="checkbox" id="code_1-{{$child->id}}"
                                                                   name="code_1[]"
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
                                                                   for="code_1-{{$child2->id}}">
                                                                <input type="checkbox" id="code_1-{{$child2->id}}"
                                                                       name="code_1[]"
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
                                    <div id="code_1" class="mt-1  checkboxes">
                                        @foreach($categories as $category)
                                            @if(!$category->parent_id)
                                                <label class="ml-2 d-flex align-items-center"
                                                       for="code_1-{{$category->id}}">
                                                    <input type="checkbox" id="code_1-{{$category->id}}"
                                                           name="code_1[]"
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
                                                        <label class="ml-4 d-flex align-items-center "
                                                               for="code_1-{{$child->id}}">
                                                            <input type="checkbox" id="code_1-{{$child->id}}"
                                                                   name="code_1[]"
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
                                                                   for="code_1-{{$child2->id}}">
                                                                <input type="checkbox" id="code_1-{{$child2->id}}"
                                                                       name="code_1[]"
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
                        </div>
                    </div>
          <div class="label_form">{{ __('home.Address Business') }} <span class="text-danger">*</span></div>
          <label for="detail-address" class="label_item-member">{{ __('home.Address English') }}</label>
          <div class="form-row">
                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">
                            <input type="text" readonly class="form-control" id="countries-select"
                                   placeholder="{{ __('home.Select country') }}"
                                   name="countries-select">
                        </div>
                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">
                            <input type="text" readonly class="form-control" id="cities-select"
                                   placeholder="{{ __('home.Choose the city') }}"
                                   name="cities-select">
                        </div>
                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">
                            <input type="text" readonly class="form-control" id="provinces-select"
                                   placeholder="{{ __('home.Select district/district') }}"
                                   name="provinces-select">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="detail-address" id="detail-address"
                                   class="form-control" placeholder="{{ __('home.Address detail') }}"
                                   value="{{ $create ? $create['address_en'] : old('address_en', $exitsMember ? $exitsMember->address_en : '') }}">
                        </div>
                        <input type="hidden" id="address_code" name="address_code">
                    </div>
          <label for="detail-address-1" class="label_item-member">{{ __('home.Address Korea') }}</label>
          <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-4 address-below" data-toggle="modal"
                                 data-target="#modal-address">
                                <input type="text" readonly class="form-control" id="countries-select-1"
                                       placeholder="{{ __('home.Select country') }}"
                                       name="countries-select-1">
                            </div>
                            <div class="form-group col-md-4 address-below" data-toggle="modal"
                                 data-target="#modal-address">
                                <input type="text" readonly class="form-control" id="cities-select-1"
                                       placeholder="{{ __('home.Choose the city') }}"
                                       name="cities-select-1">
                            </div>
                            <div class="form-group col-md-4 address-below" data-toggle="modal"
                                 data-target="#modal-address">
                                <input type="text" readonly class="form-control" id="provinces-select-1"
                                       placeholder="{{ __('home.Select district/district') }}"
                                       name="provinces-select-1">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="detail-address-1" id="detail-address-1"
                                       class="form-control" placeholder="{{ __('home.Address detail') }}"
                                       value="{{ $create ? $create['address_kr'] : old('address_kr', $exitsMember ? $exitsMember->address_kr : '') }}">
                            </div>
                        </div>
                    </div>
          <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label text-checkout" for="gridCheck">
                                I have read, understand and accept Global's Agree to Terms,
                                <a class="text-policy" href="#">Agree to the Information Collection Policy</a> and
                                <a class="text-policy" href="#">Agree to the Terms of Information Use</a>
                            </label>
                        </div>
                    </div>

          <input id="localeInput" name="locale" class="d-none">
          <button type="submit" id="btnSubmitFormRegister"
                            class="d-none btn btn-primary">{{ __('home.sign up') }}</button>
          <div class="text-center">
                        <button type="button" id="buttonRegister"
                                class="w-50 btn bg-member-primary solid mr-3 btn-register">{{ __('home.next') }}</button>
                    </div>
          </form>
</div>
<script>
    $(document).ready(function () {
        $('#buttonRegister').on('click', function () {
            // $('#formRegisterMember').trigger('submit');

            let isChecked = checkCategory('inputCheckboxCategory');
            let isChecked1 = checkCategory('inputCheckboxCategory1');

            if (isChecked && isChecked1) {
                $('#btnSubmitFormRegister').trigger('click');
            } else {
                alert('Bạn chưa chọn category');
            }
        })

        function checkCategory(className) {
            let items = document.getElementsByClassName(className);
            let isChecked = Array.from(items).some(item => item.checked);
            return isChecked;
        }
    })
    // hàm cập nhật ngày tháng năm
    function updateFormattedDate() {
        var currentDate = new Date();
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();
        var formattedDate = day + '/' + month + '/' + year;
        document.getElementById('formattedDate').textContent = formattedDate;
    }
    updateFormattedDate();
</script>