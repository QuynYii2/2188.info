@php
    $testArray = session()->get('testArray');
    if ($testArray){
     $testArray = $testArray[0];
    } else {
        $testArray = null;
    }
@endphp
@if($testArray)
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">Attribute</th>
            <th scope="col">Thumbnail</th>
            <th scope="col">Old Price</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>
        @if(count($testArray) == 1)
            <div class="form-group col-12">
                @php
                    $item = $testArray[0];
                @endphp
                @if(is_array($item))
                    @if(count($item) == 1)
                        @php
                            $attproArray =  explode('-', $item[0]);

                            $attribute = \App\Models\Attribute::where('status', \App\Enums\AttributeStatus::ACTIVE)
                                        ->where('id', $attproArray[0])->first();
                            $property = \App\Models\Properties::where('status', \App\Enums\PropertiStatus::ACTIVE)
                                        ->where('id', $attproArray[1])->first();
                        @endphp
                        <tr>
                            <td>
                                @if($attribute)
                                    @if(locationHelper() == 'kr')
                                        {{ ($attribute->name_ko) }}
                                    @elseif(locationHelper() == 'cn')
                                        {{ ($attribute->name_zh) }}
                                    @elseif(locationHelper() == 'jp')
                                        {{ ($attribute->name_ja) }}
                                    @elseif(locationHelper() == 'vi')
                                        {{ ($attribute->name_vi) }}
                                    @else
                                        {{ ($attribute->name_en) }}
                                    @endif
                                    :
                                    @if($property)
                                        @if(locationHelper() == 'kr')
                                            {{ ($property->name_ko) }}
                                        @elseif(locationHelper() == 'cn')
                                            {{ ($property->name_zh) }}
                                        @elseif(locationHelper() == 'jp')
                                            {{ ($property->name_ja) }}
                                        @elseif(locationHelper() == 'vi')
                                            {{ ($property->name_vi) }}
                                        @else
                                            {{ ($property->name_en) }}
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                <input type="file" id="thumbnail" class="img-cfg"
                                       name="thumbnail1"
                                       accept="image/*"
                                       required>
                            </td>
                            <td>
                                <input type="number"
                                       class="value-check form-control" required
                                       name="old_price1"
                                       id="price1"
                                       placeholder="Nhập giá bán">
                            </td>
                            <td>
                                <input type="number"
                                       class="value-check form-control"
                                       name="price1" id="price1"
                                       placeholder="Nhập giá khuyến mãi">
                            </td>
                            <td>
                                <input type="number"
                                       class="value-check form-control" required
                                       name="quantity1"
                                       id="quantity1"
                                       placeholder="Nhập quantity">
                            </td>
                            <td>
                                <textarea class="form-control description"
                                          name="description1"
                                          rows="5">

                                </textarea>
                            </td>
                        </tr>

                        <input type="text" hidden="" name="attribute_property1"
                               value="{{$item[0]}}">
                        <br>
                        <input type="text" hidden="" name="count" value="1">
                    @else
                        @foreach($item as $attpro)
                            <tr>
                                <td>
                                    @php
                                        $attproArray =  explode('-', $attpro);

                                        $attribute = \App\Models\Attribute::where('status', \App\Enums\AttributeStatus::ACTIVE)
                                                ->where('id', $attproArray[0])->first();
                                        $property = \App\Models\Properties::where('status', \App\Enums\PropertiStatus::ACTIVE)
                                                ->where('id', $attproArray[1])->first();
                                    @endphp
                                    @if($attribute)
                                        {{$attribute->name}}:
                                        @if($property)
                                            {{$property->name}}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <input type="file" id="thumbnail" class="img-cfg"
                                           name="thumbnail{{$loop->index+1}}"
                                           accept="image/*"
                                           required>
                                </td>
                                <td>
                                    <input type="number"
                                           class="value-check form-control" required
                                           name="old_price{{$loop->index+1}}"
                                           id="price{{$loop->index+1}}"
                                           placeholder="Nhập giá bán">
                                </td>
                                <td>
                                    <input type="number"
                                           class="value-check form-control"
                                           name="price{{$loop->index+1}}" id="price{{$loop->index+1}}"
                                           placeholder="Nhập giá khuyến mãi">
                                </td>
                                <td>
                                    <input type="number"
                                           class="value-check form-control" required
                                           name="quantity{{$loop->index+1}}"
                                           id="quantity{{$loop->index+1}}"
                                           placeholder="Nhập quantity">
                                </td>
                                <td>
                                    <textarea class="form-control description"
                                              name="description{{$loop->index+1}}"
                                              rows="5">
                                    </textarea>
                                </td>
                            </tr>

                            <input type="text" hidden=""
                                   name="attribute_property{{$loop->index+1}}"
                                   value="{{$attpro}}">
                            <br>
                        @endforeach
                        <input type="text" hidden="" name="count" value="{{count($item)}}">
                    @endif
                @else
                    @php
                        $myArray =  explode(',', $item);
                    @endphp
                    <tr>
                        <td>
                            @foreach($myArray as $value)
                                @php
                                    $attpro =  explode('-', $value);

                                    $attribute = \App\Models\Attribute::where('status', \App\Enums\AttributeStatus::ACTIVE)
                                            ->where('id', $attpro[0])->first();
                                    $property = \App\Models\Properties::where('status', \App\Enums\PropertiStatus::ACTIVE)
                                            ->where('id', $attpro[1])->first();
                                @endphp
                                @if($attribute)
                                    {{$attribute->name}}:
                                    @if($property)
                                        {{$property->name}},
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <input type="file" id="thumbnail" class="img-cfg"
                                   name="thumbnail1"
                                   accept="image/*"
                                   required>
                        </td>
                        <td>
                            <input type="number"
                                   class="value-check form-control" required
                                   name="old_price1"
                                   id="price1"
                                   placeholder="Nhập giá bán">
                        </td>
                        <td>
                            <input type="number"
                                   class="value-check form-control"
                                   name="price1" id="price1"
                                   placeholder="Nhập giá khuyến mãi">
                        </td>
                        <td>
                            <input type="number"
                                   class="value-check form-control" required
                                   name="quantity1"
                                   id="quantity1"
                                   placeholder="Nhập quantity">
                        </td>
                        <td>
                            <textarea class="form-control description"
                                      name="description1"
                                      rows="5">
                            </textarea>
                        </td>
                    </tr>
                    <input type="text" hidden="" name="attribute_property1"
                           value="{{$item}}">
                    <br>
                    <input type="text" hidden="" name="count" value="1">
                @endif
            </div>
        @else
            @foreach($testArray as $item)
                @php
                    $attributeProperty = explode(',', $item);
                @endphp
                <tr>
                    <td>
                        @foreach($attributeProperty as $attpro)
                            @php
                                $attproArray =  explode('-', $attpro);

                                $attribute = \App\Models\Attribute::where('status', \App\Enums\AttributeStatus::ACTIVE)
                                        ->where('id', $attproArray[0])->first();
                                $property = \App\Models\Properties::where('status', \App\Enums\PropertiStatus::ACTIVE)
                                        ->where('id', $attproArray[1])->first();
                            @endphp
                            @if($attribute)
                                {{$attribute->name}}:
                                @if($property)
                                    {{$property->name}}
                                @endif,
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <input type="file" id="thumbnail" class="img-cfg"
                               name="thumbnail{{$loop->index+1}}"
                               accept="image/*"
                               required>
                    </td>
                    <td>
                        <input type="number"
                               class="value-check form-control" required
                               name="old_price{{$loop->index+1}}"
                               id="price{{$loop->index+1}}"
                               placeholder="Nhập giá bán">
                    </td>
                    <td>
                        <input type="number"
                               class="value-check form-control"
                               name="price{{$loop->index+1}}" id="price{{$loop->index+1}}"
                               placeholder="Nhập giá khuyến mãi">
                    </td>
                    <td>
                        <input type="number"
                               class="value-check form-control" required
                               name="quantity{{$loop->index+1}}"
                               id="quantity{{$loop->index+1}}"
                               placeholder="Nhập quantity">
                    </td>
                    <td>
                        <textarea class="form-control description"
                                  name="description{{$loop->index+1}}"
                                  rows="5">
                        </textarea>
                    </td>
                </tr>

                <input type="text" hidden="" name="attribute_property{{$loop->index+1}}"
                       value="{{$item}}">
            @endforeach
            <input type="text" hidden="" name="count" value="{{count($testArray)}}">
            <br>
            <br>
        @endif
        </tbody>
    </table>
@endif