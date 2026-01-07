<?php
session_start();
require_once '../../DB/dbUser.php';

$con = connection();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name       = $_POST['name'];
    $age        = $_POST['age'];
    $bloodGroup = $_POST['bloodGroup'];
    $gender     = $_POST['gender'];
    $dob        = $_POST['dob'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $phone      = $_POST['phone'];

    $role       = 'Patient';
    $speciality = '';
    $image      = '';

    $query = "
        insert into users
        (name, age, dob, gender, bloodgroup, email, password, mobile, role, speciality, image)
        values
        ('$name','$age','$dob','$gender','$bloodGroup','$email','$password','$phone','$role','$speciality','$image')
    ";

    if (mysqli_query($con, $query)) {
        $_SESSION['success'] = "Patient registered successfully!";
        header("Location: registerPatient.php"); 
        exit();
    } else {
        $message = "Failed to register patient!";
    }
}

if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
}
