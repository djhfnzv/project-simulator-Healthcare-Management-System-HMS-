<?php
require_once '../../DB/dbUser.php';
$con = connection();

$speciality = $_POST['speciality'];

$result = mysqli_query(
    $con,
    "select distinct doctorName from doctorschedule where speciality='$speciality'"
);

$doctors = [];

while ($row = mysqli_fetch_assoc($result)) {
    $doctors[] = $row;
}

echo json_encode($doctors);
