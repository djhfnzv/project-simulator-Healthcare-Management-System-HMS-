<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}
$con = connection();

$patientEmail = $_SESSION['user']['email'];
$message = "";

if (isset($_POST['cancel'])) {

    $appointmentId = $_POST['appointment_id'];

    $query = "
        update appointmentsandbill
        set status='cancelled'
        where id='$appointmentId'
        and patientEmail='$patientEmail'
    ";

    if (mysqli_query($con, $query)) {
        $message = "Appointment cancelled successfully!";
    } else {
        $message = "Failed to cancel appointment!";
    }
}

$result = mysqli_query(
    $con,
    "select * from appointmentsandbill
     where patientEmail='$patientEmail'
     order by id desc"
);
