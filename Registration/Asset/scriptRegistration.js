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
        } else if (!isValidEmailManual(email)) {
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
            let gender = document.querySelector('input[name="gender"]:checked')?.value || '';
            let bloodGroup = document.getElementById("bloodGroup").value;

            let user = {
                'name': name,
                'dob': dob,
                'age': age,
                'gender': gender,
                'bloodGroup': bloodGroup,
                'email': email,
                'password': password,
                'confirmPassword': confirmPassword,
                'phone': phone
            };
            let data = JSON.stringify(user);
            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../Controller/registrationCheck.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('user=' + data);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    if (response.success) {
                        successMessage.innerHTML = response.message;
                        setTimeout(() => {
                            window.location.href = '../../Login/View/login.php';
                        }, 1000);
                    } else {
                        if (response.errors.name) nameError.innerHTML = response.errors.name;
                        if (response.errors.dob) alert(response.errors.dob); 
                        if (response.errors.age) ageError.innerHTML = response.errors.age;
                        if (response.errors.gender) alert(response.errors.gender); 
                        if (response.errors.bloodGroup) alert(response.errors.bloodGroup); 
                        if (response.errors.email) emailError.innerHTML = response.errors.email;
                        if (response.errors.password) passwordError.innerHTML = response.errors.password;
                        if (response.errors.confirmPassword) confirmError.innerHTML = response.errors.confirmPassword;
                        if (response.errors.phone) phoneError.innerHTML = response.errors.phone;
                    }
                }
            };
        }
    });

    function isValidEmailManual(email) {
        if (email.split('@').length !== 2) {
            return false;
        }

        let parts = email.split('@');
        let local = parts[0];
        let domain = parts[1];

        if (local.length === 0 || domain.length === 0) {
            return false;
        }

        if (domain.indexOf('.') === -1) {
            return false;
        }

        if (domain[0] === '.' || domain[domain.length - 1] === '.') {
            return false;
        }

        
        let lastChar = domain[domain.length - 1];
        let isLetter =
            (lastChar >= 'a' && lastChar <= 'z') ||
            (lastChar >= 'A' && lastChar <= 'Z');

        if (!isLetter) {
            return false;
        }

        return true;
    }

});
