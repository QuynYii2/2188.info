<table class="table element-bordered align-middle" align="center">
    <form action="{{route('register.member.info')}}" method="post" id="formRegisterMember">
        @csrf
        <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
        <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
        <tbody>
        <tr>
            <th scope="row">
                <label for="datetime_register">{{ __('home.Day register') }}</label>
            </th>
            <td colspan="2">
                <input type="text" class="form-control" id="datetime_register"
                       name="datetime_register" disabled>
            </td>
            <th scope="row">
                <label for="number_clearance">{{ __('home.Number clearance')}}</label>
            </th>
            <td>
                <input type="number" class="form-control" id="number_clearance"
                       value="{{ $exitsMember ? $exitsMember->number_clearance : old('number_clearance') }}"
                       name="number_clearance" placeholder="{{ __('home.Number clearance')}}">
            </td>
        </tr>
        <tr>
            <th rowspan="3">
                <label>{{ __('home.company information') }}</label>
            </th>
            <td colspan="2">
                <input type="text" class="form-control" id="name_en"
                       value="{{ $exitsMember ? $exitsMember->name_kr : old('name_kr') }}"
                       name="name_en" placeholder="{{ __('home.Name company English') }}" required>
            </td>
            <td>
                <label for="phone">{{ __('home.Phone Number') }}</label>
            </td>
            <td>
                <input type="number" class="form-control" id="phone"
                       value="{{ $exitsMember ? $exitsMember->phone : old('phone') }}"
                       name="phone" placeholder="{{ __('home.Phone Number') }}" required>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="text" class="form-control" id="name_kr"
                       value="{{ $exitsMember ? $exitsMember->name_kr : old('name_kr') }}"
                       name="name_kr" placeholder="{{ __('home.Name company Korea') }}" required>
            </td>
            <td>
                <label for="fax">{{ __('home.Fax') }}</label>
            </td>
            <td>
                <input type="number" class="form-control" id="fax"
                       value="{{ $exitsMember ? $exitsMember->fax : old('fax') }}"
                       name="fax" placeholder="{{ __('home.Fax') }}">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="number" class="form-control" id="number_business"
                       value="{{ $exitsMember ? $exitsMember->number_business : old('number_business') }}"
                       name="number_business" placeholder="{{ __('home.Business registration number') }}" required>
            </td>
            <td colspan="2">
                <input type="file" class="form-control" id="giay_phep_kinh_doanh"
                       name="giay_phep_kinh_doanh" {{ $exitsMember ? '' : 'required' }}">
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label>{{ __('home.address') }}</label>
            </th>
            <td colspan="4">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="countries-select">{{ __('home.Select country') }}:</label>
                        <select class="form-control" id="countries-select" name="countries-select"
                                onchange="getListState(this.value)" required>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cities-select">{{ __('home.Choose the city') }}:</label>
                        <select class="form-control" id="cities-select" name="cities-select"
                                onchange="getListCity(this.value)">
                            <option value="">-- {{ __('home.Choose the city') }} --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="provinces-select">{{ __('home.Select district/district') }}:</label>
                        <select class="form-control" id="provinces-select" name="provinces-select"
                                onchange="getListWard(this.value)">
                            <option value="">-- {{ __('home.Select district/district') }} --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address_en">{{ __('home.Address detail') }}:</label>
                        <input type="text" name="address_en" id="address_en" class="form-control" required
                               value="{{ $exitsMember ? $exitsMember->address_en : old('address_en') }}">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="countries-select-1">{{ __('home.Select country') }}:</label>
                        <select class="form-control" id="countries-select-1" name="countries-select-1"
                                onchange="getListState1(this.value)" required>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cities-select-1">{{ __('home.Choose the city') }}:</label>
                        <select class="form-control" id="cities-select-1" name="cities-select-1"
                                onchange="getListCity1(this.value)">
                            <option value="">-- {{ __('home.Choose the city') }} --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="provinces-select-1">{{ __('home.Select district/district') }}:</label>
                        <select class="form-control" id="provinces-select-1" name="provinces-select-1"
                                onchange="getListWard1(this.value)">
                            <option value="">-- {{ __('home.Select district/district') }} --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address_kr"> {{ __('home.Address detail') }}:</label>
                        <input type="text" name="address_kr" id="address_kr" class="form-control" required
                               value="{{ $exitsMember ? $exitsMember->address_kr : old('address_kr') }}">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label>{{ __('home.Business industry') }}</label>
            </th>
            <td>
                <label for="">{{ __('home.Business') }}</label>
            </td>
            <td>
                <div class="multiselect" style="position: relative">
                    <div class="selectBox" id="type_business_click" onclick="showCheckboxes1()">
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
                        <div id="type_business_checkboxes" class="mt-1  checkboxes">
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
                                        <span class="labelCheckboxCategory">
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
                        <div id="type_business_checkboxes" class="mt-1  checkboxes">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <label class="ml-2 d-flex align-items-center" for="type_business-{{$category->id}}">
                                        <input type="checkbox" id="type_business-{{$category->id}}"
                                               name="type_business-{{$category->id}}"
                                               value="{{ ($category->id) }}"
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory">
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
            <td>
                <label for="status_business">{{ __('home.Company status') }}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="status_business"
                       value="{{ $exitsMember ? $exitsMember->name : old('status_business') }}"
                       name="status_business" placeholder="{{ __('home.Company status') }}" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">{{ __('home.Business industry') }}</label>
            </td>
            <td>
                <div class="multiselect" style="position: relative">
                    <div class="selectBox" id="div-click" onclick="showCheckboxes()">
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
                                        <span class="labelCheckboxCategory">
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
                                                <span class="labelCheckboxCategory">@if(locationHelper() == 'kr')
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
                                                    <span class="labelCheckboxCategory">@if(locationHelper() == 'kr')
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
                                        <span class="labelCheckboxCategory">
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
                                            <label class="ml-4 d-flex align-items-center" for="category-{{$child->id}}">
                                                <input type="checkbox" id="category-{{$child->id}}"
                                                       name="category-{{$child->id}}"
                                                       value="{{$child->id}}"
                                                       class="inputCheckboxCategory1 mr-2 p-3"/>
                                                <span class="labelCheckboxCategory">
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
                                                    <span class="labelCheckboxCategory">@if(locationHelper() == 'kr')
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
            <td>
                <label for="certify_business">{{ __('home.Industry Certificate') }}</label>
            </td>
            <td>
                <input type="file" class="form-control" id="certify_business"
                       name="certify_business" {{ $exitsMember ? '' : 'required' }}">
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label>{{ __('home.PLU') }}</label>
            </th>
            <td>
                <label for="code_1">{{ __('home.1st classification') }}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="code_1"
                       value="{{ $exitsMember ? $exitsMember->code_1 : old('code_1') }}"
                       name="code_1" required>
            </td>
            <td>
                <label for="code_3">{{ __('home.3rd classification') }}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="code_3"
                       value="{{ $exitsMember ? $exitsMember->code_3 : old('code_3') }}"
                       name="code_3" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="code_2">{{ __('home.2nd classification') }}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="code_2"
                       value="{{ $exitsMember ? $exitsMember->code_2 : old('code_2') }}"
                       name="code_2" required>
            </td>
            <td>
                <label for="code_4">{{ __('home.4th classification') }}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="code_4"
                       value="{{ $exitsMember ? $exitsMember->code_4 : old('code_4') }}"
                       name="code_4" required>
            </td>
        </tr>
        <tr class="">
            <td colspan="6" class="text-center">
                <button type="button" id="buttonRegister"
                        class="btn bg-member-green solid mr-3 btn-register">{{ __('home.next') }}</button>
            </td>
        </tr>
        </tbody>
        <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
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

