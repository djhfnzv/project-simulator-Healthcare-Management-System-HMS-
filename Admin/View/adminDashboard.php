<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../../Login/View/login.php");
        exit();
    }
?>

<html>
<head>
    <title>Healthcare Management System</title>
    <link rel="stylesheet" href="../../CSS/style1.css">
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
            <form action="../../Registration/Controller/logout.php" method="post" class="logout-form">
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
            <li><a href="userRecord.php">User Record</a></li>
        </ul>
    </aside>

    <main class="content">
        <h2>Hi, <?php echo $_SESSION['user']['name']; ?>!</h2>

        <h3>Registration Data:</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr><td>Name</td><td><?php echo $_SESSION['user']['name']; ?></td></tr>
            <tr><td>Date of Birth</td><td><?php echo $_SESSION['user']['dob']; ?></td></tr>
            <tr><td>Age</td><td><?php echo $_SESSION['user']['age']; ?></td></tr>
            <tr><td>Gender</td><td><?php echo $_SESSION['user']['gender']; ?></td></tr>
            <tr><td>Blood Group</td><td><?php echo $_SESSION['user']['bloodGroup']; ?></td></tr>
            <tr><td>Email</td><td><?php echo $_SESSION['user']['email']; ?></td></tr>
            <tr><td>Phone</td><td><?php echo $_SESSION['user']['phone']; ?></td></tr>
        </table>
    </main>
</div>

</body>
</html>

