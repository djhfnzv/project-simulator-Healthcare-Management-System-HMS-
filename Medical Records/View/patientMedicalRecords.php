<?php
session_start();

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['user']) || 
    ($_SESSION['user']['role'] !== 'Doctor' && $_SESSION['user']['role'] !== 'Nurse')) {
    echo "Access denied!";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "User data not found!";
    exit();
}

require_once '../../DB/dbUser.php';

$role = $_SESSION['user']['role'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Medical Records</title>
    <link rel="stylesheet" href="../Asset/styleDoctor.css">
</head>
<body>

<header class="topbar">
    <div class="logo">
        <img src="../Asset/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon">
            <form action="../../Profile/View/profile.php" method="post">
                <button type="submit" class="icon-btn">
                    <img src="../Asset/profile.svg" alt="Profile">
                </button>
            </form>
        </div>

        <div class="icon">
            <form action="../../Logout/Controller/logout.php" method="post">
                <button type="submit" class="icon-btn">
                    <img src="../Asset/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

<aside class="sidebar">
    <ul>
        <?php if ($role === 'Doctor') { ?>
            <li><a href="../../Doctor/View/doctorDashboard.php">Home</a></li>
        <?php } else { ?>
            <li><a href="../../Nurse/View/nurseDashboard.php">Home</a></li>
        <?php } ?>

        <li class="active">
            <a href="patientMedicalRecords.php">Patient Records</a>
        </li>
    </ul>
</aside>

<main class="content">
    <?php include("patientMedicalRecordShow.php"); ?>
</main>

</div>

</body>
</html>
