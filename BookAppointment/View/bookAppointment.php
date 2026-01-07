<?php require_once '../controller/BookAppointmentController.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book Appointment</title>
        <link rel="stylesheet" href="../Asset/styleBookAppointment.css">
        <script src="../Asset/bookAppointment.js" defer></script>
        <script src="../Asset/bookAppointmentAjax.js"></script>
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
    <li class="active"><a href="#">Book Appointment</a></li>
</ul>
</aside>

<main class="content">
<h2>Book Appointment</h2>

<form method="post" onsubmit="return validateBooking();">
<table>

<tr>
    <td>Speciality</td>
    <td>
        <select name="speciality" id="speciality" onchange="loadDoctors()">
            <option value="">Select Speciality</option>
            <?php while($s = mysqli_fetch_assoc($specialities)) { ?>
                <option value="<?= $s['speciality'] ?>" <?= ($s['speciality']==$selectedSpeciality)?'selected':'' ?>>
                    <?= $s['speciality'] ?>
                </option>
            <?php } ?>
        </select>
    </td>
</tr>

<tr>
    <td>Doctor Name</td>
    <td>
        <select name="doctor" id="doctor" onchange="this.form.submit()">
            <option value="">Select Doctor</option>
            <?php while($d = mysqli_fetch_assoc($doctors)) { ?>
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
            <?php if ($days) while($dy = mysqli_fetch_assoc($days)) { ?>
                <option value="<?= $dy['day'] ?>" <?= ($dy['day']==$selectedDay)?'selected':'' ?>>
                    <?= $dy['day'] ?>
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
                while($t = mysqli_fetch_assoc($timeQuery)) {
                    ?>
                    <option value="<?= $t['timeSlot'] ?>" <?= ($t['timeSlot']==$selectedTime)?'selected':'' ?>>
                        <?= $t['timeSlot'] ?>
                    </option>
                    <?php 
                }
            } ?>
        </select>
    </td>
</tr>

<tr>
    <td>Appointment Fee</td>
    <td>
        <input type="number" value="<?= $fee ?>" readonly>
    </td>
</tr>

<tr>
    <td colspan="2">
        <input type="submit" name="book" value="Book Appointment">
    </td>
</tr>

</table>
</form>

<p class="message"><?= $message ?></p>

</main>
</div>

</body>
</html>
