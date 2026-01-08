<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../Login/View/Login.php");
    exit();
}

$role = $_SESSION['user']['role'];

if ($role === "Admin") {
    header("Location: ../Admin/View/adminDashboard.php");
}
elseif ($role === "Doctor") {
    header("Location: ../Doctor/View/doctorDashboard.php");
}
elseif ($role === "Nurse") {
    header("Location: ../Nurse/View/nurseDashboard.php");
}
elseif ($role === "Receptionist") {
    header("Location: ../Receptionist/View/receptionDashboard.php");
}
elseif ($role === "Patient") {
    header("Location: ../Patient/View/patientDashboard.php");
}
else {
    header("Location: ../Profile/View/profile.php");
}

exit();
