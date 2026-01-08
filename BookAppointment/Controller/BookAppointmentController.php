<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}

$con = connection();

$selectedSpeciality = $_POST['speciality'] ?? '';
$selectedDoctor     = $_POST['doctor'] ?? '';
$selectedDay        = $_POST['day'] ?? '';
$selectedTime       = $_POST['timeSlot'] ?? '';
$fee = '';

$specialities = mysqli_query(
    $con,
    "select distinct speciality from doctorschedule"
);

$doctorQuery = "select distinct doctorName from doctorschedule";
if ($selectedSpeciality != '') {
    $doctorQuery .= " where speciality='$selectedSpeciality'";
}
$doctors = mysqli_query($con, $doctorQuery);


$days = null;
if ($selectedDoctor != '') {
    $days = mysqli_query(
        $con,
        "select distinct day from doctorschedule
         where doctorName='$selectedDoctor'"
    );
}

$timeQuery = null;
if ($selectedDoctor != '' && $selectedDay != '') {

    $timeQuery = mysqli_query(
        $con,
        "select timeSlot, appointmentFee
         from doctorschedule
         where doctorName='$selectedDoctor'
         and day='$selectedDay'"
    );

    $row = mysqli_fetch_assoc($timeQuery);
    $fee = $row['appointmentFee'] ?? '';
}

$message = "";


if (isset($_POST['book'])) {

    if (
        empty($selectedSpeciality) ||
        empty($selectedDoctor) ||
        empty($selectedDay) ||
        empty($selectedTime)
    ) {
        $message = "All fields are required!";
    } 
    else {

        $patientEmail = $_SESSION['user']['email'];
        $patientName  = $_SESSION['user']['name'];

        $checkQuery = "
            select id from appointmentsandbill
            where doctorName='$selectedDoctor'
            and day='$selectedDay'
            and timeSlot='$selectedTime'
            and status!='cancelled' ";

        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) > 30) {
            $message = "This slot is already booked!";
        } 
        else {

            $insertQuery = "
                insert into appointmentsandbill
                (patientName, patientEmail, doctorName, speciality, day, timeSlot, appointmentFee, status)
                values
                ('$patientName','$patientEmail','$selectedDoctor',
                 '$selectedSpeciality','$selectedDay','$selectedTime',
                 '$fee','confirmed')
            ";

            if (mysqli_query($con, $insertQuery)) {
                $message = "Appointment booked successfully!";
            } else {
                $message = "Booking failed!";
            }
        }
    }
}
