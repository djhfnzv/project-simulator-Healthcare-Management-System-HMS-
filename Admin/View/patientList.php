<?php
    session_start();

    if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
        header("Location: ../../Login/View/login.php");
        exit();
    }

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        echo "Access denied!";
        exit();
    }

    if (!isset($_SESSION['user'])) {
        echo "User data not found!";
        exit();
    }
    require_once '../../DB/dbUser.php';
?>

<html>
<head>
    <title>Healthcare Management System</title>
    <link rel="stylesheet" href="../Asset/cssAdminP.css">
</head>

<body>
<script src="../Asset/adminPatient.js"></script>
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
                <button type="submit" class="icon-btn">
                    <img src="../../Icons/profile.svg" alt="Profile">
                </button>
            </form>
            
        </div>
        <div class="icon">
            <form action="../../Logout/Controller/logout.php" method="post" class="logout-form">
                <button type="submit" class="icon-btn">
                    <img src="../../Icons/logout.svg" alt="Logout">
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">

    <aside class="sidebar">
        <ul>
            <li><a href="adminDashboard.php">Home</a></li>
            
            <li class="menu-title">Manage</li>
            <ul class="submenu">
                <li><a href="doctorList.php">Doctor</a></li>
                <li><a href="nurseList.php">Nurse</a></li>
                <li><a href="receptionistList.php">Receptionist</a></li>
                <li class="active"><a href="patientList.php">Patient</a></li>
            </ul>

            <li><a href="bills.php">Bills</a></li>
            <li><a href="../../User_Activity/View/userActivity.php">User Record</a></li>
        </ul>
    </aside>

    <main class="content">

        <h1>Patient List</h1>

        <?php
            $con = connection();
            $patients = [];

            $query = "select name,age,dob,email,password,mobile,speciality 
                    from users where role='patient'";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $patients[] = $row;
                }
            }
        ?>

        <div class="patient-layout">

            <!-- LEFT: patient List -->
            <div class="patient-list">
                <table class="patient-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>DOB</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($patients as $nrs) { ?>
                        <tr>
                            <td><?php echo $nrs['name'] ?></td>
                            <td><?php echo $nrs['age'] ?></td>
                            <td><?php echo $nrs['dob'] ?></td>
                            <td><?php echo $nrs['email'] ?></td>
                            <td><?php echo $nrs['password'] ?></td>
                            <td><?php echo $nrs['mobile'] ?></td>
                            <td>
                                <button type="button" onclick='selectpatient(
                                    "<?php echo $nrs['name'] ?>",
                                    "<?php echo $nrs['age'] ?>",
                                    "<?php echo $nrs['dob'] ?>",
                                    "<?php echo $nrs['email'] ?>",
                                    "<?php echo $nrs['mobile'] ?>"
                                )'>Select</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- RIGHT: patient Management -->
            <div class="patient-manage">
                <form action="../Controller/checkValidAll.php" method="post" id="patientForm">
                    <input type="hidden" name="role" id="role" value="Patient">

                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="email_key" id="email_key">

                    <table class="patient-manage-table">
                        <tr>
                            <th colspan="2">Patient Management</th>
                        </tr>

                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" id="name" disabled></td>
                        </tr>

                        <tr>
                            <td>Age</td>
                            <td><input type="number" name="age" id="age" disabled></td>
                        </tr>

                        <tr>
                            <td>DOB</td>
                            <td><input type="date" name="dob" id="dob" disabled></td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" id="email" disabled></td>
                        </tr>

                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" id="password" disabled></td>
                        </tr>

                        <tr>
                            <td>Mobile</td>
                            <td><input type="text" name="mobile" id="mobile" disabled></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="btn-group">
                                    <button type="button" onclick="addpatient()">Add</button>
                                    <button type="button" onclick="editpatient()">Edit</button>
                                    <button type="button" onclick="deletepatient()">Delete</button>
                                    <button type="submit" id="saveBtn" disabled>Save</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>
</div>

</body>
</html>

