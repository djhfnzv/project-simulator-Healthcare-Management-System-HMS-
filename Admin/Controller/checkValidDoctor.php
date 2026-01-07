<?php
session_start();
require_once '../../DB/dbUser.php';

$con = connection();

$action = $_POST['action'] ?? '';

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
    $speciality = trim($_POST['speciality'] ?? '');

    //validation

    if ($action === 'add') {

        if ($name === '' || $email === '' || $password === '') {
            echo "Required fields missing";
            exit();
        }

        if (!isValidEmailManual($email)) {
            echo "Invalid email";
            exit();
        }

    } else {

        if ($name === '' || $email_key === '') {
            echo "Required fields missing";
            exit();
        }

        if (!isValidEmailManual($email_key)) {
            echo "Invalid email";
            exit();
        }
    }

    //query

    if ($action === 'add') {

        $query = "insert into users (name, age, dob, email, password, mobile, speciality, role)
                            values ('$name', '$age', '$dob', '$email', '$password', '$mobile', '$speciality', 'Doctor')";

    } else {

        if ($password !== '') {
            $query = "update users set
                        name='$name',
                        age='$age',
                        dob='$dob',
                        password='$password',
                        mobile='$mobile',
                        speciality='$speciality'
                      where email='$email_key' and role='Doctor'";
        } else {
            $query = "update users set
                        name='$name',
                        age='$age',
                        dob='$dob',
                        mobile='$mobile',
                        speciality='$speciality'
                      WHERE email='$email_key' and role ='Doctor'";
        }
    }

} elseif ($action === 'delete') {

    $email_key = trim($_POST['email_key'] ?? '');

    if ($email_key === '') {
        echo "No doctor selected";
        exit();
    }

    $query = "delete from users where email='$email_key' and role='Doctor'";

} else {
    echo "Invalid request";
    exit();
}

if (mysqli_query($con, $query)) {
    header("Location: ../View/doctorList.php");
    exit();
} else {
    echo "Database error";
}
