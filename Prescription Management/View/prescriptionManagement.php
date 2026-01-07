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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => mysqli_connect_error()]);
        exit();
    }
    die("Database connection failed");
}
$createTable = "CREATE TABLE IF NOT EXISTS prescriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctorName VARCHAR(255),
    patientName VARCHAR(255),
    age INT,
    diagnosis TEXT,
    treatment TEXT,
    medication TEXT,
    created_at DATETIME
)";
mysqli_query($conn, $createTable);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'savePrescription') {
    header('Content-Type: application/json');

    $doctorName = mysqli_real_escape_string($conn, $_SESSION['user']['name']);
    $patient    = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $age        = intval($_POST['patient_age']);
    $diagnosis  = mysqli_real_escape_string($conn, $_POST['diagnosis']);
    $treatment  = mysqli_real_escape_string($conn, $_POST['treatment']);
    $medication = mysqli_real_escape_string($conn, $_POST['medication']);
    $date       = date("Y-m-d H:i:s");

    $sql = "INSERT INTO prescriptions 
            (doctorName, patientName, age, diagnosis, treatment, medication, created_at)
            VALUES 
            ('$doctorName', '$patient', $age, '$diagnosis', '$treatment', '$medication', '$date')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
    }
    exit();
}


$patients = [];
$doctorEsc = mysqli_real_escape_string($conn, $_SESSION['user']['name']);
$q = "SELECT DISTINCT patientName 
      FROM appointments 
      WHERE doctorName='$doctorEsc' AND status='Booked'";
$r = mysqli_query($conn, $q);
while ($row = mysqli_fetch_assoc($r)) {
    $patients[] = $row['patientName'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Prescription</title>
    <link rel="stylesheet" href="../Asset/styleDoctor.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../Asset/logo.png">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <form action="../../Profile/View/profile.php" method="post">
                <button type="submit" class="icon-btn" title="Profile" aria-label="Profile">
                    <img src="../Asset/profile.svg" alt="Profile" style="width:24px;height:24px;display:block;">
                </button>
        </form>
        <form action="../../Logout/Controller/logout.php" method="post">
                <button type="submit" class="icon-btn" title="Logout" aria-label="Logout">
                    <img src="../Asset/logout.svg" alt="Logout" style="width:24px;height:24px;display:block;">
                </button>
        </form>
    </div>
</header>

<div class="container">

<aside class="sidebar">
    <ul>
        <li><a href="../../Doctor/View/doctorDashboard.php">Home</a></li>
        <li class="active"><a href="#">Prescription</a></li>
    </ul>
</aside>

<main class="content">

<h2>Create Prescription</h2>

<form id="prescriptionForm" onsubmit="return false;">
    <input type="hidden" name="action" value="savePrescription">

    <label>Patient Name</label><br>
    <select name="patient_name" required>
        <option value="">-- Select Patient --</option>
        <?php foreach ($patients as $p) { ?>
            <option value="<?php echo $p ?>">
                <?php echo $p ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>Patient Age</label><br>
    <input type="number" name="patient_age" required><br><br>

    <label>Diagnosis</label><br>
    <textarea name="diagnosis" required></textarea><br><br>

    <label>Treatment</label><br>
    <textarea name="treatment" required></textarea><br><br>

    <label>Medication</label><br>
    <textarea name="medication" required></textarea><br><br>

    <button type="button" onclick="savePrescription()">Save Prescription</button>
</form>

<script src="prescriptionManagement.js"></script>

</main>
</div>

</body>
</html>
