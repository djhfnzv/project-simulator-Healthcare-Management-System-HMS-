<?php
session_start();

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Patient') {
    echo "Access denied!";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "User data not found!";
    exit();
}

require_once '../../DB/dbUser.php';

$patientName = $_SESSION['user']['name'];
