<?php require_once '../controller/CancelRescheduleController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel / Reschedule Appointment</title>
    
    <link rel="stylesheet" href="../Asset/styleReceptionist.css">
    <script src="../Asset/cancelReschedule.js"></script>
    <script src="../Asset/rescheduleAjax.js"></script>
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
    
<button onclick="cancelAppointmentAjax(<?= $a['id'] ?>)"
        style="background:red;color:black;padding:5px;">
        Cancel
</button>


<form method="post" style="display:inline;" id="rescheduleForm-<?= $a['id'] ?>">

    <input type="hidden" name="appointment_id" value="<?= $a['id'] ?>">

    <!-- Day select -->
    <select name="day" id="day-<?= $a['id'] ?>">
        <option value="">Select Day</option>
        <?php
        $days = mysqli_query(
            $con,
            "SELECT DISTINCT day FROM doctorschedule
             WHERE doctorName='{$a['doctorName']}'"
        );
        while ($d = mysqli_fetch_assoc($days)) {
        ?>
        <option value="<?= $d['day'] ?>"><?= $d['day'] ?></option>
        <?php } ?>
    </select>

    <!-- Time select -->
    <select name="timeSlot" id="time-<?= $a['id'] ?>">
        <option value="">Select Time</option>
        <?php
        $slots = mysqli_query(
            $con,
            "SELECT timeSlot FROM doctorschedule
             WHERE doctorName='{$a['doctorName']}'"
        );
        while ($s = mysqli_fetch_assoc($slots)) {
        ?>
        <option value="<?= $s['timeSlot'] ?>"><?= $s['timeSlot'] ?></option>
        <?php } ?>
    </select>

    <!-- JS Button -->
    <button type="button" class="reschedule-btn"
        onclick="rescheduleAppointmentAjax(
            <?= $a['id'] ?>,
            document.getElementById('day-<?= $a['id'] ?>').value,
            document.getElementById('time-<?= $a['id'] ?>').value
        )">
        Reschedule
    </button>

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
