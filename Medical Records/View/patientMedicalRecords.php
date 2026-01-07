<?php
session_start();

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

if (!isset($_SESSION['user']) ||
    ($_SESSION['user']['role'] !== 'Doctor' && $_SESSION['user']['role'] !== 'Nurse')) {
    echo "Access denied!";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "User data not found!";
    exit();
}

require_once '../../DB/dbUser.php';

$role = $_SESSION['user']['role'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'fetchRecords') {
    header('Content-Type: application/json');
    $con = connection();
    if (!$con) { echo json_encode(['success'=>false,'message'=>'DB error']); exit(); }
    $patient = mysqli_real_escape_string($con, $_POST['patientName'] ?? '');
    if ($patient === '') { echo json_encode(['success'=>false,'message'=>'Missing patientName']); exit(); }
    $sql = "SELECT a.patientName, a.timeSlot, p.diagnosis, p.treatment, p.medication, p.created_at FROM appointments a LEFT JOIN prescriptions p ON a.patientName = p.patientName WHERE a.patientName='".$patient."'";
    $res = mysqli_query($con, $sql);
    $rows = [];
    while ($r = mysqli_fetch_assoc($res)) $rows[] = $r;
    echo json_encode(['success'=>true,'records'=>$rows]);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Medical Records</title>
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
            <form action="../../Profile/View/profile.php" method="post">
                <button type="submit" class="icon-btn">
                    <img src="../Asset/profile.svg" alt="Profile">
                </button>
            </form>
        </div>

        <div class="icon">
            <form action="../../Logout/Controller/logout.php" method="post">
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
        <?php if ($role === 'Doctor') { ?>
            <li><a href="../../Doctor/View/doctorDashboard.php">Home</a></li>
        <?php } else { ?>
            <li><a href="../../Nurse/View/nurseDashboard.php">Home</a></li>
        <?php } ?>

        <li class="active">
            <a href="patientMedicalRecords.php">Patient Records</a>
        </li>
    </ul>
</aside>

<main class="content">
    <div>
        <label>Search Patient</label>
        <input type="text" id="searchPatient" />
        <button type="button" onclick="fetchRecords()">Search</button>
    </div>

<?php
$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    die("Database connection failed");
}

$role = $_SESSION['user']['role'];
$userName = $_SESSION['user']['name'];

if ($role === 'Doctor') {
    $sql = "
    SELECT 
        a.patientName,
        a.timeSlot,
        p.diagnosis,
        p.treatment,
        p.medication,
        p.created_at
    FROM appointments a
    LEFT JOIN prescriptions p 
        ON a.patientName = p.patientName 
        AND p.doctorName = '".mysqli_real_escape_string($conn,$userName)."'
    WHERE a.doctorName = '".mysqli_real_escape_string($conn,$userName)."'
    ORDER BY a.patientName
    ";
} else {
    $sql = "
    SELECT 
        a.patientName,
        a.timeSlot,
        p.diagnosis,
        p.treatment,
        p.medication,
        p.created_at
    FROM appointments a
    LEFT JOIN prescriptions p 
        ON a.patientName = p.patientName
    ORDER BY a.patientName
    ";
}

$result = mysqli_query($conn, $sql);
?>

<h2>Patient Medical Records</h2>

<?php if (mysqli_num_rows($result) == 0) { ?>
    <p>No medical records found.</p>
<?php } else { ?>

<table id="schedule" border="1" cellpadding="10" cellspacing="0" width="100%">
<tr>
    <th>Patient Name</th>
    <th>Appointment Time</th>
    <th>Diagnosis</th>
    <th>Treatment</th>
    <th>Medication</th>
    <th>Prescription Date</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['patientName']; ?></td>
    <td><?php echo $row['timeSlot']; ?></td>
    <td><?php echo $row['diagnosis'] ?? '-'; ?></td>
    <td><?php echo $row['treatment'] ?? '-'; ?></td>
    <td><?php echo $row['medication'] ?? '-'; ?></td>
    <td><?php echo $row['created_at'] ?? '-'; ?></td>
</tr>
<?php } ?>
</table>

<?php } ?>

<script src="patientMedicalRecords.js"></script>

</main>

</div>

</body>
</html>

