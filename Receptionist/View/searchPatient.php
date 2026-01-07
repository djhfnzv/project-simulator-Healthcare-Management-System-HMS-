<?php
require_once '../../DB/dbUser.php';
$con = connection();

$patient = null;
$appointments = null;
$billHistory = null;
$showBill = false;
$phone = '';

if (isset($_POST['search']) || isset($_POST['bill_history'])) {
    $phone = $_POST['phone'];

    $patient = mysqli_query(
        $con,
        "SELECT * FROM users 
         WHERE mobile='$phone' AND role='patient'"
    );

    $appointments = mysqli_query(
        $con,
        "SELECT doctorName, speciality, day, timeSlot
         FROM appointmentsandbill
         WHERE patientEmail = (
            SELECT email FROM users WHERE mobile='$phone'
         )
         ORDER BY datetime DESC"
    );
}

if (isset($_POST['bill_history'])) {
    $showBill = true;

    $billHistory = mysqli_query(
        $con,
        "SELECT doctorName, speciality, day, timeSlot,
                appointmentFee, paymentMethod, datetime, status
         FROM appointmentsandbill
         WHERE patientEmail = (
            SELECT email FROM users WHERE mobile='$phone'
         )
         ORDER BY datetime DESC"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Search Patient</title>
<link rel="stylesheet" href="../Asset/styleReceptionist.css">

<style>

table {
    border-collapse: collapse;
    width: 100%;
    background: #fff;
}

th, td {
    border: 1px solid #333;
    padding: 8px;
    text-align: center;
}

th {
    background: #e6e6e6;
}
</style>
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
    <li><a href="receptionistDashboard.php">Home</a></li>
    <li class="active"><a href="#">Search Patient</a></li>
</ul>
</aside>

<main class="content">

<h2>Search Patient</h2>

<form method="post">
    <input type="text" name="phone" placeholder="Enter phone number"
           value="<?= $phone ?>" required>
    <input type="submit" name="search" value="Search">
</form>

<?php if ($patient && mysqli_num_rows($patient) > 0): 
$p = mysqli_fetch_assoc($patient);
?>



<h3>Patient Information</h3>
<p><b>Name:</b> <?= $p['name'] ?></p>
<p><b>Email:</b> <?= $p['email'] ?></p>
<p><b>Phone:</b> <?= $p['mobile'] ?></p>
<p><b>Blood Group:</b> <?= $p['bloodgroup'] ?></p>



<h3>Appointment History</h3>

<table>
<tr>
    <th>Doctor</th>
    <th>Speciality</th>
    <th>Day</th>
    <th>Time</th>
</tr>

<?php if ($appointments && mysqli_num_rows($appointments) > 0): ?>
<?php while ($a = mysqli_fetch_assoc($appointments)): ?>
<tr>
    <td><?= $a['doctorName'] ?></td>
    <td><?= $a['speciality'] ?></td>
    <td><?= $a['day'] ?></td>
    <td><?= $a['timeSlot'] ?></td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr><td colspan="4">No appointments found</td></tr>
<?php endif; ?>
</table>

<br>

<form method="post">
    <input type="hidden" name="phone" value="<?= $phone ?>">
    <input type="submit" name="bill_history" value="Bill History">
</form>

<?php endif; ?>

<?php if ($showBill && $billHistory): ?>


<h3>Bill History</h3>

<table>
<tr>
    <th>Doctor</th>
    <th>Speciality</th>
    <th>Day</th>
    <th>Time</th>
    <th>Amount</th>
    <th>Payment Method</th>
    <th>Date & Time</th>
    <th>Status</th>
</tr>

<?php if (mysqli_num_rows($billHistory) > 0): ?>
<?php while ($b = mysqli_fetch_assoc($billHistory)): ?>
<tr>
    <td><?= $b['doctorName'] ?></td>
    <td><?= $b['speciality'] ?></td>
    <td><?= $b['day'] ?></td>
    <td><?= $b['timeSlot'] ?></td>
    <td><?= $b['appointmentFee'] ?></td>
    <td><?= ucfirst($b['paymentMethod'] ?? 'N/A') ?></td>
    <td><?= date('d M Y, h:i A', strtotime($b['datetime'])) ?></td>
    <td><?= ucfirst($b['status']) ?></td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr><td colspan="8">No bill history found</td></tr>
<?php endif; ?>
</table>

<?php endif; ?>

</main>
</div>

</body>
</html>
