<?php

    session_start();
    require_once '../../DB/dbUser.php';

    header('Content-Type: application/json'); 

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(['success' => false, 'errors' => ['general' => 'Invalid request method']]);
        exit();
    }

    $data = $_POST['user'] ?? '';
    if ($data === '') {
        echo json_encode(['success' => false, 'errors' => ['general' => 'No data received']]);
        exit();
    }

    $userInput = json_decode($data, true);
    $name = $userInput['name'] ?? '';
    $dob = $userInput['dob'] ?? '';
    $age = $userInput['age'] ?? '';
    $gender = $userInput['gender'] ?? '';
    $bloodGroup = $userInput['bloodGroup'] ?? '';
    $email = $userInput['email'] ?? '';
    $password = $userInput['password'] ?? '';
    $confirmPassword = $userInput['confirmPassword'] ?? '';
    $phone = $userInput['phone'] ?? '';

    $errors = [];

    function isValidEmailManual($email) {
        if (substr_count($email, '@') !== 1) {
            return false;
        }
        list($local, $domain) = explode('@', $email);
        if ($local === '' || $domain === '') {
            return false;
        }
        if (strpos($domain, '.') === false) {
            return false;
        }
        if ($domain[0] === '.' || substr($domain, -1) === '.') {
            return false;
        }
        $lastChar = substr($domain, -1);
        if (!ctype_alpha($lastChar)) {
            return false;
        }
        return true;
    }


    if ($name == "") $errors[] = "Name is required";
    if ($dob == "") $errors[] = "Date of Birth is required";
    if ($age == "" || !is_numeric($age) || $age <= 0) $errors[] = "Invalid age";
    if ($gender == "") $errors[] = "Gender is required";
    if ($bloodGroup == "") $errors[] = "Blood Group is required";
    if ($email === "" || !isValidEmailManual($email)) {$errors[] = "Invalid email format";}
    if ($password == "") $errors[] = "Password is required";
    if ($password != $confirmPassword) $errors[] = "Passwords do not match";
    if ($phone == "" || !is_numeric($phone)) $errors[] = "Invalid phone number";


    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit();
    }

        $role = 'Patient';
        $speciality = '';
        $image = '';

        $con = connection();
        $query = "insert into users(name,age,dob,gender,bloodgroup,email,password,mobile,role,speciality,image)
                            values ('$name','$age','$dob','$gender','$bloodGroup','$email','$password','$phone','$role','$speciality','$image')";

        $result = mysqli_query($con,$query);

    if (!$result) {
        echo json_encode(['success' => false, 'errors' => ['general' => 'Registration failed']]);
        exit();
    }

    echo json_encode(['success' => true, 'message' => 'Registration successful']);
    exit();
?>
