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
    <title>Healthcare Management System</title>
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
            <li class="active"><a href="dutySchedule.php">Duty Schedule</a></li>
        </ul>
    </aside>

    <main class="content">
        <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Nurse') {
    exit("Unauthorized access");
}

$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    die("Database connection failed");
}

$nurseName = $_SESSION['user']['name'];

$sql = "SELECT * FROM nurseSchedule WHERE nurseName = '$nurseName'";
$result = mysqli_query($conn, $sql);
?>

<h2>My Duty Schedule</h2>

<?php if (mysqli_num_rows($result) == 0) { ?>
    <p>No duty schedule found for you.</p>
<?php } else { ?>

<table id="schedule" border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>Nurse Name</th>
        <th>Time Slot</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo ($row['nurseName']); ?></td>
            <td><?php echo ($row['timeSlot']); ?></td>
        </tr>
    <?php } ?>
</table>

<?php } ?>

    </main>

</div>

</body>
</html>
