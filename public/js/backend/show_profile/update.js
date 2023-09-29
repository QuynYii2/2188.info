
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('avatarPreview');
        output.src = reader.result;
        output.style.backgroundSize = "cover";
    }
    reader.readAsDataURL(event.target.files[0]);
}

var countrySelect = document.getElementById('country');
fetch('https://restcountries.com/v2/all')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        const regionUser = "{{ Auth::user()->region }}";
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
        console.log(error);
    });


