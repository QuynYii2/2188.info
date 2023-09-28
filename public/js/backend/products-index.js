    $(document).ready(function () {
    $(".inputHotCheckbox").click(function () {
        var productID = $(this).val();
        var modalId = 'exampleModal-' + this.value;
        var checkboxId = 'inputHot-' + this.value;
        var unCheck = document.getElementById(checkboxId);
        var originalChecked = this.checked;
        var modal = document.getElementById(modalId);
        async function setProductHots(productID) {
            url = url.replace(':productID', productID);

            try {
                await $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        console.log('success')
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
                        console.log(exception)
                    }
                });
            } catch (error) {
                throw error;
            }
        }

        setProductHots(productID);
    });
    $(".inputFeatureCheckbox").click(function () {
    var productID = jQuery(this).val();
    var modalId = 'exampleModal-' + this.value;
    var checkboxId = 'inputFeature-' + this.value;
    var unCheck = document.getElementById(checkboxId);
    var originalChecked = this.checked;
    var modal = document.getElementById(modalId);
    async function setProductFeatures(productID) {

    urla = urla.replace(':productID', productID);

    try {
    await $.ajax({
    url: urla,
    method: 'POST',
    data: {
    _token: '{{ csrf_token() }}'
},
    success: function (response) {
    console.log('success')
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
    console.log(exception)
}
});
} catch (error) {
    throw error;
}
}

    setProductFeatures(productID);
});
});


    function checkHotAndFeature(id) {
    var hot = document.getElementById('inputHotProduct' + id);
    var feature = document.getElementById('inputFeatureProduct' + id);
    console.log(hot, feature);
    if (hot.value == 1) {
    document.getElementById("hot_product" + id).checked = true;
}
    if (feature.value == 1) {
    document.getElementById("feature_product" + id).checked = true;
}

    callFunction(id);
}




    function callFunction(id) {
    var properties = document.getElementsByClassName('property-attribute')
    var number = properties.length

    var priceInput = document.getElementById('price' + id);
    var qtyInput = document.getElementById('qty' + id);

    qtyInput.addEventListener('input', function () {
    var price = parseFloat(priceInput.value);
    var qty = parseFloat(qtyInput.value);

    if (qty > price) {
    alert('Giá khuyến mãi không được lớn hơn giá bán.');
    qtyInput.value = ''; // Xóa giá trị khuyến mãi
}
});

    myID = id;

    function checkInput(myID) {
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
    var attPro = document.getElementById('input-form-create-attribute' + myID)
    attPro.value = myArray;
}

    checkInput(myID);

    $('[data-fancybox]').fancybox({
    buttons: [
    'close'
    ],
    wheel: false,
    transitionEffect: "slide",
    loop: true,
    toolbar: false,
    clickContent: false
});

    qtyInput.addEventListener('input', function () {
    var price = parseFloat(priceInput.value);
    var qty = parseFloat(qtyInput.value);

    if (qty > price) {
    alert('Giá khuyến mãi không được lớn hơn giá bán.');
    qtyInput.value = ''; // Xóa giá trị khuyến mãi
}
});
}


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
