<?php
session_start();

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Nurse') {
    echo "Access denied!";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "User data not found!";
    exit();
}
require_once '../../DB/dbUser.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient List</title>
    <link rel="stylesheet" href="../Asset/styleNurse.css">
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
            <li><a href="nurseDashboard.php">Home</a></li>
            <li class="active"><a href="patientList.php">Patient List</a></li>
            
        </ul>
    </aside>

    <main class="content">
        
        <?php

        $conn = connection();
        if (!$conn) {
            die("Database connection failed");
        }

        $sql = "select DISTINCT patientName FROM appointmentsandbill";
        $result = mysqli_query($conn, $sql);
        ?>

        <h2>Patient List</h2>

        <?php if (mysqli_num_rows($result) == 0) { ?>
            <p>No patients found.</p>
        <?php } else { ?>

        <table id="schedule" border="1" cellpadding="10" cellspacing="0" width="100%">
            <tr>
                <th>Patient Name</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo ($row['patientName']); ?></td>
            </tr>
            <?php } ?>
        </table>

        <?php } ?>



    </main>

</div>

</body>
</html>