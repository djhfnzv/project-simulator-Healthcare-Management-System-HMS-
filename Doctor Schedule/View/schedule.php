<?php
session_start();

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Doctor') {
    header("Location: ../../Login/View/login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$doctorName = $_SESSION['user']['name'];


if (isset($_POST['delete'])) {
    $day      = $_POST['day'];
    $timeSlot = $_POST['timeSlot'];

    mysqli_query(
        $conn,
        "DELETE FROM doctorSchedule 
         WHERE doctorName='$doctorName' 
         AND day='$day' 
         AND timeSlot='$timeSlot'"
    );
}

if (isset($_POST['addSchedule'])) {
    $speciality = isset($_SESSION['user']['speciality'])
        ? $_SESSION['user']['speciality']
        : 'General';

    $day      = $_POST['day'];
    $timeSlot = $_POST['timeSlot'];
    $fee      = $_POST['appointmentFee'];

    mysqli_query(
        $conn,
        "INSERT INTO doctorSchedule 
        (doctorName, speciality, day, timeSlot, appointmentFee)
        VALUES 
        ('$doctorName', '$speciality', '$day', '$timeSlot', '$fee')"
    );
}


$result = mysqli_query(
    $conn,
    "SELECT * FROM doctorSchedule WHERE doctorName='$doctorName'"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Schedule</title>
    <link rel="stylesheet" href="../Asset/styleDoctor.css">
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
        <li><a href="../../Doctor/View/doctorDashboard.php">Home</a></li>
        <li class="active"><a href="schedule.php">Schedule</a></li>
    </ul>
</aside>

<main class="content">

<h2>My Schedule (<?php echo $doctorName; ?>)</h2>

<form method="post">
    <label>Day</label><br>
    <select name="day" required>
        <option value="">Select Day</option>
        <option>Sunday</option>
        <option>Monday</option>
        <option>Tuesday</option>
        <option>Wednesday</option>
        <option>Thursday</option>
        <option>Friday</option>
        <option>Saturday</option>
    </select><br><br>

    <label>Time Slot</label><br>
    <select name="timeSlot" required>
        <option value="">Select Time</option>
        <option>10:00 AM - 12:00 PM</option>
        <option>12:00 PM - 02:00 PM</option>
        <option>02:00 PM - 04:00 PM</option>
        <option>04:00 PM - 06:00 PM</option>
        <option>06:00 PM - 08:00 PM</option>
        <option>08:00 PM - 10:00 PM</option>
    </select><br><br>

    <label>Appointment Fee</label><br>
    <input type="number" name="appointmentFee" min="1" required><br><br>

    <button type="submit" name="addSchedule">
        Add Schedule
    </button>
</form>

<br>

<table id="schedule" border="1" width="100%" cellpadding="10">
<tr>
    <th>Day</th>
    <th>Time Slot</th>
    <th>Fee</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['day']; ?></td>
    <td><?php echo $row['timeSlot']; ?></td>
    <td><?php echo $row['appointmentFee']; ?></td>
    <td>
        <form method="post" style="display:inline;">
            <input type="hidden" name="day" value="<?php echo $row['day']; ?>">
            <input type="hidden" name="timeSlot" value="<?php echo $row['timeSlot']; ?>">
            <button type="submit" name="delete">Delete</button>
        </form>
    </td>
</tr>
<?php } ?>

</table>

</main>
</div>

</body>
</html>
