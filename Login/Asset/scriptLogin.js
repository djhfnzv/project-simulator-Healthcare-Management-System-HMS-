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

function ajaxLogin() {
    if (!validateLogin()) {
        return false;
    }

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let user = { 'email': email, 'password': password };
    let data = JSON.stringify(user);
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../Controller/loginCheck.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('user=' + data);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            if (response.success) {
                document.getElementById('successMessage').innerHTML = response.message;
                setTimeout(() => {
                    window.location.href = '../../Role_Based_Access_Control/Controller/homeRedirect.php';
                }, 1000);
            } else {
                document.getElementById('emailError').innerHTML = response.error;
            }
        }
    };
    return false;
}
