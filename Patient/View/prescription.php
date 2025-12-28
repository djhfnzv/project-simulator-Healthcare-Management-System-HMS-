<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription & Diagnosis</title>
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
            <li class="active"><a href="prescriptions.php">Prescription</a></li>
            <li><a href="doctorDetails.php">Doctor Details</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <main class="content">
        <h1>Prescription</h1>

        <img 
            src="../Asset/prescription_sample.png" 
            alt="Prescription Image"
            style="width: 400px; margin-top: 20px; border: 1px solid #333;"
        >
    </main>

</div>

</body>
</html>
