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
    <link rel="stylesheet" href="../Asset/cssAdminD.css">
</head>

<body>
<script src="../Asset/adminDoctor.js"></script>
<header class="topbar">
    <div class="logo">
        <img src="../../Icons/logo.png" alt="Logo">
        <span>Healthcare Management System</span>
    </div>

    <div class="topbar-right">

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
                <li class="active"><a href="doctorList.php">Doctor</a></li>
                <li><a href="nurseList.php">Nurse</a></li>
                <li><a href="receptionistList.php">Receptionist</a></li>
                <li><a href="patientList.php">Patient</a></li>
            </ul>

            <li><a href="bills.php">Bills</a></li>
            <li><a href="../../User_Activity/View/userActivity.php">User Record</a></li>
        </ul>
    </aside>

    <main class="content">
        <div id="successMessage" style="color:green;"></div>

        <h1>Doctor List</h1>

        <?php
            $con = connection();
            $doctors = [];

            $query = "select name,age,dob,email,password,mobile,speciality 
                    from users where role='Doctor'";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $doctors[] = $row;
                }
            }
        ?>

        <div class="doctor-layout">
            <!--doctor list-->
            <div class="doctor-list">
                <table class="doctor-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>DOB</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Mobile</th>
                            <th>Speciality</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($doctors as $doc) { ?>
                        <tr>
                            <td><?php echo  $doc['name'] ?></td>
                            <td><?php echo  $doc['age'] ?></td>
                            <td><?php echo  $doc['dob'] ?></td>
                            <td><?php echo  $doc['email'] ?></td>
                            <td><?php echo  $doc['password'] ?></td>
                            <td><?php echo  $doc['mobile'] ?></td>
                            <td><?php echo  $doc['speciality'] ?></td>
                            <td>
                                <button type="button" onclick='selectDoctor(
                                    "<?php echo  $doc['name'] ?>",
                                    "<?php echo  $doc['age'] ?>",
                                    "<?php echo  $doc['dob'] ?>",
                                    "<?php echo  $doc['email'] ?>",
                                    "<?php echo  $doc['mobile'] ?>",
                                    "<?php echo  $doc['speciality'] ?>"
                                )'>Select</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--doctor management -->
            <div class="doctor-manage">
                <form action="../Controller/checkValidDoctor.php" method="post" id="doctorForm">

                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="email_key" id="email_key">

                    <table class="doctor-manage-table">
                        <tr>
                            <th colspan="2">Doctor Management</th>
                        </tr>

                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" id="name" disabled><div id="nameError" class="error" style="color:red;"></div></td>
                        </tr>

                        <tr>
                            <td>Age</td>
                            <td><input type="text" name="age" id="age" disabled><div id="ageError" class="error" style="color:red;"></div></td>
                        </tr>

                        <tr>
                            <td>DOB</td>
                            <td><input type="date" name="dob" id="dob" disabled><div id="dobError" class="error" style="color:red;"></div></td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" id="email" disabled><div id="emailError" class="error" style="color:red;"></div></td>
                        </tr>

                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" id="password" disabled><div id="passwordError" class="error" style="color:red;"></div></td>
                        </tr>

                        <tr>
                            <td>Mobile</td>
                            <td><input type="text" name="mobile" id="mobile" disabled><div id="mobileError" class="error" style="color:red;"></div></td>
                        </tr>

                        <tr>
                            <td>Speciality</td>
                            <td>
                                <select name="speciality" id="speciality">
                                    <option value="">Select</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                    <option value="Gynecology">Gynecology</option>
                                    <option value="Dermatology">Dermatology</option>
                                </select>
                            </td>
                            <td><div id="specialityError" class="error" style="color:red;"></div></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div class="btn-group">
                                    <button type="button" onclick="addDoctor()">Add</button>
                                    <button type="button" onclick="editDoctor()">Edit</button>
                                    <button type="button" onclick="deleteDoctor()">Delete</button>
                                    <button type="button" onclick="saveDoctor()" id="saveBtn" disabled>Save</button>
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

