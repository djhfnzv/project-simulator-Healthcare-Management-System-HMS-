<?php require_once '../controller/CancelAppointmentController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cancel Appointment</title>

<link rel="stylesheet" href="../Asset/styleCancelAppointment.css">
<script src="../Asset/patientCancelAppointment.js"></script>
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../Asset/logo.png">
        <span>Healthcare Management System</span>
    </div>
</header>

<div class="container">

<aside class="sidebar">
<ul>
    <li><a href="../../Patient/View/patientDashboard.php">Home</a></li>
    <li class="active"><a href="#">Cancel Appointment</a></li>
</ul>
</aside>

<main class="content">
<h2>My Appointments</h2>

<table>
<tr>
    <th>ID</th>
    <th>Doctor</th>
    <th>Speciality</th>
    <th>Day</th>
    <th>Time Slot</th>
    <th>Fee</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['doctorName'] ?></td>
    <td><?= $row['speciality'] ?></td>
    <td><?= $row['day'] ?></td>
    <td><?= $row['timeSlot'] ?></td>
    <td><?= $row['appointmentFee'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <?php if ($row['status'] == 'confirmed' || $row['status'] == 'pending') { ?>
        <form method="post"
              onsubmit="return confirmCancelPatient();"
              style="margin:0;">
            <input type="hidden" name="appointment_id" value="<?= $row['id'] ?>">
            <input type="submit" name="cancel" value="Cancel" class="cancel-btn">
        </form>
        <?php } else { echo "Paid"; } ?>
    </td>
</tr>
<?php
    }
} else {
    echo "<tr><td colspan='8' align='center'>No appointments found</td></tr>";
}
?>

</table>

<p class="message"><?= $message ?></p>

</main>
</div>

</body>
</html>
