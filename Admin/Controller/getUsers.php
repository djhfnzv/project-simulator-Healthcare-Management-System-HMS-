<?php

session_start();
require_once '../../DB/dbUser.php';

header('Content-Type: application/json');

$role = $_GET['role'] ?? '';
if (!in_array($role, ['Nurse', 'Receptionist', 'Patient'])) {
    echo json_encode([]);
    exit();
}

$con = connection();
$query = "select name, age, dob, email, password, mobile from users where role='$role'";
$result = mysqli_query($con, $query);

$users = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

echo json_encode($users);
?>