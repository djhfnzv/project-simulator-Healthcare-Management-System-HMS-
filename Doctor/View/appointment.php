<?php
session_start();
if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Doctor') {
    echo "Access denied!";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "User data not found!";
    exit();
}

require_once '../../DB/dbUser.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    header('Content-Type: application/json');
    $con = connection();
    if (!$con) {
        echo json_encode(['success' => false, 'message' => 'DB connection failed']);
        exit();
    }
    $appointmentId = $_POST['appointmentId'] ?? '';
    $status = $_POST['status'] ?? '';
    if ($appointmentId === '' || $status === '') {
        echo json_encode(['success' => false, 'message' => 'Missing parameters']);
        exit();
    }
    $appointmentIdEsc = mysqli_real_escape_string($con, $appointmentId);
    $statusEsc = mysqli_real_escape_string($con, $status);
    if (ctype_digit((string)$appointmentIdEsc)) {
        $where = "id=$appointmentIdEsc";
    } else {
        $where = "timeSlot='" . $appointmentIdEsc . "'";
    }
    $sql = "UPDATE appointments SET status='$statusEsc' WHERE $where";
    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true, 'status' => $statusEsc]);
    } else {
        echo json_encode(['success' => false, 'message' => 'DB update failed']);
    }
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Appointment</title>
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
        <li ><a href="doctorDashboard.php">Home</a></li>
        <li class="active"><a href="appointment.php">Appointment</a></li>
       
    </ul>
</aside>


<main class="content">
    <?php
<<<<<<< Updated upstream
        $conn = mysqli_connect("localhost", "root", "", "project");
=======
        $conn = connection();
>>>>>>> Stashed changes
        if (!$conn) {
            die("Database connection failed");
        }

        $doctorName = $_SESSION['user']['name'];

        $sql = "SELECT * FROM appointments WHERE doctorName='$doctorName'";
        $result = mysqli_query($conn, $sql);
        ?>

        <h2>My Appointments</h2>

        <?php if (mysqli_num_rows($result) == 0) { ?>
            <p>No appointments found.</p>
        <?php } else { ?>

        <table id="schedule" border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>Patient Name</th>
            <th>Email</th>
            <th>Speciality</th>
            <th>Time Slot</th>
            <th>Fee</th>
            <th>Status</th>
<<<<<<< Updated upstream
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
=======
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr data-appointment="<?php echo isset($row['id']) ? $row['id'] : $_SESSION['timeSlot']; ?>">
>>>>>>> Stashed changes
            <td><?php echo $row['patientName']; ?></td>
            <td><?php echo $row['patientEmail']; ?></td>
            <td><?php echo $row['speciality']; ?></td>
            <td><?php echo $row['timeSlot']; ?></td>
            <td><?php echo $row['appointmentFee']; ?></td>
<<<<<<< Updated upstream
            <td><?php echo $row['status']; ?></td>
=======
            <td class="status-cell"><?php echo $row['status']; ?></td>
            <td>
                <button onclick="updateStatus('<?php echo isset($row['id']) ? $row['id'] : addslashes($row['timeSlot']); ?>','Completed')">Mark Completed</button>
                <button onclick="updateStatus('<?php echo isset($row['id']) ? $row['id'] : addslashes($row['timeSlot']); ?>','Cancelled')">Cancel</button>
            </td>
>>>>>>> Stashed changes
        </tr>
        <?php } ?>

        </table>

    <?php } ?>
</main>

</div>
</div>

<script src="appointment.js"></script>
</body>
</html>