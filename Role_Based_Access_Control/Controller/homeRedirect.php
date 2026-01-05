<?php
    session_start();

    if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
        header("Location: ../Login/View/login.php");
        exit();
    }

    if (!isset($_SESSION['role'])) {
        echo "Role not found!";
        exit();
    }

    switch ($_SESSION['role']) {

        case 'Admin':
            header("Location: ../../Admin/View/adminDashboard.php");
            break;

        case 'Doctor':
            header("Location: ../../Doctor/View/doctorDashboard.php");
            break;

        case 'Patient':
            header("Location: ../../Patient/View/patientDashboard.php");
            break;

        case 'Nurse':
            header("Location: ../../Nurse/View/nurseDashboard.php");
            break;

        case 'Receptionist':
            header("Location: ../../Receptionist/View/receptionistDashboard.php");
            break;

        default:
            echo "Unauthorized role!";
            break;
    }

    exit();
?>
