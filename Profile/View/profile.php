<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}
?>

<html>
<head>
    <title>Healthcare Management System - Profile</title>
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
                <button type="submit">
                    <img src="../../Icons/profile.svg" alt="Profile">
                </button>
            </form>
        </div>

        <div class="icon">
            <form action="../../Registration/Controller/logout.php" method="post" class="logout-form">
                <button type="submit" class="active">
                    <img src="../../Icons/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

    <aside class="sidebar">
        <ul>
            <li ><a href="../../Controller/homeRedirect.php">Home</a></li>
            
            <li class="menu-title">Manage</li>
            <ul class="submenu">
                <li><a href="../../Controller/homeRedirect.php">Doctor</a></li>
                <li><a href="../../Controller/homeRedirect.php">Nurse</a></li>
                <li><a href="../../Controller/homeRedirect.php">Receptionist</a></li>
                <li><a href="../../Controller/homeRedirect.php">Patient</a></li>
            </ul>

            <li><a href="bills.php">Bills</a></li>
            <li><a href="userRecord.php">User Record</a></li>
        </ul>
    </aside>

    <main class="content">

        <h2>
            Hi, <?php echo $_SESSION['user']['name']; ?>!
        </h2>

        <h3>Profile Information</h3>

        <table class="profile-table">
            <tr>
                <td><b>Role</b></td>
                <td><?php echo $_SESSION['user']['role'] ?? 'User'; ?></td>
            </tr>

            <tr>
                <td><b>Name</b></td>
                <td><?php echo $_SESSION['user']['name']; ?></td>
            </tr>

            <tr>
                <td><b>Age</b></td>
                <td><?php echo $_SESSION['user']['age'] ?? '-'; ?></td>
            </tr>

            <tr>
                <td><b>Date of Birth</b></td>
                <td><?php echo $_SESSION['user']['dob'] ?? '-'; ?></td>
            </tr>

            <tr>
                <td><b>Email</b></td>
                <td><?php echo $_SESSION['user']['email']; ?></td>
            </tr>

            <tr>
                <td><b>Mobile</b></td>
                <td><?php echo $_SESSION['user']['mobile'] ?? '-'; ?></td>
            </tr>

            <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === "Doctor") { ?>
            <tr>
                <td><b>Speciality</b></td>
                <td><?php echo $_SESSION['user']['speciality']; ?></td>
            </tr>
            <?php } ?>
        </table>

    </main>
</div>

</body>
</html>
