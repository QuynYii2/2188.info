$('#btnSaveAttribute').on('click', function () {
    let removeInputAttribute = $('#removeInputAttribute');
    if (removeInputAttribute) {
        removeInputAttribute.empty();
    }
    let attribute = document.getElementById('input-form-create-attribute').value;
    var renderInputAttribute = $('#renderInputAttribute');
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: token,
            'attribute_property': attribute
        },
        // dataType: 'json',
        success: function (response) {
            // var item = response;
            renderInputAttribute.append(response);
        },
        error: function (xhr, status, error) {
            renderInputAttribute.append('<h3>Error</h3>');
        }
    })
})


var properties = document.getElementsByClassName('property-attribute')
var number = properties.length

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
    localStorage.setItem('keys', myArray)
}

checkInput();

$(document).on('change', '.property-attribute', function () {
    checkInput();
});

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

function selectAllAttribute(id) {
    var listProperties = document.getElementsByClassName("checkbox" + id);

    for (let i = 0; i < listProperties.length; i++) {
        listProperties[i].click();
    }
    checkInput();
}

function removeAllAttribute(id) {
    var listProperties = document.getElementsByClassName("checkbox" + id);

    for (let i = 0; i < listProperties.length; i++) {
        listProperties[i].checked = false;
    }
    document.getElementById('attribute_property' + id).value = '';
}

function hiddenAttribute(id) {
    var attribute = document.getElementById("attributeID_" + id);
    attribute.classList.add("d-none");
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
    $('#selectStorage').each(function (i, select) {
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

    $('#selectAttribute').each(function (i, select) {
        if (!$(this).next().hasClass('dropdown-select-attribute')) {
            $(this).after('<div class="dropdown-select-attribute wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
            var dropdown = $(this).next();
            var options = $(select).find('option');
            var selected = $(this).find('option:selected');
            dropdown.find('.current').html(selected.data('display-text') || selected.text());
            options.each(function (j, o) {
                var display = $(o).data('display-text') || '';
                dropdown.find('ul').append('<li class="option attribute-create ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
            });
        }
    });

    $('.dropdown-select-attribute ul').before('<div class="dd-search"><input id="txtSearchAttribute" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
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

$(document).on('click', '.dropdown-select-category', function (event) {
    if ($(event.target).hasClass('dd-searchbox')) {
        return;
    }
    $('.dropdown-select-category').not($(this)).removeClass('open');
    $(this).toggleClass('open');
    if ($(this).hasClass('open')) {
        $(this).find('.option').attr('tabindex', 0);
        $(this).find('.selected').focus();
    } else {
        $(this).find('.option').removeAttr('tabindex');
        $(this).focus();
    }
});

$(document).on('click', '.dropdown-select-attribute', function (event) {
    if ($(event.target).hasClass('dd-searchbox')) {
        return;
    }
    $('.dropdown-select-attribute').not($(this)).removeClass('open');
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

$(document).on('click', function (event) {
    if ($(event.target).closest('.dropdown-select-category').length === 0) {
        $('.dropdown-select-category').removeClass('open');
        $('.dropdown-select-category .option').removeAttr('tabindex');
    }
    event.stopPropagation();
});

$(document).on('click', function (event) {
    if ($(event.target).closest('.dropdown-select-attribute').length === 0) {
        $('.dropdown-select-attribute').removeClass('open');
        $('.dropdown-select-attribute .option').removeAttr('tabindex');
    }
    event.stopPropagation();
});

function filter() {
    var valThis = $('#txtSearchValue').val();
    $('.dropdown-select ul > li').each(function () {
        var text = $(this).text();
        (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
    });

    var valThisCategoey = $('#txtSearchCategory').val();
    $('.dropdown-select-category ul > li').each(function () {
        var text = $(this).text();
        (text.toLowerCase().indexOf(valThisCategoey.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
    });

    var valThisAttribute = $('#txtSearchAttribute').val();
    $('.dropdown-select-attribute ul > li').each(function () {
        var text = $(this).text();
        (text.toLowerCase().indexOf(valThisAttribute.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
    });
}

// Search

// Option click
$(document).on('click', '.dropdown-select .option', function (event) {
    $(this).closest('.list').find('.selected').removeClass('selected');
    $(this).addClass('selected');
    var text = $(this).data('display-text') || $(this).text();
    $(this).closest('.dropdown-select').find('.current').text(text);
    $(this).closest('.dropdown-select').prev('#selectStorage').val($(this).data('value')).trigger('change');
});

$(document).on('click', '.dropdown-select-attribute .option', function (event) {
    $(this).closest('.list').find('.selected').removeClass('selected');
    $(this).addClass('selected');
    var text = $(this).data('display-text') || $(this).text();
    $(this).closest('.dropdown-select-attribute').find('.current').text(text);
    // $(this).closest('.dropdown-select-attribute').prev('#selectCategory').val($(this).data('value')).trigger('change');

    let attributeID = $(this).attr('data-value');
    var attribute = document.getElementById("attributeID_" + attributeID);
    attribute.classList.remove("d-none");
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

$(document).on('keydown', '.dropdown-select-category', function (event) {
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

$(document).on('keydown', '.dropdown-select-attribute', function (event) {
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


var expanded = false;

function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    var div = document.getElementById('div-click');
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
        window.addEventListener('click', function (e) {
            if (checkboxes.contains(e.target) || div.contains(e.target)) {
                div.on('click', function () {
                    checkboxes.style.display = "block";
                    expanded = true;
                });
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        })
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}


function showFormEdit(id) {
    var formEdit = document.getElementById('formCreate' + id);
    formEdit.classList.remove('d-none');
}

$('#btnSubmit').on('click', function () {
    checkValue();
})

function checkValue() {
    var inputValue = document.getElementsByClassName('value-check');
    for (let i = 0; i < inputValue.length; i++) {
        if (inputValue[i].value == '') {
            alert('Vui lòng nhập đầy đủ thông tin sản phẩm')
            break;
        }
    }
}

function validInput(id) {
    var priceInput = document.getElementById('price' + id);
    var qtyInput = document.getElementById('qty' + id);

    function checkPrice() {
        var price = parseFloat(priceInput.value);
        var qty = parseFloat(qtyInput.value);

        if (qty > price) {
            alert('Giá khuyến mãi không được lớn hơn giá bán.');
            qtyInput.value = '';
        }
    }
}


$('.property-attribute').on('change', function () {
    var tests = document.getElementsByClassName('property-attribute');
    var btn = document.getElementById('btnSaveAttribute');
    var isValid = false;
    for (let i = 0; i < tests.length; i++) {
        if (tests[i].checked) {
            isValid = true;
        }
    }
    if (isValid == true) {
        btn.style.display = 'block';
    } else {
        btn.style.display = 'none';
    }
})


$('.add-fields').each(function (index, el) {
    var warp = $(this);
    var target = $(this).data('af_target') || '.content';
    var index = $(target).children('div, tr').length;
    var baseEl = $($(this).data('af_base')) || $(target).find('.form-field-base');
    var base = baseEl.html();
    baseEl.remove();
    //alert(base);

    warp.find(target).append(base.replace('.form-price', index));
    index++;

    warp.on('click', '.add-form-field', function (e) {
        e.preventDefault();
        warp.find(target).append(base.replace('.form-price', index));
        index++;
    });

    warp.on('click', '.remove-form-field', function (e) {
        e.preventDefault();
        $(this).parents($(this).data('target') || '.form-group-price').remove();
    });
});

$(document).ready(function () {
    $(".unregister").click(function () {
        var categoryID = $(this).val();
        var modalId = 'exampleModal-' + this.value;
        var checkboxId = 'category-' + this.value;
        var unCheck = document.getElementById(categoryID);
        var originalChecked = this.checked;
        var modal = document.getElementById(modalId);
        console.log(categoryID);

        async function setProductHots(categoryID) {
            let url = urlCategory;
            url = url.replace(':categoryID', categoryID);
            try {
                await $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: token
                    },
                    success: function (response) {
                        console.log(!response.id)
                        if (!response.id) {
                            var modal = document.getElementById(modalId);
                            $(modal).modal('show');

                            var confirmButton = document.querySelector('#' + modalId + ' .btn-primary');
                            confirmButton.addEventListener('click', function () {
                                var checkbox = document.getElementById(checkboxId);
                                checkbox.checked = true;
                                $(modal).modal('hide');
                            });

                            // Xử lý sự kiện đóng Modal
                            $(modal).on('hidden.bs.modal', function () {
                                var checkbox = document.getElementById(checkboxId);
                                if (checkbox.checked !== originalChecked) {
                                    checkbox.checked = originalChecked;
                                }
                                $(unCheck).prop('checked', false);

                            });
                        }
                    },
                    error: function (exception) {

                    }
                });
            } catch (error) {
                throw error;
            }
        }

        setProductHots(categoryID);
    });
})
