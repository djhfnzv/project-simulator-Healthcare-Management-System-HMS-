<?php
<<<<<<< Updated upstream
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
=======
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
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
        <h1>Hi, <?php echo $_SESSION['user']['name']; ?>!</h2>

        <p >
            Open Files From Side Panel
        </p>
    
    </main>

=======
    <h2>Hi, <?php echo $_SESSION['user']['name']; ?>!</h2>

    <h3>Registration Data:</h3>

    <?php
        $con = connection();

        $query  = "SELECT * FROM users";
        $result = mysqli_query($con, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($con));
        }

        // Display data
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Blood Group</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Role</th>
                <th>Speciality</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['serial']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['age']}</td>";
            echo "<td>{$row['dob']}</td>";
            echo "<td>{$row['gender']}</td>";
            echo "<td>{$row['bloodgroup']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['mobile']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td>{$row['speciality']}</td>";
            echo "</tr>";
        }

        echo "</table>";

        mysqli_close($con);
    ?>
</main>

>>>>>>> Stashed changes
</div>

</body>
</html>
