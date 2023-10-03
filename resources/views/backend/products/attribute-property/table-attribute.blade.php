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
                            $attribute = \App\Models\Attribute::find($attproArray[0]);
                            $property = \App\Models\Properties::find($attproArray[1]);
                        @endphp
                        <tr>
                            <td>
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
                                        $attribute = \App\Models\Attribute::find($attproArray[0]);
                                        $property = \App\Models\Properties::find($attproArray[1]);
                                    @endphp
                                    {{$attribute->name}}:{{$property->name}}
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
                                    $attribue = \App\Models\Attribute::find($attpro[0]);
                                    $property = \App\Models\Properties::find($attpro[1]);
                                @endphp
                                {{$attribue->name}}:{{$property->name}},
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
                                $attribue = \App\Models\Attribute::find($attproArray[0]);
                                $property = \App\Models\Properties::find($attproArray[1]);
                            @endphp
                            {{$attribue->name}}:{{$property->name}},
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