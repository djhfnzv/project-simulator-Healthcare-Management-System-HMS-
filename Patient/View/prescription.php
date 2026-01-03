<?php require_once '../controller/PrescriptionController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Prescription & Diagnosis</title>

<link rel="stylesheet" href="../asset/stylePatient.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../asset/logo.png">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon">
            <img src="../asset/bell.svg" alt="Notifications">
        </div>
        <div class="icon">
            <form action="../../Profile/View/profile.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../../Icons/profile.svg" alt="Profile">
                </button>
            </form>
        </div>
        <div class="icon">
            <form action="../../Registration/Controller/logout.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../asset/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

<aside class="sidebar">
<ul>
    <li><a href="patientDashboard.php">Home</a></li>
    <li class="active"><a href="#">Prescription & Diagnosis</a></li>
</ul>
</aside>

<main class="content prescription-page">

<div class="prescription-header">
    <h1 class="page-title">Prescription & Diagnosis</h1>
</div>

<?php if (mysqli_num_rows($result) > 0) { ?>

<div class="prescription-table-wrapper">
<table class="prescription-table">
<thead>
<tr>
    <th>Doctor Name</th>
    <th>Age</th>
    <th>Diagnosis</th>
    <th>Treatment</th>
    <th>Medication</th>
    <th>Date</th>
</tr>
</thead>
<tbody>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= htmlspecialchars($row['doctorName']) ?></td>
    <td><?= htmlspecialchars($row['age']) ?></td>
    <td><?= htmlspecialchars($row['diagnosis']) ?></td>
    <td><?= htmlspecialchars($row['treatment']) ?></td>
    <td><?= htmlspecialchars($row['medication']) ?></td>
    <td><?= date("d M Y, h:i A", strtotime($row['created_at'])) ?></td>
</tr>
<?php } ?>

</tbody>
</table>
</div>

<?php } else { ?>

<p class="no-data">No prescriptions found for you.</p>

<?php } ?>

</main>
</div>

</body>
</html>
