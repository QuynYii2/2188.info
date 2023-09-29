    var renderData = (array, select) => {
    let row = ' <option disable value="">Chọn</option>';
    array.forEach(element => {
    row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
});
    document.querySelector("#" + select).innerHTML = row
}

    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api, id) => {
    if (sessionStorage.hasOwnProperty('city')) {
    renderData(JSON.parse(sessionStorage.getItem('city')), id);
} else {
    return axios.get(api)
    .then((response) => {
    sessionStorage.setItem('city', JSON.stringify(response.data))
    renderData(response.data, id);
});
}
}
    callAPI('https://provinces.open-api.vn/api/?depth=1', 'city');
    var callApiDistrict = (api, id) => {
    return axios.get(api)
    .then((response) => {
    renderData(response.data.districts, id);
});
}
    var callApiWard = (api, id) => {
    return axios.get(api)
    .then((response) => {
    renderData(response.data.wards, id);
});
}


    $("#city").change(() => {
    callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2", 'district');
});
    $("#district").change(() => {
    callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2", "ward");
});
    $("#city-edit").change(() => {
    callApiDistrict(host + "p/" + $("#city-edit").find(':selected').data('id') + "?depth=2", 'province-edit');
});
    $("#province-edit").change(() => {
    callApiWard(host + "d/" + $("#province-edit").find(':selected').data('id') + "?depth=2", "location-edit");
});

    async function editModal(obj) {
    callAPI('https://provinces.open-api.vn/api/?depth=1', 'city-edit');

    document.getElementById('id-edit').value = obj.id;
    document.getElementById('username-edit').value = obj.username;
    document.getElementById('company-edit').value = obj.company;
    document.getElementById('phone-edit').value = obj.phone;

    document.getElementById('city-edit').value = obj.city;
    await callApiDistrict(host + "p/" + $("#city-edit").find(':selected').data('id') + "?depth=2", 'province-edit');
    document.getElementById('province-edit').value = obj.province;
    await callApiWard(host + "d/" + $("#province-edit").find(':selected').data('id') + "?depth=2", 'location-edit');
    document.getElementById('location-edit').value = obj.location;

    document.getElementById('address_detail-edit').textContent = obj.address_detail;

    var homeRadio = document.getElementById("address_option-edit-1");
    var companyRadio = document.getElementById("address_option-edit-2");
    let typeAdd = obj.address_option;

    if (typeAdd == "HOME_PRIVATE") {
    homeRadio.checked = true;
} else if (obj.address_option == "COMPANY") {
    companyRadio.checked = true;
}

    var checkbox = document.getElementById('default-edit');
    if (obj.default == 1) {
    checkbox.checked = true;
} else {
    checkbox.checked = false;
}

    let formInput = document.getElementById('formInput');
    formInput.action = "/address-update/" + obj.id;

}

