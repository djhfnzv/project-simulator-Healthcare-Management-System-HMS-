function validateLogin() {

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");

    emailError.innerHTML = "";
    passwordError.innerHTML = "";

    let isValid = true;

    if (email === "") {
        emailError.innerHTML = "Email is required";
        isValid = false;
    } else if (!email.includes("@") || !email.includes(".")) {
        emailError.innerHTML = "Invalid email format";
        isValid = false;
    }

    if (password === "") {
        passwordError.innerHTML = "Password is required";
        isValid = false;
    }

    return isValid;
}
