<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
$successMsg = "";

$patients = [];
$sqlPatients = "SELECT DISTINCT patientName 
                FROM appointments 
                WHERE doctorName = '$doctorName' 
                AND status = 'Booked'";

$resultPatients = mysqli_query($conn, $sqlPatients);
while ($row = mysqli_fetch_assoc($resultPatients)) {
    $patients[] = $row['patientName'];
}

if (isset($_POST['savePrescription'])) {

    $patient    = $_POST['patient_name'];
    $age        = $_POST['patient_age'];
    $diagnosis  = $_POST['diagnosis'];
    $treatment  = $_POST['treatment'];
    $medication = $_POST['medication'];
    $date       = date("Y-m-d H:i:s");

    $sql = "INSERT INTO prescriptions 
            (doctorName, patientName, age, diagnosis, treatment, medication, created_at)
            VALUES 
            ('$doctorName', '$patient', '$age', '$diagnosis', '$treatment', '$medication', '$date')";

    if (mysqli_query($conn, $sql)) {
        $successMsg = "Prescription saved successfully!";
    } else {
        $successMsg = "Failed to save prescription!";
    }
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

<h2>Create Prescription</h2>

<form method="post">

    <label>Patient Name</label><br>
    <select name="patient_name" required>
        <option value="">-- Select Patient --</option>
        <?php foreach ($patients as $p) { ?>
            <option value="<?php echo $p; ?>">
                <?php echo $p; ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Patient Age</label><br>
    <input type="number" name="patient_age" required min="0">
    <br><br>

    <label>Diagnosis</label><br>
    <textarea name="diagnosis" required></textarea>
    <br><br>

    <label>Treatment Notes</label><br>
    <textarea name="treatment" required></textarea>
    <br><br>

    <label>Medication List</label><br>
    <textarea name="medication" required></textarea>
    <br><br>

    <button type="submit" name="savePrescription" class="btn-save">
        Save Prescription
    </button>

</form>

<?php if ($successMsg != "") { ?>
    <p>
        <?php echo $successMsg; ?>
    </p>
<?php } ?>

</body>
</html>
