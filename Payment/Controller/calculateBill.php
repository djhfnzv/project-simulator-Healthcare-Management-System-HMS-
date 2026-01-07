<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_SESSION['user']) || !isset($_SESSION['user']['email'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}

$con = connection();
$email = $_SESSION['user']['email'];

$query = "
    select sum(appointmentFee) as total
    from appointmentsandbill
    where patientEmail='$email'
    and status='confirmed'
";

$result = mysqli_query($con, $query);

if ($result) {
    $data = mysqli_fetch_assoc($result);
    $_SESSION['totalBill'] = $data['total'] ?? 0;
} else {
    $_SESSION['totalBill'] = 0;
}

header("Location: ../View/paymentHistory.php");
exit();
