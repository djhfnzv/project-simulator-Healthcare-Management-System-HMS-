<?php
session_start();

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Doctor') {
    echo "Access denied!";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "User data not found!";
    exit();
}
require_once '../../DB/dbUser.php';

$doctorName = $_SESSION['user']['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
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
            <form action="../../Profile/View/profile.php" method="post" class="logout-form">
                 <button type="submit" class="icon-btn">
                    <img src="../Asset/profile.svg" alt="Profile">
                </button>
            </form>    
             
        </div>
        <div class="icon">
            <form action="../../Logout/Controller/logout.php" method="post" class="logout-form">
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
            <li class="active"><a href="doctorDashboard.php">Home</a></li>
            <li><a href="appointment.php">Appointment</a></li>
            <li><a href="../../Doctor Schedule/View/schedule.php">Schedule</a></li>
            <li><a href="../../Prescription Management/View/prescriptionManagement.php">Prescription</a></li>
            <li><a href="../../Medical Records/View/patientMedicalRecords.php"> Medical Records</a></li>
 
        </ul>
    </aside>

    <main class="content">
        <h1>Welcome <?php echo  $_SESSION['user']['name']; ?></h1>

        <p style=>
            Open Files From Side Panel
        </p>

       
    </main>

</div>

</body>
</html>
