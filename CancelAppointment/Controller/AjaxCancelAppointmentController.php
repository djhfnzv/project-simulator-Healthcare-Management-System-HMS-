<?php
session_start();
require_once '../../DB/dbUser.php';

$con = connection();

$response = [
    'status' => 'error',
    'message' => 'Invalid request'
];

if (!isset($_SESSION['user'])) {
    echo json_encode($response);
    exit();
}

$patientEmail = $_SESSION['user']['email'];
$appointmentId = $_POST['appointment_id'] ?? '';

if (!empty($appointmentId)) {

    $query = "
        update appointmentsandbill
        set status='cancelled'
        where id='$appointmentId'
        and patientEmail='$patientEmail'
        and status!='cancelled'
    ";

    if (mysqli_query($con, $query)) {
        $response['status'] = 'success';
        $response['message'] = 'Appointment cancelled successfully!';
    } else {
        $response['message'] = 'Cancellation failed!';
    }
}

echo json_encode($response);
