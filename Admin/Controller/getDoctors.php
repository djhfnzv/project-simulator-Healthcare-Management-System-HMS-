<?php
    session_start();
    require_once '../../DB/dbUser.php';

    header('Content-Type: application/json');

    $con = connection();
    $query = "select name, age, dob, email, password, mobile, speciality from users where role='Doctor'";
    $result = mysqli_query($con, $query);

    $doctors = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctors[] = $row;
        }
    }

    echo json_encode($doctors);
?>