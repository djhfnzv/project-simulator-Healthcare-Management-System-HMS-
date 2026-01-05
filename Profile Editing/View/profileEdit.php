<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../../Login/View/login.php");
    exit();
}

$con = connection();
$email = $_SESSION['user']['email'];

$query = "select * from users where email ='$email'";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    echo "User data not found";
    exit();
}

$user = mysqli_fetch_assoc($result);
?>

<html>
<head>
    <title>Healthcare Management System - Profile</title>
    <link rel="stylesheet" href="../Asset/cssProfile.css?v=1">
</head>

<body>

<header class="topbar">
    <div class="logo">
        <img src="../../Icons/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">
        <div class="icon">
            <img src="../../Icons/bell.svg" alt="Notifications">
        </div>

        <div class="icon">
            <form action="../../Profile/View/profile.php" method="post" class="logout-form">
                <button type="submit">
                    <img src="../../Icons/profile.svg" alt="Profile">
                </button>
            </form>
        </div>

        <div class="icon">
            <form action="../../Logout/Controller/logout.php" method="post" class="logout-form">
                <button type="submit" class="active">
                    <img src="../../Icons/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

    <aside class="sidebar">
        <ul>
            <li><a href="../../Role_Based_Access_Control/Controller/homeRedirect.php">Home</a></li>

            <li class="menu-title">Manage</li>
            <ul class="submenu">
                <li><a href="../../Role_Based_Access_Control/Controller/homeRedirect.php">Doctor</a></li>
                <li><a href="../../Role_Based_Access_Control/Controller/homeRedirect.php">Nurse</a></li>
                <li><a href="../../Role_Based_Access_Control/Controller/homeRedirect.php">Receptionist</a></li>
                <li><a href="../../Role_Based_Access_Control/Controller/homeRedirect.php">Patient</a></li>
            </ul>

            <li><a href="bills.php">Bills</a></li>
            <li><a href="userRecord.php">User Record</a></li>
        </ul>
    </aside>

    <main class="content">
        <h2>Edit Profile</h2>

        <!-- validation messages -->
        <?php
            if (isset($_SESSION['profileError'])) {
                echo "<ul style='color:red'>";
                foreach ($_SESSION['profileError'] as $err) {
                    echo "<li>$err</li>";
                }
                echo "</ul>";
                unset($_SESSION['profileError']);
            }

            if (isset($_SESSION['profileSuccess'])) {
                echo "<p style='color:green'>" . $_SESSION['profileSuccess'] . "</p>";
                unset($_SESSION['profileSuccess']);
            }
        ?>

        <form method="POST" action="../Controller/checkValid.php" enctype="multipart/form-data">
            <table class="profile-table">

                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $user['name']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Age</td>
                    <td>
                        <input type="text" name="age" value="<?php echo $user['age']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Mobile</td>
                    <td>
                        <input type="text" name="mobile" value="<?php echo $user['mobile']; ?>">
                    </td>
                </tr>

                <?php if ($user['role'] === "Doctor") { ?>
                <tr>
                    <td>Speciality</td>
                    <td>
                        <input type="text" name="speciality" value="<?php echo $user['speciality']; ?>">
                    </td>
                </tr>
                <?php } else { ?>
                    <input type="hidden" name="speciality" value="">
                <?php } ?>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirmPassword">
                    </td>
                </tr>

                <tr>
                    <td>Profile Image</td>
                    <td>
                        <input type="file" name="myfile">
                    </td>
                </tr>

            </table>

            <input type="submit" value="Save Changes" class="profileEdit-form">
        </form>
    </main>
</div>

</body>
</html>
