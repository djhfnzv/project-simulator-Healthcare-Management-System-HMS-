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
    <link rel="stylesheet" href="../Asset/cssAdminB.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../../Icons/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">

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
            <li ><a href="adminDashboard.php">Home</a></li>
            
            <li class="menu-title">Manage</li>
            <ul class="submenu">
                <li><a href="doctorList.php">Doctor</a></li>
                <li><a href="nurseList.php">Nurse</a></li>
                <li><a href="receptionistList.php">Receptionist</a></li>
                <li><a href="patientList.php">Patient</a></li>
            </ul>

            <li class="active"><a href="bills.php">Bills</a></li>
            <li><a href="../../User_Activity/View/userActivity.php">User Activity</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Billing & Transaction</h1>

        <?php
            $con = connection();

            $sql = "SELECT * FROM appointmentsandbill ORDER BY datetime DESC";
            $result = mysqli_query($con, $sql);

            if (!$result) {
                die("Query Failed: " . mysqli_error($con));
            }
        ?>

        <table class="billing-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Email</th>
                    <th>Doctor</th>
                    <th>Speciality</th>
                    <th>Day</th>
                    <th>Time Slot</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Card / Mobile</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>

            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['patientName']; ?></td>
                        <td><?= $row['patientEmail']; ?></td>
                        <td><?= $row['doctorName']; ?></td>
                        <td><?= $row['speciality']; ?></td>
                        <td><?= $row['day']; ?></td>
                        <td><?= $row['timeSlot']; ?></td>
                        <td><?= number_format($row['appointmentFee'], 2); ?></td>
                        <td><?= $row['status']; ?></td>
                        <td><?= ucfirst($row['paymentMethod']); ?></td>
                        <td><?= $row['card_mobile_data']; ?></td>
                        <td><?= $row['datetime']; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="12" style="text-align:center;">No billing records found</td>
                </tr>
            <?php } ?>

            </tbody>
        </table>


        
    
    </main>

</div>

</body>
</html>
