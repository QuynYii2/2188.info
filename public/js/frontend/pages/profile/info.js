function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('avatarPreview');
        output.src = reader.result;
        output.style.backgroundSize = "cover";
    }
    reader.readAsDataURL(event.target.files[0]);
}

function checkPasswordMatch() {
    var newPassword = document.getElementsByName("new-password")[0].value;
    var renewPassword = document.getElementsByName("renew-password")[0].value;

    if (newPassword !== renewPassword) {
        alert("Mật khẩu mới và nhập lại mật khẩu không khớp nhau.");
    }
}

patternPhoneNumber();

function patternPhoneNumber() {
    let phoneNumberInput = document.getElementById('edit-phone-input');
    var patternVN = /^(84|0[3|5|7|8|9])+([0-9]{8})\b/;
    var patternDefault = /^\+(?:[0-9] ?){6,14}[0-9]$/;
    let phoneNumberPattern;
    const VN = 'vn';
    let regionUser = url;
    switch (regionUser) {
        case VN:
            phoneNumberPattern = patternVN;
            break;
        default:
            phoneNumberPattern = patternDefault;
    }

    phoneNumberInput.setAttribute('pattern', phoneNumberPattern.source);
}

var countrySelect = document.getElementById('country');
fetch('https://restcountries.com/v2/all')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        const regionUser = url;
        for (var i = 0; i < data.length; i++) {
            var option = document.createElement('option');
            let codeRegion = data[i].alpha2Code.toLowerCase();
            option.value = codeRegion;
            option.text = data[i].name;
            if (codeRegion === regionUser) {
                option.selected = true;
            }
            countrySelect.add(option);
        }
    })
    .catch(function (error) {

    });
