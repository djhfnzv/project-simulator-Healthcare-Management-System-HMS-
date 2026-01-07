<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Nurse') {
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    die("Database connection failed");
}

$sql = "SELECT DISTINCT patientName FROM appointments";
$result = mysqli_query($conn, $sql);
?>

<h2>Patient List</h2>

<?php if (mysqli_num_rows($result) == 0) { ?>
    <p>No patients found.</p>
<?php } else { ?>

<table id="schedule" border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>Patient Name</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo ($row['patientName']); ?></td>
    </tr>
    <?php } ?>
</table>

<?php } ?>
