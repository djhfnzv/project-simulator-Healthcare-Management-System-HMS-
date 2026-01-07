<?php
session_start();
require_once '../../DB/dbUser.php';

header('Content-Type: application/json');

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

$errors = [];

if ($action === 'add' || $action === 'update') {
    $name = trim($_POST['name'] ?? '');
    $age = $_POST['age'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $email_key = trim($_POST['email_key'] ?? '');
    $password = $_POST['password'] ?? '';
    $mobile = trim($_POST['mobile'] ?? '');
    $speciality = trim($_POST['speciality'] ?? '');

    //validation

    if ($action === 'add') {

        if ($name === '' || $email === '' || $password === '') {
            $errors['general'] = "Required fields missing";
        }

        if (!isValidEmailManual($email)) {
            $errors['email'] = "Invalid email";
        }

    } else {

        if ($name === '' || $email_key === '') {
            $errors['general'] = "Required fields missing";
        }

        if (!isValidEmailManual($email_key)) {
            $errors['email'] = "Invalid email";
        }
    }

    if ($age !== '' && !is_numeric($age)) $errors['age'] = "Age must be numeric";
    if ($mobile !== '' && strlen($mobile) < 11) $errors['mobile'] = "Invalid mobile";
    if ($password !== '' && strlen($password) < 6) $errors['password'] = "Password too short";

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit();
    }

    if ($action === 'add') {

        $query = "insert into users (name, age, dob, email, password, mobile, speciality, role)
                            values ('$name', '$age', '$dob', '$email', '$password', '$mobile', '$speciality', 'Doctor')";

    } else {
        $setPassword = $password !== '' ? ", password='$password'" : '';
        $query = "UPDATE users SET name='$name', age='$age', dob='$dob', mobile='$mobile', speciality='$speciality' $setPassword
                  WHERE email='$email_key' AND role='Doctor'";
    }

} elseif ($action === 'delete') {

    $email_key = trim($_POST['email_key'] ?? '');

    if ($email_key === '') {
        echo json_encode(['success' => false, 'error' => 'No doctor selected']);
        exit();
    }
    $query = "DELETE FROM users WHERE email='$email_key' AND role='Doctor'";
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid action']);
    exit();
}

if (mysqli_query($con, $query)) {
    echo json_encode(['success' => true, 'message' => ucfirst($action) . ' successful']);
} else {
    echo json_encode(['success' => false, 'error' => 'Database error']);
}
exit();
?>
