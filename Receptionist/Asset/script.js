document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        let name = document.getElementById("name").value;
        let dob = document.getElementById("dob").value;
        let age = document.getElementById("age").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirmPassword").value;
        let phone = document.getElementById("phone").value;

        let nameError = document.getElementById("nameError");
        let ageError = document.getElementById("ageError");
        let emailError = document.getElementById("emailError");
        let passwordError = document.getElementById("passwordError");
        let confirmError = document.getElementById("confirmError");
        let phoneError = document.getElementById("phoneError");
        let successMessage = document.getElementById("successMessage");

        nameError.innerHTML = "";
        ageError.innerHTML = "";
        emailError.innerHTML = "";
        passwordError.innerHTML = "";
        confirmError.innerHTML = "";
        phoneError.innerHTML = "";
        successMessage.innerHTML = "";

        let isValid = true;

        // Name validation
        if (name === "") {
            nameError.innerHTML = "Name is required";
            isValid = false;
        }

        // DOB validation
        if (dob === "") {
            alert("Date of Birth is required");
            isValid = false;
        }

        // Age validation
        if (age === "") {
            ageError.innerHTML = "Age is required";
            isValid = false;
        } else if (isNaN(age) || age <= 0) {
            ageError.innerHTML = "Age must be a valid number";
            isValid = false;
        }

        // Email validation
        if (email === "") {
            emailError.innerHTML = "Email is required";
            isValid = false;
        } else if (!email.includes("@") || !email.includes(".")) {
            emailError.innerHTML = "Invalid email format";
            isValid = false;
        }

        // Password validation
        if (password === "") {
            passwordError.innerHTML = "Password is required";
            isValid = false;
        } else if (password.length < 6) {
            passwordError.innerHTML = "Password must be at least 6 characters";
            isValid = false;
        }

        // Confirm password validation
        if (confirmPassword === "") {
            confirmError.innerHTML = "Confirm password is required";
            isValid = false;
        } else if (password !== confirmPassword) {
            confirmError.innerHTML = "Passwords do not match";
            isValid = false;
        }

        // Phone validation
        if (phone === "") {
            phoneError.innerHTML = "Phone number is required";
            isValid = false;
        } else if (isNaN(phone) || phone.length < 11) {
            phoneError.innerHTML = "Invalid phone number";
            isValid = false;
        }

        if (isValid) {
            successMessage.innerHTML = "Registration successful!";
            form.submit();
        }
    });
});
