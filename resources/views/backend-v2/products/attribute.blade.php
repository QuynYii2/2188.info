@php
    $testArray = session()->get('testArray');
    if ($testArray){
     $testArray = $testArray[0];
    } else {
        $testArray = null;
    }
@endphp
<div class="col-12 mt-2 rm-pd-on-mobile">
    @if($testArray)
        @if(count($testArray) == 1)
            <div class="form-group col-12">
                @php
                    $item = $testArray[0];
                @endphp
                @if(is_array($item))
                    @if(count($item) == 1)
                        <div class="form-group">
                            @php
                                $attproArray =  explode('-', $item[0]);
                                $attribue = \App\Models\Attribute::find($attproArray[0]);
                                $property = \App\Models\Properties::find($attproArray[1]);
                            @endphp
                            <label for="attribute{{$item[0]}}">{{$attribue->name}}</label>
                            <input disabled class="form-control" name="attribute{{$item[0]}}"
                                   id="attribute{{$item[0]}}" value=" {{$property->name}}">
                        </div>
                        <a id="btnEdit1"
                           onclick="showFormEdit(1);"
                           class="btn btn-success">Editor</a>
                        <div id="formCreate1" class="d-none">
                            <div class="form-row">
                                <div class="col-4 d-inline-block">
                                    <label class="control-label small name" for="price">Giá
                                        bán</label>
                                    <input onchange="validInput(1);" type="number"
                                           class="value-check form-control" required
                                           name="old_price1"
                                           id="price1"
                                           placeholder="Nhập giá bán">
                                </div>
                                <div class="col-4 d-inline-block">
                                    <label class="control-label small name" for="qty">Giá khuyến
                                        mãi</label>
                                    <input onchange="validInput(1);" type="number"
                                           class="value-check form-control"
                                           name="price1" id="qty1"
                                           placeholder="Nhập giá khuyến mãi">
                                </div>
                                <div class="col-4 d-inline-block">
                                    <label class="control-label small name"
                                           for="quantity1">Quantity</label>
                                    <input type="number"
                                           class="value-check form-control" required
                                           name="quantity1"
                                           id="quantity1"
                                           placeholder="Nhập quantity">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="description-detail">Mô tả</label>
                                    <textarea class="form-control description"
                                              name="description1"
                                              rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group col-12 col-sm-12 pt-3">
                                    <label for="thumbnail">Ảnh đại diện:</label>
                                    <label class='__lk-fileInput'>
                                        <span data-default='Choose file'>Choose file</span>
                                        <input type="file" id="thumbnail" class="img-cfg"
                                               name="thumbnail1"
                                               accept="image/*"
                                               required>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="text" hidden="" name="attribute_property1"
                               value="{{$item[0]}}">
                        <br>
                        <input type="text" hidden="" name="count" value="1">
                    @else
                        @foreach($item as $attpro)
                            @php
                                $attproArray =  explode('-', $attpro);
                                $attribute = \App\Models\Attribute::find($attproArray[0]);
                                $property = \App\Models\Properties::find($attproArray[1]);
                            @endphp
                            <label for="attribute">{{$attribute->name}}</label>
                            <input disabled class="form-control" value="{{$property->name}}">
                            <a id="btnEdit{{$loop->index+1}}"
                               onclick="showFormEdit({{$loop->index+1}});"
                               class="btn btn-success">Editor</a>
                            <div id="formCreate{{$loop->index+1}}" class="d-none">
                                <div class="form-row">
                                    <div class="col-4 d-inline-block">
                                        <label class="control-label small name" for="price">Giá
                                            bán</label>
                                        <input onchange="validInput({{$loop->index+1}});"
                                               type="number"
                                               class="value-check form-control" required
                                               name="old_price{{$loop->index+1}}"
                                               id="price{{$loop->index+1}}"
                                               placeholder="Nhập giá bán">
                                    </div>
                                    <div class="col-4 d-inline-block">
                                        <label class="control-label small name" for="qty">Giá
                                            khuyến
                                            mãi</label>
                                        <input onchange="validInput({{$loop->index+1}});"
                                               type="number"
                                               class="value-check form-control"
                                               name="price{{$loop->index+1}}"
                                               id="qty{{$loop->index+1}}"
                                               placeholder="Nhập giá khuyến mãi">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-4 d-inline-block">
                                        <label class="control-label small name"
                                               for="quantity{{$loop->index+1}}">Quantity</label>
                                        <input type="number"
                                               class="value-check form-control" required
                                               name="quantity{{$loop->index+1}}"
                                               id="quantity{{$loop->index+1}}"
                                               placeholder="Nhập quantity">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="description-detail">Mô tả</label>
                                        <textarea class="form-control description"
                                                  name="description{{$loop->index+1}}"
                                                  rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-12 col-sm-12 pt-3">
                                        <label for="thumbnail">Ảnh đại diện:</label>
                                        <label class='__lk-fileInput'>
                                            <span data-default='Choose file'>Choose file</span>
                                            <input type="file" id="thumbnail" class="img-cfg"
                                                   name="thumbnail{{$loop->index+1}}"
                                                   accept="image/*"
                                                   required>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                    <div class="form-group">
                        @foreach($myArray as $value)
                            @php
                                $attpro =  explode('-', $value);
                                $attribue = \App\Models\Attribute::find($attpro[0]);
                                $property = \App\Models\Properties::find($attpro[1]);
                            @endphp
                            <label for="attribute{{$item}}">{{$attribue->name}}</label>
                            <input disabled class="form-control" name="attribute{{$item}}"
                                   id="attribute{{$item}}" value=" {{$property->name}}">
                        @endforeach
                    </div>
                    <a id="btnEdit1"
                       onclick="showFormEdit(1);"
                       class="btn btn-success">Editor</a>
                    <div id="formCreate1" class="d-none">
                        <div class="form-row">
                            <div class="col-6 d-inline-block">
                                <label class="control-label small name" for="price">Giá
                                    bán</label>
                                <input onchange="validInput(1);" type="number"
                                       class="value-check form-control" required
                                       name="old_price1"
                                       id="price1"
                                       placeholder="Nhập giá bán">
                            </div>
                            <div class="col-6 d-inline-block">
                                <label class="control-label small name" for="qty">Giá khuyến
                                    mãi</label>
                                <input onchange="validInput(1);" type="number"
                                       class="value-check form-control"
                                       name="price1" id="qty1"
                                       placeholder="Nhập giá khuyến mãi">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6 d-inline-block">
                                <label class="control-label small name"
                                       for="quantity1">Quantity</label>
                                <input type="number"
                                       class="value-check form-control" required
                                       name="quantity1"
                                       id="quantity1"
                                       placeholder="Nhập quantity">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="description-detail">Mô tả</label>
                                <textarea class="form-control description"
                                          name="description1"
                                          rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12 pt-3">
                                <label for="thumbnail">Ảnh đại diện:</label>
                                <label class='__lk-fileInput'>
                                    <span data-default='Choose file'>Choose file</span>
                                    <input type="file" id="thumbnail" class="img-cfg"
                                           name="thumbnail1"
                                           accept="image/*"
                                           required>
                                </label>
                            </div>
                        </div>
                    </div>
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
                <div class="form-group">
                    @foreach($attributeProperty as $attpro)
                        @php
                            $attproArray =  explode('-', $attpro);
                            $attribue = \App\Models\Attribute::find($attproArray[0]);
                            $property = \App\Models\Properties::find($attproArray[1]);
                        @endphp
                        <label for="attribute{{$item}}">{{$attribue->name}}</label>
                        <input disabled class="form-control" name="attribute{{$item}}"
                               id="attribute{{$item}}" value=" {{$property->name}}">
                    @endforeach
                </div>
                <a id="btnEdit{{$loop->index+1}}" onclick="showFormEdit({{$loop->index+1}});"
                   class="btn btn-success">Editor</a>
                <div id="formCreate{{$loop->index+1}}" class="d-none">
                    <div class="form-row">
                        <div class="col-4 d-inline-block">
                            <label class="control-label small name" for="price">Giá bán</label>
                            <input onchange="validInput({{$loop->index+1}});" type="number"
                                   class="value-check form-control" required
                                   name="old_price{{$loop->index+1}}"
                                   id="price{{$loop->index+1}}"
                                   placeholder="Nhập giá bán">
                        </div>
                        <div class="col-4 d-inline-block">
                            <label class="control-label small name" for="qty">Giá khuyến mãi</label>
                            <input onchange="validInput({{$loop->index+1}});" type="number"
                                   class="value-check form-control"
                                   name="price{{$loop->index+1}}" id="qty{{$loop->index+1}}"
                                   placeholder="Nhập giá khuyến mãi">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-4 d-inline-block">
                            <label class="control-label small name"
                                   for="quantity{{$loop->index+1}}">Quantity</label>
                            <input type="number"
                                   class="value-check form-control" required
                                   name="quantity{{$loop->index+1}}"
                                   id="quantity{{$loop->index+1}}"
                                   placeholder="Nhập quantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="description-detail">Mô tả</label>
                            <textarea class="form-control description"
                                      name="description{{$loop->index+1}}"
                                      rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group col-12 col-sm-12 pt-3">
                            <label for="thumbnail">Ảnh đại diện:</label>
                            <label class='__lk-fileInput'>
                                <span data-default='Choose file'>Choose file</span>
                                <input type="file" id="thumbnail" class="img-cfg"
                                       name="thumbnail{{$loop->index+1}}"
                                       accept="image/*"
                                       required>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="text" hidden="" name="attribute_property{{$loop->index+1}}"
                       value="{{$item}}">
            @endforeach
            <input type="text" hidden="" name="count" value="{{count($testArray)}}">
            <br>
            <br>
        @endif
    @endif
</div>