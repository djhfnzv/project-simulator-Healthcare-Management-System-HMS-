<?php
    session_start();

    if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
        header("Location: ../../Login/View/login.php");
        exit();
    }

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        echo "Access denied!";
        exit();
    }

    if (!isset($_SESSION['user'])) {
        echo "User data not found!";
        exit();
    }
    require_once '../../DB/dbUser.php';
?>


<html>
<head>
    <title>Healthcare Management System</title>
    <link rel="stylesheet" href="../Asset/cssAdmin.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../../Icons/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon">
            <img src="../../Icons/bell.svg" alt="Notifications">
        </div>
        <div class="icon">
            <form action="../../Profile/View/profile.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../../Icons/profile.svg" alt="Profile">
                </button>
            </form>
            
        </div>
        <div class="icon">
            <form action="../../Logout/Controller/logout.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../../Icons/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

    <aside class="sidebar">
        <ul>
            <li class="active"><a href="adminDashboard.php">Home</a></li>
            
            <li class="menu-title">Manage</li>
            <ul class="submenu">
                <li><a href="doctorList.php">Doctor</a></li>
                <li><a href="nurseList.php">Nurse</a></li>
                <li><a href="receptionistList.php">Receptionist</a></li>
                <li><a href="patientList.php">Patient</a></li>
            </ul>

            <li><a href="bills.php">Bills</a></li>
            <li><a href="../../User_Activity/View/userActivity.php">User Activity</a></li>
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
