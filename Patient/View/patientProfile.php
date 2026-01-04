<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="../../CSS/style1.css">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../Asset/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon">
            <img src="../Asset/bell.svg" alt="Notifications">
        </div>
        <div class="icon">
            <img src="../Asset/profile.svg" alt="Profile">
        </div>
        <div class="icon">
            <form action="../../Registration/Controller/logout.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../Asset/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <ul>
            <li><a href="patientDashboard.php">Home</a></li>
            <li class="active"><a href="patientProfile.php">Profile</a></li>
            <li><a href="../../Registration/Controller/logout.php">Log Out</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <main class="content">
        <h1>Patient Profile</h1>

        <form method="post" enctype="multipart/form-data">

            <p><strong>ID No:</strong> P-1001</p>

            <br>

            <label>Change Photo:</label><br>
            <input type="file" name="photo"><br><br>

            <label>Name:</label><br>
            <input type="text" name="name"><br><br>

            <label>Age:</label><br>
            <input type="number" name="age"><br><br>

            <label>Blood Group:</label><br>
            <input type="text" name="blood_group"><br><br>

            <label>Date of Birth:</label><br>
            <input type="date" name="dob"><br><br>

            <label>Email:</label><br>
            <input type="email" name="email"><br><br>

            <label>Password:</label><br>
            <input type="password" name="password"><br><br>

            <label>Phone Number:</label><br>
            <input type="text" name="phone"><br><br>

            <input type="submit" value="Update Profile">

        </form>
    </main>

</div>

</body>
</html>
