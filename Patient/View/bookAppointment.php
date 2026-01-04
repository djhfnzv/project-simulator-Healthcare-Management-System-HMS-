<?php
$bookingMessage = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $doctor = $_POST['doctor'];
    $date   = $_POST['date'];
    $time   = $_POST['time'];

    
    $bookedDoctor = "Dr. Rahman";
    $bookedDate   = "2025-01-10";
    $bookedTime   = "10:00 AM";

    if ($doctor == $bookedDoctor && $date == $bookedDate && $time == $bookedTime) {
        $bookingMessage = "Seected time slot is already booked. Please choose another slot.";
        $status = "Failed";
    } else {
        $bookingMessage = "Appointment booked successfully!";
        $status = "Confirmed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="../../CSS/style1.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../Asset/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon"><img src="../Asset/bell.svg"></div>
        <div class="icon"><img src="../Asset/profile.svg"></div>
        <div class="icon">
            <form action="../../Registration/Controller/logout.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../Asset/logout.svg">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

    <aside class="sidebar">
        <ul>
            <li><a href="patientDashboard.php">Home</a></li>
            <li class="active"><a href="bookAppointment.php">Book Appointment</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Book Appointment</h1>

        <form method="post">

            <label>Select Doctor:</label><br>
            <select name="doctor" required>
                <option value="">-- Select Doctor --</option>
                <option>Dr. Rahman</option>
                <option>Dr. Ahmed</option>
                <option>Dr. Sultana</option>
            </select><br><br>

            <label>Select Date:</label><br>
            <input type="date" name="date" required><br><br>

            <label>Available Time Slots:</label><br>
            <select name="time" required>
                <option value="">-- Select Time --</option>
                <option>10:00 AM</option>
                <option>11:00 AM</option>
                <option>02:00 PM</option>
                <option>03:00 PM</option>
            </select><br><br>

            <input type="submit" value="Confirm Appointment">

        </form>

        <br>

        <?php if ($bookingMessage != "") { ?>
            <h3>Appointment Status: <?php echo $status; ?></h3>
            <p><?php echo $bookingMessage; ?></p>
        <?php } ?>

    </main>

</div>

</body>
</html>
