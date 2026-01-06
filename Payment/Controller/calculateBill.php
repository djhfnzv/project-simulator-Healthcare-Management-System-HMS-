<?php
session_start();
require_once '../../DB/dbUser.php';

$con = connection();
$email = $_SESSION['user']['email'];

/*Calculate bill for UNPAID appointments*/
$query = "
    select sum(appointmentFee) as total
    from appointmentsandbill
    where patientEmail='$email'
    and status='confirmed'
";

$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

$_SESSION['totalBill'] = $data['total'] ?? 0;

header("Location: ../View/paymentHistory.php");
exit();
