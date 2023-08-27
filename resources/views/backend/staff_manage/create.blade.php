@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

<style>



</style>
@extends('backend.layouts.master')

@section('content')

    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px;">
        <h5 class="card-title">{{ __('home.Add new products') }}</h5>
        @if (session('success_update_product'))
            <div class="alert alert-success">
                {{ session('success_update_product') }}
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <form action="{{ route('staff.manage.store') }}" method="post" enctype="multipart/form-data"
              class="form-horizontal row" role="form">
            @csrf
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('error_create_product') }}
                </div>
            @endif

            <div class="col-6 col-sm-6 mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <div class="name">{{ __('home.Position') }}</div>
                    <select class="form-control" name="chuc_vu" id="chuc_vu">
                        <option value="1">{{ __('home.Representative') }}</option>
                        <option value="1">{{ __('home.Manager') }}</option>
                    </select>

                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.full name') }}</div>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="Nhập Họ tên" required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.phone number') }}</div>
                    <input type="text" class="form-control" name="phone" id="phone"
                           placeholder="Nhập Số điện thoại" required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.social network id') }}</div>
                    <input type="text" class="form-control" name="social_media" id="social_media"
                           placeholder="Nhập ID MXH" required>
                </div>

                <input type="text" hidden name="type_account" id="type_account"
                       value="seller">
            </div>
            <div class="col-6 col-sm-6 mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <div class="name">{{ __('home.Responsibility') }}</div>
                    <select class="form-control" name="phu_trach" id="phu_trach">
                        <option value="1">{{ __('home.Representative') }}</option>
                        <option value="1">{{ __('home.Subscribers') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.Nickname') }}</div>
                    <input type="text" class="form-control" name="nickname" id="nickname"
                           placeholder="Nhập Biệt danh" required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.email') }}</div>
                    <input type="text" class="form-control" name="email" id="email"
                           placeholder="Nhập Email" required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.Password') }}</div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Nhập Mật khẩu"
                           required>
                </div>
            </div>


            <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
            <div class="form-group col-12 col-md-7 col-sm-8 ">
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-success">Gửi</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var properties = document.getElementsByClassName('property-attribute')
        var number = properties.length

        var priceInput = document.getElementById('price');
        var qtyInput = document.getElementById('qty');

        qtyInput.addEventListener('input', function () {
            checkPrice();
        });
        priceInput.addEventListener('input', function () {
            checkPrice();
        });

        function checkPrice() {
            var price = parseFloat(priceInput.value);
            var qty = parseFloat(qtyInput.value);

            if (qty > price) {
                alert('Giá khuyến mãi không được lớn hơn giá bán.');
                qtyInput.value = '';
            }
        }

        function checkInput() {
            var propertyArray = [];
            var attributeArray = [];
            var myArray = [];
            for (i = 0; i < number; i++) {
                if (properties[i].checked) {
                    const ArrPro = properties[i].value.split('-');
                    myArray.push(properties[i].value);
                    let attribute = ArrPro[0];
                    let property = ArrPro[1];
                    attributeArray.push(attribute);
                    propertyArray.push(property);
                }
            }
            var attPro = document.getElementById('input-form-create-attribute')
            attPro.value = myArray;
        }

        checkInput();

        function showDropdown(inputId, dropdownId) {
            var dropdownList = document.getElementById(dropdownId);
            if (dropdownList.style.display === "block") {
                dropdownList.style.display = "none";
            } else {
                dropdownList.style.display = "block";
            }
        }

        function updateSelectedOptions(checkbox, inputId, dropdownId) {
            var selectedOptionsInput = document.getElementById(inputId);
            var selectedLabels = Array.from(document.querySelectorAll('#' + dropdownId + ' input[type="checkbox"]:checked'))
                .map(function (checkbox) {
                    return checkbox.nextSibling.textContent.trim();
                });
            selectedOptionsInput.value = selectedLabels.join(", ");
        }


        $(function () {
            $('input.img-cfg').change(function () {
                const label = $(this).parent().find('span');
                let name = '';
                if (typeof (this.files) != 'undefined') {
                    let lengthListImg = this.files.length;
                    if (lengthListImg === 0) {
                        label.removeClass('withFile').text(label.data('default'));
                    } else {
                        name = lengthListImg === 1 ? lengthListImg + ' file' : lengthListImg + ' files';
                        let size = 0;
                        for (let i = 0; i < this.files.length; i++) {
                            const file = this.files[i];
                            let sizeImg = (file.size / 1048576).toFixed(3);
                            size = size + Number(sizeImg);
                        }
                        label.addClass('withFile').text(name + ' (' + size + 'mb)');
                    }
                } else {
                    name = this.value.split("\\");
                    label.addClass('withFile').text(name[name.length - 1]);
                }
                return false;
            });
        });

        function create_custom_dropdowns() {
            $('select').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select')) {
                    $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });

            $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
        }

        // Event listeners

        // Open/close
        $(document).on('click', '.dropdown-select', function (event) {
            if ($(event.target).hasClass('dd-searchbox')) {
                return;
            }
            $('.dropdown-select').not($(this)).removeClass('open');
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        // Close when clicking outside
        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select').length === 0) {
                $('.dropdown-select').removeClass('open');
                $('.dropdown-select .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        function filter() {
            var valThis = $('#txtSearchValue').val();
            $('.dropdown-select ul > li').each(function () {
                var text = $(this).text();
                (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
            });
        };
        // Search

        // Option click
        $(document).on('click', '.dropdown-select .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select').find('.current').text(text);
            $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
        });

        // Keyboard events
        $(document).on('keydown', '.dropdown-select', function (event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).ready(function () {
            create_custom_dropdowns();
        });
    </script>
@endsection
