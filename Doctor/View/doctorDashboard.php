<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../../Login/View/login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthcare Management System</title>
    <link rel="stylesheet" href="../../CSS/style1.css">
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
            <img src="../Asset/profile.svg" alt="Profile">
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
            <li class="active"><a href="doctorDashboard.php">Home </a></li>
            <li><a href="appoinment.php">Appoinment</a></li>
            <li><a href="schedule.php">Schedulr</a></li>
        </ul>
    </aside>

    <main class="content">
        
    </main>
</div>

</body>
</html>

