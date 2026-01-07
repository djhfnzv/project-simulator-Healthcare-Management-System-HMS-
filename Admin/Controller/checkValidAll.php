<?php

session_start();
require_once '../../DB/dbUser.php';

header('Content-Type: application/json');


    $con = connection();
    if (!$con) {
        throw new Exception('Database connection failed: ' . mysqli_connect_error());
    }

    $action = $_POST['action'] ?? '';
    $role   = $_POST['role'] ?? '';
    if (!in_array($role, ['Nurse', 'Receptionist', 'Patient'])) {
        echo json_encode(['success' => false, 'error' => 'Invalid role']);
        exit();
    }

    function isValidEmailManual($email)
    {
        if (substr_count($email, '@') !== 1) return false;

        list($local, $domain) = explode('@', $email);

        if ($local === '' || $domain === '') return false;
        if (strpos($domain, '.') === false) return false;
        if ($domain[0] === '.' || substr($domain, -1) === '.') return false;

        $lastChar = substr($domain, -1);
        if (!ctype_alpha($lastChar)) return false;

        return true;
    }

    if ($action === 'add' || $action === 'update') {

        $name       = trim($_POST['name'] ?? '');
        $age        = $_POST['age'] ?? '';
        $dob        = $_POST['dob'] ?? '';
        $email      = trim($_POST['email'] ?? '');
        $email_key  = trim($_POST['email_key'] ?? '');
        $password   = $_POST['password'] ?? '';
        $mobile     = trim($_POST['mobile'] ?? '');

        //validation

        if ($action === 'add') {

            if ($name === '' || $email === '' || $password === '') {
                echo json_encode(['success' => false, 'error' => 'Required fields missing']);
                exit();
            }

            if (!isValidEmailManual($email)) {
                echo json_encode(['success' => false, 'error' => 'Invalid email']);
                exit();
            }

        } else { 
            if ($name === '' || $email_key === '') {
                echo json_encode(['success' => false, 'error' => 'Required fields missing']);
                exit();
            }

            if (!isValidEmailManual($email_key)) {
                echo json_encode(['success' => false, 'error' => 'Invalid email']);
                exit();
            }
        }

        //query

        if ($action === 'add') {

            $query = "insert into users (name, age, dob, email, password, mobile, role)
                                values ('$name', '$age', '$dob', '$email', '$password', '$mobile', '$role')";

        } else {

            if ($password !== '') {
                $query = "update users set
                            name='$name',
                            age='$age',
                            dob='$dob',
                            password='$password',
                            mobile='$mobile'
                          where email='$email_key' and role='$role'";
            } else {
                $query = "update users set
                            name='$name',
                            age='$age',
                            dob='$dob',
                            mobile='$mobile'
                          where email='$email_key' and role ='$role'";
            }
        }

    } elseif ($action === 'delete') {

        $email_key = trim($_POST['email_key'] ?? '');

        if ($email_key === '') {
            echo json_encode(['success' => false, 'error' => 'No ' . $role . ' selected']);
            exit();
        }

        $query = "delete from users where email='$email_key' and role='$role'";

    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request']);
        exit();
    }

    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => true, 'message' => ucfirst($action) . ' successful']);
        exit();
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }
?>
