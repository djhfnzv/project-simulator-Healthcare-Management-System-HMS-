<?php
require_once '../../DB/dbUser.php';
$con = connection();

$response = [
    'status' => 'error',
    'message' => 'Invalid request'
];

$action = $_POST['action'] ?? '';
$id     = $_POST['appointment_id'] ?? '';

if (!empty($action) && !empty($id)) {

    if ($action === 'cancel') {

        mysqli_query(
            $con,
            "update appointmentsandbill
             set status='cancelled'
             where id='$id' and status!='cancelled'"
        );

        $response['status'] = 'success';
        $response['message'] = 'Appointment cancelled successfully!';
    }

    if ($action === 'reschedule') {

        $day  = $_POST['day'] ?? '';
        $time = $_POST['timeSlot'] ?? '';

        if (!empty($day) && !empty($time)) {

            mysqli_query(
                $con,
                "update appointmentsandbill
                 set day='$day', timeSlot='$time'
                 where id='$id' and status!='cancelled'"
            );

            $response['status'] = 'success';
            $response['message'] = 'Appointment rescheduled successfully!';
        } else {
            $response['message'] = 'Day and time required!';
        }
    }
}

echo json_encode($response);
