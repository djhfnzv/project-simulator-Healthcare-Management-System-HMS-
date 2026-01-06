<?php
require_once '../controller/SearchPatientController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Patient</title>
    <link rel="stylesheet" href="../Asset/styleReceptionist.css">
    <script src="../Asset/searchPatientValidation.js"  ></script>
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
        <li><a href="../../Receptionist/View/receptionistDashboard.php">Home</a></li>
        <li class="active"><a href="#">Search Patient</a></li>
    </ul>
</aside>

<main class="content">

<h2>Search Patient</h2>

<form method="post" id="searchForm">
    <input type="text" name="phone" id="phone"
           placeholder="Enter phone number"
           value="<?php echo $phone; ?>">
    <input type="submit" name="search" value="Search">
    <p id="phoneError" class="error"></p>
</form>

<?php

if ($patient && mysqli_num_rows($patient) > 0) {

    $p = mysqli_fetch_assoc($patient);
?>
    <h3>Patient Information</h3>
    <p><b>Name:</b> <?php echo $p['name']; ?></p>
    <p><b>Email:</b> <?php echo $p['email']; ?></p>
    <p><b>Phone:</b> <?php echo $p['mobile']; ?></p>
    <p><b>Blood Group:</b> <?php echo $p['bloodgroup']; ?></p>

    <h3>Appointment History</h3>

    <table>
        <tr>
            <th>Doctor</th>
            <th>Speciality</th>
            <th>Day</th>
            <th>Time</th>
        </tr>

        <?php
        if ($appointments && mysqli_num_rows($appointments) > 0) {
            while ($a = mysqli_fetch_assoc($appointments)) {
        ?>
                <tr>
                    <td><?php echo $a['doctorName']; ?></td>
                    <td><?php echo $a['speciality']; ?></td>
                    <td><?php echo $a['day']; ?></td>
                    <td><?php echo $a['timeSlot']; ?></td>
                </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td colspan="4">No appointments found</td>
            </tr>
        <?php
        }
        ?>
    </table>

    <br>

    <form method="post">
        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
        <input type="submit" name="bill_history" value="Bill History">
    </form>

<?php
}

if ($showBill && $billHistory) {
?>
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

        <?php
        if (mysqli_num_rows($billHistory) > 0) {
            while ($b = mysqli_fetch_assoc($billHistory)) {
        ?>
                <tr>
                    <td><?php echo $b['doctorName']; ?></td>
                    <td><?php echo $b['speciality']; ?></td>
                    <td><?php echo $b['day']; ?></td>
                    <td><?php echo $b['timeSlot']; ?></td>
                    <td><?php echo $b['appointmentFee']; ?></td>
                    <td><?php echo ucfirst($b['paymentMethod'] ?? 'N/A'); ?></td>
                    <td><?php echo date('d M Y, h:i A', strtotime($b['datetime'])); ?></td>
                    <td><?php echo ucfirst($b['status']); ?></td>
                </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td colspan="8">No bill history found</td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
}
?>

</main>
</div>

</body>
</html>
