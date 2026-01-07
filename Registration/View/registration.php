<?php
    session_start();
?>
<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../Asset/cssRegistration.css">
    </head>
    <body>
        <script src="../Asset/scriptRegistration.js"></script>

        <fieldset>
            <h1>User Registration</h1>
                <form action="../Controller/registrationCheck.php" method="post">
                    <table>
                        <tr>
                            <td>Name :</td>
                            <td>
                                <input type="text" id="name" name="name" required>
                                <div id="nameError" style="color:red;"></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Age :</td>
                            <td>
                                <input type="text" id="age" name="age" required>
                                <div id="ageError" style="color:red;"></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Blood Group :</td>
                            <td>
                                <select id="bloodGroup" name="bloodGroup" required>
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Gender :</td>
                            <td>
                                <input type="radio" name="gender" value="Male" required> Male
                                <input type="radio" name="gender" value="Female"> Female
                            </td>
                        </tr>

                        <tr>
                            <td>Date of Birth :</td>
                            <td>
                                <input type="date" id="dob" name="dob" required>
                            </td>
                        </tr>

                        <tr>
                            <td>Email :</td>
                            <td>
                                <input type="text" id="email" name="email" required>
                                <div id="emailError" style="color:red;"></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Password :</td>
                            <td>
                                <input type="password" id="password" name="password" required>
                                <div id="passwordError" style="color:red;"></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Confirm Password :</td>
                            <td>
                                <input type="password" id="confirmPassword" name="confirmPassword" required>
                                <div id="confirmError" style="color:red;"></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Phone Number :</td>
                            <td>
                                <input type="text" id="phone" name="phone" required>
                                <div id="phoneError" style="color:red;"></div>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Register"><div id="successMessage" style="color:green;"></div>
                </form>
                <form action="../../Login/View/login.php">
                    <input type="submit" value="Login">
                </form>
        </fieldset>
    </body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let form = document.querySelector("form");
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            // ...existing validation code...

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
                           