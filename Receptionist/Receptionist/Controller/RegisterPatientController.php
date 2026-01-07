<?php
session_start();
require_once '../../DB/dbUser.php';

$con = connection();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name       = trim($_POST['name'] ?? '');
    $age        = trim($_POST['age'] ?? '');
    $bloodGroup = trim($_POST['bloodGroup'] ?? '');
    $gender     = trim($_POST['gender'] ?? '');
    $dob        = trim($_POST['dob'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $password   = trim($_POST['password'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');

    $role       = 'Patient';
    $speciality = '';
    $image      = '';


    if (
        empty($name) || empty($age) || empty($bloodGroup) ||
        empty($gender) || empty($dob) || empty($email) ||
        empty($password) || empty($phone)
    ) {
        $message = "All fields are required!";
    }
    elseif (!is_numeric($age) || $age <= 0) {
        $message = "Invalid age!";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
    }
    elseif (!is_numeric($phone) || strlen($phone) < 11) {
        $message = "Invalid phone number!";
    }
    else {

        $check = mysqli_query(
            $con,
            "select id from users where email='$email' or mobile='$phone'"
        );

        if (mysqli_num_rows($check) > 0) {
            $message = "Email or phone already exists!";
        }
        else {

            $query = "
                insert into users
                (name, age, dob, gender, bloodgroup, email, password, mobile, role, speciality, image)
                values
                ('$name','$age','$dob','$gender','$bloodGroup',
                 '$email','$password','$phone','$role','$speciality','$image')
            ";

            if (mysqli_query($con, $query)) {
                $_SESSION['success'] = "Patient registered successfully!";
                header("Location: registerPatient.php");
                exit();
            } else {
                $message = "Failed to register patient!";
            }
        }
    }
}

if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
}
