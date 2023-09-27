<div id="formCreate1" class="">
    <div class="form-row">
        <div class="col-4 d-inline-block">
            <label class="control-label small name" for="price">{{ __('home.Giá bán') }}</label>
            <input onchange="validInput(1);" type="number"
                   class="value-check form-control" required
                   name="old_price1"
                   id="price1"
                   placeholder="Nhập giá bán">
        </div>
        <div class="col-4 d-inline-block">
            <label class="control-label small name" for="qty">{{ __('home.Giá khuyến mãi') }}</label>
            <input onchange="validInput(1);" type="number"
                   class="value-check form-control"
                   name="price1" id="qty1"
                   placeholder="Nhập giá khuyến mãi">
        </div>
    </div>
    <div class="form-row">
        <div class="col-4 d-inline-block">
            <label class="control-label small name"
                   for="quantity1">{{ __('home.quantity') }}</label>
            <input type="number"
                   class="value-check form-control" required
                   name="quantity1"
                   id="quantity1"
                   placeholder="Nhập quantity">
        </div>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="description-detail">{{ __('home.Mô tả') }}</label>
            <textarea class="form-control description"
                      name="description1"
                      rows="5"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="form-group col-12 col-sm-12 pt-3">
            <label for="thumbnail">{{ __('home.Avatar') }}:</label>
            <label class='__lk-fileInput'>
                <span data-default='Choose file'>{{ __('home.Choose file') }}</span>
                <input type="file" id="thumbnail" class="img-cfg"
                       name="thumbnail1"
                       accept="image/*"
                       required>
            </label>
        </div>
    </div>
</div>
<input type="text" hidden="" name="attribute_property1"
       value="0">
<input type="text" hidden="" name="count" value="1">