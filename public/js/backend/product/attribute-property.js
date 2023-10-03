$(document).ready(function () {
    async function renderAttribute() {
        let url = urlAllAttribute;

        await $.ajax({
            url: url,
            method: 'GET',
        })
            .done(function (response) {
                $('#formRenderAttribute').append(response);
            })
            .fail(function (_, textStatus) {
                console.log(textStatus)
            });
    }

    renderAttribute();

    async function createAttributeItem() {
        let url = urlCreateAttribute;
        let value = $('#attribute_name').val();

        if (value && value != '') {
            await $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: token,
                    attribute_name: value
                },
            })
                .done(function (response) {
                    alert('Success');
                    $('#formRenderAttribute').empty();
                    renderAttribute();
                })
                .fail(function (_, textStatus) {
                    alert('Error');
                    console.log(textStatus)
                });
        } else {
            alert('Please enter attribute name!')
        }
    }

    $('#btnSubmitAttribute').on('click', function () {
        createAttributeItem();
    })

    $('#btnCloseAttribute').on('click', function () {
        $('#formAddAttribute').addClass('d-none');
    })

    $('#btnSaveAttribute').on('click', function () {
        let removeInputAttribute = $('#removeInputAttribute');
        if (removeInputAttribute) {
            removeInputAttribute.empty();
        }
        let attribute = document.getElementById('input-form-create-attribute').value;
        var renderInputAttribute = $('#renderInputAttribute');
        $.ajax({
            url: urlProductCreateAttribute,
            type: 'POST',
            data: {
                _token: token,
                'attribute_property': attribute
            },
            success: function (response) {
                renderInputAttribute.empty().append(response);
            },
            error: function (xhr, status, error) {
                renderInputAttribute.append('<h3>Error</h3>');
            }
        })
    })

})


$(document).ready(function () {
    let myArray = [];
    $('#selectAttribute').on('change', function () {
        let attribute = $(this).data('id');
        let attributeID = $(this).val();
        let value = null;
        if (myArray.length == 0) {
            myArray.push(attributeID);
            value = attributeID;
        } else {
            let check = myArray.includes(attributeID);
            if (!check) {
                myArray.push(attributeID);
                value = attributeID;
            }
        }

        if (value) {
            renderProperty(value);
        }

    })

    $('#btnCreateAttribute').on('click', function () {
        $('#formAddAttribute').removeClass('d-none');
    })

    async function renderProperty(attributeID) {
        let url = urlGetPropertyByAttribute;
        url = url.replace(':id', attributeID);

        await $.ajax({
            url: url,
            method: 'GET',
        })
            .done(function (response) {
                $('#formRenderProperty').append(response);
            })
            .fail(function (_, textStatus) {
                console.log(textStatus)
            });
    }
})

async function createProperty() {
    let url = urlCreateProperty;
    let property_name = $('#property_name').val();
    let attribute_id = $('#attribute_id').val();

    await $.ajax({
        url: url,
        method: 'POST',
        data: {
            _token: token,
            property_name: property_name,
            attribute_id: attribute_id
        },
    })
        .done(function (response) {
            alert('Success');
            let item = $('#property_' + attribute_id);
            item.empty().append(response);
            $('#formAddProperty').addClass('d-none');
        })
        .fail(function (_, textStatus) {
            alert('Error');
            console.log(textStatus)
        });
}

$('#btnSubmitProperty').on('click', function () {
    createProperty();
})

