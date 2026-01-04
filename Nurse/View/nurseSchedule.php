<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Nurse') {
    exit("Unauthorized access");
}

$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    die("Database connection failed");
}

$nurseName = $_SESSION['user']['name'];

$sql = "SELECT * FROM nurseSchedule WHERE nurseName = '$nurseName'";
$result = mysqli_query($conn, $sql);
?>

<h2>My Duty Schedule</h2>

<?php if (mysqli_num_rows($result) == 0) { ?>
    <p>No duty schedule found for you.</p>
<?php } else { ?>

<table id="schedule" border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>Nurse Name</th>
        <th>Time Slot</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo ($row['nurseName']); ?></td>
            <td><?php echo ($row['timeSlot']); ?></td>
        </tr>
    <?php } ?>
</table>

<?php } ?>
