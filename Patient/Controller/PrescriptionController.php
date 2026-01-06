<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}

$con = connection();

$patientName = $_SESSION['user']['name'];

$query = "
    select doctorName, age, diagnosis, treatment, medication, created_at
    from prescriptions
    where patientName = '$patientName'
    order by created_at desc
";

$result = mysqli_query($con, $query);
