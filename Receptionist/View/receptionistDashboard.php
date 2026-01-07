<?php require_once '../controller/receptionistDashboardController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Receptionist Dashboard</title>
<link rel="stylesheet" href="../Asset/styleReceptionist.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../Asset/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon">
            <img src="../Asset/bell.svg" alt="Notifications">
        </div>
        <div class="icon">
            <form action="../../Profile/View/profile.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../../Icons/profile.svg" alt="Profile">
                </button>
            </form>
        </div>
        <div class="icon">
            <form action="../../Registration/Controller/logout.php" method="post" class="logout-form">
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
    <li class="active"><a href="#">Home</a></li>
    <li><a href="registerPatient.php">Register Patient</a></li>
    <li><a href="../../ManageAppointment/View/manageAppointment.php">Schedule & Manage Appointments</a></li>
    <li><a href="../../RescheduleAppointment/View/reschedulelAppointment.php">Cancel / Reschedule</a></li>
    <li><a href="../../SearchPatient/View/searchPatient.php">Search Patient</a></li>
</ul>
</aside>

<main class="content">
    <h1>Hi, <?php echo $_SESSION['user']['name']; ?>!</h2>
        <p >
            Open Files From Side Panel
        </p>
</main>

</div>

</body>
</html>
