<?php
session_start();

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['user'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}

require_once '../../DB/dbUser.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthcare Management System</title>
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
            <li><a href="../../Doctor/View/doctorDashboard.php">Home </a></li>
            <li class="active"><a href="prescriptionManagement.php"> Prescription </a></li>
        </ul>
    </aside>

    <main class="content">
    <?php include 'prescription.php'; ?>
        
    </main>
</div>

</body>
</html>

