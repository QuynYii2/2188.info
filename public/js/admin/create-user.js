$(document).ready(function () {
    $('.inputCheckboxCategory').on('click', function () {
        let count = document.querySelectorAll('.inputCheckboxCategory:checked').length
        if (count > 3) {
            $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', true);
        } else {
            $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', false);
        }
    })

    $('.inputCheckboxCategory1').on('click', function () {
        let count = document.querySelectorAll('.inputCheckboxCategory1:checked').length
        if (count > 3) {
            $('.inputCheckboxCategory1:checkbox:not(:checked)').prop('disabled', true);
        } else {
            $('.inputCheckboxCategory1:checkbox:not(:checked)').prop('disabled', false);
        }
    })
})

function getDate() {
    let nowTime = new Date().toLocaleDateString('en-GB');
    $('#datetime_register').val(nowTime);
}

getDate();
var expanded = false;

function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        window.addEventListener('click', function (e) {
            var div = document.getElementById('div-click');
            if (checkboxes.contains(e.target) || div.contains(e.target)) {
                $('#div-click').on('click', function () {
                    if (!expanded) {
                        checkboxes.style.display = "block";
                        expanded = true;
                    } else {
                        checkboxes.style.display = "none";
                        expanded = false;
                    }
                });
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        })
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}

var expanded1 = false;

function showCheckboxes1() {
    var checkboxes1 = document.getElementById("type_business_checkboxes");
    if (!expanded) {
        window.addEventListener('click', function (e) {
            let div = document.getElementById('type_business_click');
            if (checkboxes1.contains(e.target) || div.contains(e.target)) {
                $('#type_business_click').on('click', function () {
                    if (!expanded) {
                        checkboxes1.style.display = "block";
                        expanded = true;
                    } else {
                        checkboxes1.style.display = "none";
                        expanded = false;
                    }
                });
            } else {
                checkboxes1.style.display = "none";
                expanded = false;
            }
        })
        checkboxes1.style.display = "block";
        expanded = true;
    } else {
        checkboxes1.style.display = "none";
        expanded = false;
    }
}

const ID_COUNTRY = 'countries-select'
const ID_STATE = 'cities-select'
const ID_CITY = 'provinces-select'
const ID_WARD = 'wards-select'

const ID_COUNTRY_1 = 'countries-select-1'
const ID_STATE_1 = 'cities-select-1'
const ID_CITY_1 = 'provinces-select-1'
const ID_WARD_1 = 'wards-select-1'

let country_code = ''
let city_code = ''
getListNation();
getListNation1();

function getListNation() {
    fetch(url)
        .then(async function (res) {
            const data = await res.json();
            makeHTMLFromJson(data, ID_COUNTRY)
            autoSelectedOption(ID_STATE)
        });
}

function getListState(id) {
    urla = urla.replace(':id', id);
    country_code = id;
    fetch(urla)
        .then(async function (res) {
            clearDataOption();
            const data = await res.json();
            makeHTMLFromJson(data, ID_STATE)
            autoSelectedOption(ID_CITY)
        });
}

function getListCity(id) {
    urlb = urlb.replace(':id', id);
    urlb = urlb.replace(':code', country_code);
    fetch(urlb)
        .then(async function (res) {
            const data = await res.json();
            makeHTMLFromJson(data, ID_CITY)
            // autoSelectedOption(ID_WARD)
        });
}

function getListNation1() {
    fetch(urlc)
        .then(async function (res) {
            const data = await res.json();
            makeHTMLFromJson(data, ID_COUNTRY_1)
            autoSelectedOption(ID_STATE_1)
        });
}

function getListState1(id) {
    urld = urld.replace(':id', id);
    country_code = id;
    fetch(urld)
        .then(async function (res) {
            clearDataOption1();
            const data = await res.json();
            makeHTMLFromJson(data, ID_STATE_1)
            autoSelectedOption(ID_CITY_1)
        });
}

function getListCity1(id) {
    urle = urle.replace(':id', id);
    urle = urle.replace(':code', country_code);
    fetch(urle)
        .then(async function (res) {
            const data = await res.json();
            makeHTMLFromJson(data, ID_CITY_1)
            // autoSelectedOption(ID_WARD_1)
        });
}

function makeHTMLFromJson(data, id_where) {
    const selectElement = document.getElementById(id_where);
    selectElement.innerHTML = '';


    data.forEach(option => {
        const optionElement = document.createElement('option');

        optionElement.value = getValueForOption(option);

        optionElement.textContent = option.name;

        selectElement.appendChild(optionElement);
    })
}

function clearDataOption() {
    document.getElementById(ID_STATE).innerHTML = '';
    document.getElementById(ID_CITY).innerHTML = '';
    // document.getElementById(ID_WARD).innerHTML = '';
}

function clearDataOption1() {
    document.getElementById(ID_STATE_1).innerHTML = '';
    document.getElementById(ID_CITY_1).innerHTML = '';
    // document.getElementById(ID_WARD_1).innerHTML = '';
}

function autoSelectedOption(id_where) {
    const optionSelect = document.getElementById(id_where);
    if (optionSelect.options.length > 0) {
        optionSelect.options[0].selected = true;
    }
}

function getValueForOption(option) {
    if (option.iso2) {
        return option.iso2;
    }
    if (option.city_code) {
        return option.city_code
    }
    if (option.state_code) {
        return option.state_code
    }
    return option.id;
}

