<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}

$con = connection();
$email = $_SESSION['user']['email'];

$query = "select * from appointmentsandbill where patientEmail='$email'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment History</title>
    <link rel="stylesheet" href="../Asset/stylePayment.css">
    <script src="../Asset/validatePayment.js"></script>
</head>
<body>

<h2>Your Appointments</h2>

<table border="1" width="100%">
<tr>
    <th>Doctor</th>
    <th>Speciality</th>
    <th>Time Slot</th>
    <th>Fee</th>
    <th>Status</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['doctorName'] ?></td>
    <td><?= $row['speciality'] ?></td>
    <td><?= $row['timeSlot'] ?></td>
    <td><?= $row['appointmentFee'] ?></td>
    <td>
<?php
$status = $row['status'];

if ($status == 'completed') 
    {
        echo "<span style='color: green; font-weight: bold;'>Paid</span>";
    }
elseif ($status == 'confirmed')
    {
        echo "<span style='color: red; font-weight: bold;'>Due</span>";
    }
else 
    {
        echo ucfirst($status);
    }
?>
</td>
</tr>
<?php } ?>
</table>

<br>

<form action="../Controller/calculateBill.php" method="post">
    <button type="submit">Total Bill</button>
</form>

<?php if (isset($_SESSION['totalBill'])) { ?>
    <h3>Total Bill: <?= $_SESSION['totalBill'] ?> BDT</h3>
    <h3>Status: DUE</h3>

    <a href="paymentPage.php">
        <button>Pay</button>
    </a>
<?php } ?>

    <br><br>

    <a href="../../Patient/View/patientDashboard.php">
        <button>Home</button>
    </a>

</body>
</html>
