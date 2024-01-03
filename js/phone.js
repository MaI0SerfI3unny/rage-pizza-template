document.addEventListener('DOMContentLoaded', function () {
    // Инициализация
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
        initialCountry: "auto",
        separateDialCode: true,
    });
    iti.setCountry("ua");
    iti.promise.then(function () {
        input.addEventListener("countrychange", function () {
            var countryData = iti.getSelectedCountryData();
            console.log(countryData.dialCode);
        });
    });
});
