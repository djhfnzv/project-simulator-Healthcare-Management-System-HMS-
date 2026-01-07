<?php require_once '../controller/CancelRescheduleController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel / Reschedule Appointment</title>
    
    <link rel="stylesheet" href="../Asset/styleReceptionist.css">
    <script src="../Asset/cancelReschedule.js"></script>
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
    <li><a href="../../Receptionist/View/receptionistDashboard.php">Home</a></li>
    <li class="active"><a href="#">Cancel / Reschedule</a></li>
</ul>
</aside>

<main class="content">
<h2>Cancel / Reschedule Appointments</h2>

<table border="1" width="100%" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Day</th>
    <th>Time</th>
    <th>Action</th>
</tr>

<?php while ($a = mysqli_fetch_assoc($appointments)) { ?>
    <tr>
        <td><?= $a['id'] ?></td>
        <td><?= $a['patientName'] ?></td>
        <td><?= $a['doctorName'] ?></td>
        <td><?= $a['day'] ?></td>
        <td><?= $a['timeSlot'] ?></td>
        <td>

<form method="post" style="display:inline;"
onsubmit="return confirmCancel();">
<input type="hidden" name="appointment_id" value="<?= $a['id'] ?>">
<input type="submit" name="cancel" value="Cancel"
style="background:red;color:black;padding:5px;">
</form>

<form method="post" style="display:inline;"
onsubmit="return validateReschedule(this);">

<input type="hidden" name="appointment_id" value="<?= $a['id'] ?>">

<select name="day">
<option value="">Select Day</option>
<?php
$days = mysqli_query(
    $con,
    "select distinct day from doctorschedule
     where doctorName='{$a['doctorName']}'"
);
while ($d = mysqli_fetch_assoc($days)) {
?>
<option value="<?= $d['day'] ?>"><?= $d['day'] ?></option>
<?php } ?>
</select>

<select name="timeSlot">
<option value="">Select Time</option>
<?php
$slots = mysqli_query(
    $con,
    "select timeSlot from doctorschedule
     where doctorName='{$a['doctorName']}'"
);
while ($s = mysqli_fetch_assoc($slots)) {
?>
<option value="<?= $s['timeSlot'] ?>"><?= $s['timeSlot'] ?></option>
<?php } ?>
</select>

<input type="submit" name="reschedule" value="Reschedule">

</form>

</td>
</tr>

<?php } ?>

</table>

<p style="margin-top:15px;font-weight:bold;">
<?= $message ?>
</p>

</main>
</div>

</body>
</html>
