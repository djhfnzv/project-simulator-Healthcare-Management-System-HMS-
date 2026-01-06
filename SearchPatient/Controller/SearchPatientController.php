<?php
session_start();
require_once '../../DB/dbUser.php';

$con = connection();

$patient       = null;
$appointments  = null;
$billHistory   = null;
$showBill      = false;
$phone         = '';

if (isset($_POST['search']) || isset($_POST['bill_history']))
{

    $phone = $_POST['phone'];

    $patient = mysqli_query(
        $con,
        "select * from users
         where mobile='$phone' and role='patient'"
    );

    $appointments = mysqli_query(
        $con,
        "select doctorName, speciality, day, timeSlot
         from appointmentsandbill
         where patientEmail = (
            select email from users where mobile='$phone'
         )
         order by datetime desc"
    );
}

if (isset($_POST['bill_history'])) 
{

    $showBill = true;

    $billHistory = mysqli_query(
        $con,
        "select doctorName, speciality, day, timeSlot,
                appointmentFee, paymentMethod, datetime, status
         from appointmentsandbill
         where patientEmail = (
            select email from users where mobile='$phone'
         )
         order by datetime desc"
    );
}

