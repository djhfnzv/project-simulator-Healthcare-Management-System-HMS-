<?php
require_once '../../DB/dbUser.php';
$con = connection();

$message = "";

if (isset($_POST['cancel'])) {

    $id = $_POST['appointment_id'];

    mysqli_query(
        $con,
        "update appointmentsandbill
         set status='cancelled'
         where id='$id'"
    );

    $message = "Appointment cancelled successfully!";
}

if (isset($_POST['reschedule'])) {

    $id   = $_POST['appointment_id'];
    $day  = $_POST['day'];
    $time = $_POST['timeSlot'];

    mysqli_query(
        $con,
        "update appointmentsandbill
         set day='$day', timeSlot='$time'
         where id='$id'"
    );

    $message = "Appointment rescheduled successfully!";
}

$appointments = mysqli_query(
    $con,
    "select * from appointmentsandbill order by id desc"
);
