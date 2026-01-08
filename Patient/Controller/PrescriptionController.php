<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_SESSION['user']) || !isset($_SESSION['user']['name'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}

$con = connection();
$patientName = trim($_SESSION['user']['name']);

if (empty($patientName)) {
    echo "Invalid patient session!";
    exit();
}

$query = "
    select doctorName, age, diagnosis, treatment, medication, created_at
    from prescriptions
    where patientName='$patientName'
    order by created_at desc";

$result = mysqli_query($con, $query);

if (!$result) {
    echo "Failed to load prescriptions!";
    exit();
}
