<?php require_once '../controller/PatientDashboardController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Healthcare Management System</title>

<link rel="stylesheet" href="../asset/stylePatient.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../asset/logo.png">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon">
            <img src="../asset/bell.svg" alt="Notifications">
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
                    <img src="../asset/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

<aside class="sidebar">
<ul>
    <li class="active"><a href="#">Home</a></li>
    <li><a href="../../BookAppointment/View/bookAppointment.php">Book Appointment</a></li>
    <li><a href="../../CancelAppointment/View/cancelAppointment.php">Cancel Appointment</a></li>
    <li><a href="prescription.php">Prescription & Diagnosis</a></li>
    <li><a href="../../Payment/View/paymentHistory.php">Payment History</a></li>
</ul>
</aside>

<main class="content">
    <h1>Hi, <?= htmlspecialchars($patientName) ?>!</h1>
    <p>Open files from the side panel.</p>
</main>

</div>

</body>
</html>
