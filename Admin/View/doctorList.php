<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../../Login/View/login.php");
        exit();
    }

    $doctors = [];

    /*doctors from session dummy data */
    if (isset($_SESSION['dummyUsers']) && is_array($_SESSION['dummyUsers'])) {
        foreach ($_SESSION['dummyUsers'] as $user) {
            if (isset($user['role']) && $user['role'] === 'Doctor') {
                $doctors[] = $user;
            }
        }
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

        <h1>Doctor List</h1>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Speciality</th>
            </tr>

            <?php if (count($doctors) > 0) { ?>
                <?php foreach ($doctors as $doc) { ?>
                    <tr>
                        <td><?php echo $doc['name'] ?? '-'; ?></td>
                        <td><?php echo $doc['age'] ?? '-'; ?></td>
                        <td><?php echo $doc['dob'] ?? '-'; ?></td>
                        <td><?php echo $doc['email'] ?? '-'; ?></td>
                        <td><?php echo $doc['mobile'] ?? '-'; ?></td>
                        <td><?php echo $doc['speciality'] ?? '-'; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6" align="center">No doctors found</td>
                </tr>
            <?php } ?>
        </table>
    </main>
</div>

</body>
</html>

