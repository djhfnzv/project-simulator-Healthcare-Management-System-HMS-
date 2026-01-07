document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("searchForm");
    const phoneInput = document.getElementById("phone");
    const phoneError = document.getElementById("phoneError");

    form.addEventListener("submit", function (e) {

        phoneError.innerHTML = "";

        let phone = phoneInput.value.trim();
        let isValid = true;

        // Phone empty check
        if (phone === "") {
            phoneError.innerHTML = "Phone number is required";
            isValid = false;
        }

        // Phone must be numeric
        if (isValid && isNaN(phone)) {
            phoneError.innerHTML = "Phone number must contain only numbers";
            isValid = false;
        }

        // Phone length check
        if (isValid && phone.length < 11) {
            phoneError.innerHTML = "Phone number must be at least 11 digits";
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // stop form submit
        }
    });
});
