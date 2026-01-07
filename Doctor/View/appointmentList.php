<?php
$conn = mysqli_connect("localhost", "root", "", "project");
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
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['patientName']; ?></td>
    <td><?php echo $row['patientEmail']; ?></td>
    <td><?php echo $row['speciality']; ?></td>
    <td><?php echo $row['timeSlot']; ?></td>
    <td><?php echo $row['appointmentFee']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>

</table>

<?php } ?>
