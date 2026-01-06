document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        // Get input values
        let name = document.querySelector("input[name='name']").value;
        let dob = document.querySelector("input[name='dob']").value;
        let age = document.querySelector("input[name='age']").value;
        let email = document.querySelector("input[name='email']").value;
        let password = document.querySelector("input[name='password']").value;
        let phone = document.querySelector("input[name='phone']").value;
        let bloodGroup = document.querySelector("select[name='bloodGroup']").value;
        let genderMale = document.querySelector("input[name='gender'][value='Male']").checked;
        let genderFemale = document.querySelector("input[name='gender'][value='Female']").checked;

        // Clear previous error messages
        let errorElements = document.querySelectorAll(".error");
        errorElements.forEach(function(el) { el.innerHTML = ""; });

        let isValid = true;

        // Name validation
        if (name === "") {
            showError("nameError", "Name is required");
            isValid = false;
        }

        // DOB validation
        if (dob === "") {
            showError("dobError", "Date of Birth is required");
            isValid = false;
        }

        // Age validation
        if (age === "") {
            showError("ageError", "Age is required");
            isValid = false;
        } else if (isNaN(age) || age <= 0) {
            showError("ageError", "Age must be a valid number");
            isValid = false;
        }

        // Email validation
        if (email === "") {
            showError("emailError", "Email is required");
            isValid = false;
        } else if (!email.includes("@") || !email.includes(".")) {
            showError("emailError", "Invalid email format");
            isValid = false;
        }

        // Password validation
        if (password === "") {
            showError("passwordError", "Password is required");
            isValid = false;
        } else if (password.length < 6) {
            showError("passwordError", "Password must be at least 6 characters");
            isValid = false;
        }

        // Phone validation
        if (phone === "") {
            showError("phoneError", "Phone number is required");
            isValid = false;
        } else if (isNaN(phone) || phone.length < 11) {
            showError("phoneError", "Invalid phone number");
            isValid = false;
        }

        // Blood group validation
        if (bloodGroup === "") {
            showError("bloodGroupError", "Please select blood group");
            isValid = false;
        }

        // Gender validation
        if (!genderMale && !genderFemale) {
            showError("genderError", "Please select gender");
            isValid = false;
        }

        // Submit form if valid
        if (isValid) {
            form.submit();
        }
    });

    // Helper function to display errors
    function showError(id, message) {
        let el = document.getElementById(id);
        if (el) {
            el.innerHTML = message;
        } else {
            alert(message); // fallback
        }
    }

});
