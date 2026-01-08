<?php
//session_start();  // add this if not already started

$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    die("Database connection failed");
}

// Determine role and name
$role = $_SESSION['user']['role'];
$userName = $_SESSION['user']['name'];

// SQL for Doctor or Nurse
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
        AND p.doctorName = '$userName'
    WHERE a.doctorName = '$userName'
    ORDER BY a.patientName
    ";
} else {
    // Nurse sees all patients' appointments + prescriptions
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

<?php
if (mysqli_num_rows($result) == 0) {
    echo "<p>No medical records found.</p>";
} else {
?>
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
