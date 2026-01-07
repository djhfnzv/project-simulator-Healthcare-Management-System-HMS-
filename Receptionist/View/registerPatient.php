<?php require_once '../controller/RegisterPatientController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Patient</title>
    <link rel="stylesheet" href="../Asset/styleReceptionist.css">
    <script src="../Asset/registerPatient.js" ></script>
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
    <li><a href="receptionistDashboard.php">Home</a></li>
    <li class="active"><a href="#">Register Patient</a></li>
</ul>
</aside>

<main class="content">
<h2>Register Patient</h2>

<form method="post">
<table>

<tr>
    <td>Name</td>
    <td><input type="text" name="name" required></td>
</tr>

<tr>
    <td>Age</td>
    <td><input type="number" name="age" required></td>
</tr>

<tr>
    <td>Blood Group</td>
    <td>
        <select name="bloodGroup" required>
            <option value="">Select</option>
            <option>A+</option><option>A-</option>
            <option>B+</option><option>B-</option>
            <option>AB+</option><option>AB-</option>
            <option>O+</option><option>O-</option>
        </select>
    </td>
</tr>

<tr>
<td>Gender</td>
<td>
<input type="radio" name="gender" value="Male" required> Male
<input type="radio" name="gender" value="Female"> Female
</td>
</tr>

<tr>
<td>Date of Birth</td>
<td><input type="date" name="dob" required></td>
</tr>

<tr>
<td>Email</td>
<td><input type="email" name="email" required></td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" name="password" required></td>
</tr>

<tr>
<td>Phone</td>
<td><input type="text" name="phone" required></td>
</tr>

<tr>
<td colspan="2" align="center">
<input type="submit" value="Register Patient">
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
