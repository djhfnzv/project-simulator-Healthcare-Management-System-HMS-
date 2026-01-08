<?php require_once '../controller/ManageAppointmentController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Schedule Appointment</title>

<link rel="stylesheet" href="../Asset/styleReceptionist.css">
<script src="../Asset/manageAppointment.js"></script>
<script src="../Asset/manageAppointmentAjax.js"></script>
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
    <li class="active"><a href="#">Schedule & Manage Appointments</a></li>
</ul>
</aside>

<main class="content">
<h2>Schedule Appointments</h2>

<form method="post" onsubmit="return validateForm();">
<table>

<tr>
    <td>Patient</td>
    <td>
        <select name="patient" id="patient">
            <option value="">Select Patient</option>
            <?php while ($p = mysqli_fetch_assoc($patients)) {
                $val = $p['email'].'|'.$p['name'];
                ?>
            <option value="<?= $val ?>" <?= ($selectedPatientEmail.'|'.$selectedPatientName == $val)?'selected':'' ?>>
                <?= $p['name'] ?> (<?= $p['email'] ?>)
            </option>
            <?php } ?>
        </select>
    </td>
</tr>

<tr>
    <td>Speciality</td>
    <td>
        <select name="speciality" id="speciality" onchange="loadDoctorsAjax()">
            <option value="">Select Speciality</option>
            <?php while ($s = mysqli_fetch_assoc($specialities)) { ?>
                <option value="<?= $s['speciality'] ?>" <?= ($s['speciality']==$selectedSpeciality)?'selected':'' ?>>
                    <?= $s['speciality'] ?>
                </option>
            <?php } ?>
        </select>
    </td>
</tr>

<tr>
    <td>Doctor</td>
    <td>
        <select name="doctor" id="doctor" onchange="this.form.submit()">
            <option value="">Select Doctor</option>
            <?php while ($d = mysqli_fetch_assoc($doctors)) { ?>
                <option value="<?= $d['doctorName'] ?>" <?= ($d['doctorName']==$selectedDoctor)?'selected':'' ?>>
                    <?= $d['doctorName'] ?>
                </option>
            <?php } ?>
        </select>
    </td>
</tr>

<tr>
    <td>Day</td>
    <td>
        <select name="day" id="day" onchange="this.form.submit()">
            <option value="">Select Day</option>
            <?php while ($d = mysqli_fetch_assoc($days)) { ?>
                <option value="<?= $d['day'] ?>" <?= ($d['day']==$selectedDay)?'selected':'' ?>>
                    <?= $d['day'] ?>
                </option>
            <?php } ?>
        </select>
    </td>
</tr>

<tr>
    <td>Time Slot</td>
    <td>
        <select name="timeSlot" id="timeSlot">
            <option value="">Select Time</option>
            <?php
            if ($timeQuery) {
                mysqli_data_seek($timeQuery, 0);
            while ($t = mysqli_fetch_assoc($timeQuery)) {
            ?>
            <option value="<?= $t['timeSlot'] ?>" <?= ($t['timeSlot']==$selectedTime)?'selected':'' ?>>
                <?= $t['timeSlot'] ?>
            </option>
            <?php }} ?>
        </select>
    </td>
</tr>

<tr>
    <td>Fee</td>
    <td><input type="number" value="<?= $fee ?>" readonly></td>
</tr>

<tr>
    <td colspan="2">
        <input type="submit" name="book" value="Book Appointment">
    </td>
</tr>

</table>
</form>

<p style="margin-top:15px;font-weight:bold;">
<?= $message ?>
</p>

</main>
</div>

</body>
</html>
