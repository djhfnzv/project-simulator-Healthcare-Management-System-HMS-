<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Receptionist') {
    echo "Access denied!";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "User data not found!";
    exit();
}

$user = $_SESSION['user'];

require_once '../View/receptionistDashboard.php';
