<?php
session_start();
require_once '../../../DB/dbUser.php';

/* ===== Session Protection ===== */
if (!isset($_SESSION['user'])) {
    header("Location: ../../../Login/View/login.php");
    exit();
}

$con = connection();

/* ===== Fetch Specialities ===== */
$specialityQuery = "SELECT DISTINCT speciality FROM bookdoctorappointment";
$specialities = mysqli_query($con, $specialityQuery);

/* ===== Selected Values ===== */
$selectedSpeciality = $_POST['speciality'] ?? '';
$selectedDoctor     = $_POST['doctor'] ?? '';
$selectedTime       = $_POST['timeSlot'] ?? '';
$fee = '';

/* ===== Fetch Doctors ===== */
$doctorQuery = "SELECT DISTINCT name FROM bookdoctorappointment";
if ($selectedSpeciality != '') {
    $doctorQuery .= " WHERE speciality='$selectedSpeciality'";
}
$doctors = mysqli_query($con, $doctorQuery);

/* ===== Fetch Time Slots & Fee ===== */
$timeQuery = null;
if ($selectedDoctor != '') {
    $timeQuery = mysqli_query(
        $con,
        "SELECT timeSlot, appointmentFee
         FROM bookdoctorappointment
         WHERE name='$selectedDoctor'"
    );

    $row = mysqli_fetch_assoc($timeQuery);
    $fee = $row['appointmentFee'] ?? '';
}

/* ===== Message ===== */
$message = "";

/* ===== Handle Booking ===== */
if (isset($_POST['book'])) {

    $patientEmail = $_SESSION['user']['email'];
    $patientName  = $_SESSION['user']['name'];

    $checkQuery = "
        SELECT id FROM appointments
        WHERE doctorName='$selectedDoctor'
        AND timeSlot='$selectedTime'
        AND status='Booked'
    ";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $message = "❌ This time slot is already booked!";
    } else {

        $insertQuery = "
            INSERT INTO appointments
            (patientEmail, patientName, speciality, doctorName, timeSlot, appointmentFee, status)
            VALUES
            ('$patientEmail','$patientName','$selectedSpeciality','$selectedDoctor','$selectedTime','$fee','Booked')
        ";

        if (mysqli_query($con, $insertQuery)) {
            $message = "✅ Appointment booked successfully!";
        } else {
            $message = "❌ Booking failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Appointment</title>
<link rel="stylesheet" href="../Asset/styleBookAppointment.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../Asset/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>
</header>

<div class="container">

<aside class="sidebar">
    <ul>
        <li><a href="../../View/patientDashboard.php">Home</a></li>
        <li class="active"><a href="#">Book Appointment</a></li>
    </ul>
</aside>

<main class="content">
<h2>Book Appointment</h2>

<form method="post">
<table>

<tr>
<td>Speciality</td>
<td>
<select name="speciality" onchange="this.form.submit()" required>
<option value="">Select Speciality</option>
<?php while($row = mysqli_fetch_assoc($specialities)) { ?>
<option value="<?= $row['speciality'] ?>"
<?= ($row['speciality']==$selectedSpeciality)?'selected':'' ?>>
<?= $row['speciality'] ?>
</option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td>Doctor Name</td>
<td>
<select name="doctor" onchange="this.form.submit()" required>
<option value="">Select Doctor</option>
<?php while($doc = mysqli_fetch_assoc($doctors)) { ?>
<option value="<?= $doc['name'] ?>"
<?= ($doc['name']==$selectedDoctor)?'selected':'' ?>>
<?= $doc['name'] ?>
</option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td>Time Slot</td>
<td>
<select name="timeSlot" required>
<option value="">Select Time</option>
<?php
if ($timeQuery) {
    mysqli_data_seek($timeQuery, 0);
    while($t = mysqli_fetch_assoc($timeQuery)) {
?>
<option value="<?= $t['timeSlot'] ?>"
<?= ($t['timeSlot']==$selectedTime)?'selected':'' ?>>
<?= $t['timeSlot'] ?>
</option>
<?php }} ?>
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
