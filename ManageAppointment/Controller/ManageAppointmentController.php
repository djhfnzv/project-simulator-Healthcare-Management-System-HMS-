<?php
require_once '../../DB/dbUser.php';
$con = connection();

$message = "";

$patients = mysqli_query(
    $con,
    "select name, email from users where role='patient'"
);

$specialities = mysqli_query(
    $con,
    "select distinct speciality from doctorschedule"
);

$selectedPatientEmail = '';
$selectedPatientName  = '';
$selectedSpeciality   = $_POST['speciality'] ?? '';
$selectedDoctor       = $_POST['doctor'] ?? '';
$selectedDay          = $_POST['day'] ?? '';
$selectedTime         = $_POST['timeSlot'] ?? '';
$fee = "";

if (!empty($_POST['patient'])) {
    $parts = explode('|', $_POST['patient']);
    $selectedPatientEmail = $parts[0] ?? '';
    $selectedPatientName  = $parts[1] ?? '';
}

$doctors = mysqli_query(
    $con,
    "select distinct doctorName from doctorschedule
     where speciality='$selectedSpeciality'"
);

$days = mysqli_query(
    $con,
    "select distinct day from doctorschedule
     where doctorName='$selectedDoctor'"
);

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

if (isset($_POST['book'])) {

    if (
        empty($selectedPatientEmail) ||
        empty($selectedPatientName) ||
        empty($selectedSpeciality) ||
        empty($selectedDoctor) ||
        empty($selectedDay) ||
        empty($selectedTime)
    ) {
        $message = "All fields are required!";
    }
    else {

        $check = mysqli_query(
            $con,
            "select id from appointmentsandbill
             where doctorName='$selectedDoctor'
             and day='$selectedDay'
             and timeSlot='$selectedTime'
             and status!='cancelled'"
        );

        if (mysqli_num_rows($check) > 0) {
            $message = "Slot already booked!";
        }
        else {

            mysqli_query(
                $con,
                "insert into appointmentsandbill
                (patientName, patientEmail, doctorName, speciality, day, timeSlot, appointmentFee, status)
                values
                ('$selectedPatientName','$selectedPatientEmail',
                 '$selectedDoctor','$selectedSpeciality',
                 '$selectedDay','$selectedTime','$fee','confirmed')"
            );

            $message = "Appointment booked successfully!";
            $_POST = [];
        }
    }
}
