<?php
    session_start();
    require_once '../../DB/dbUser.php';

    header('Content-Type: application/json');

    if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
        echo json_encode(['success' => false, 'errors' => ['general' => 'Not logged in']]);
        exit();
    }

    $con = connection();
    $email = $_SESSION['user']['email'];

    $errors = [];

    $name       = $_POST['name'] ?? '';
    $age        = $_POST['age'] ?? '';
    $mobile     = $_POST['mobile'] ?? '';
    $speciality = $_POST['speciality'] ?? '';
    $password   = $_POST['password'] ?? '';
    $confirm    = $_POST['confirmPassword'] ?? '';

    if ($name == "") {
        $errors['name'] = "Name required";
    }

    if ($age != "" && !is_numeric($age)) {
        $errors['age'] = "Age must be numeric";
    }

    if ($mobile != "" && strlen($mobile) < 11) {
        $errors['mobile'] = "Invalid mobile number";
    }

    if ($password != "") {
        if ($password !== $confirm) {
            $errors['password'] = "Password doesn't match";
        }
    }

    if (isset($_FILES['myfile']) && $_FILES['myfile']['name'] != "") {
        $ext = explode('.', $_FILES['myfile']['name']);
        $index = count($ext) - 1;
        if ($ext[$index] != 'jpg' && $ext[$index] != 'jpeg' && $ext[$index] != 'png') {
            $errors['image'] = "Invalid image format";
        }
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit();
    }

    if ($password != "") {
        $query = "update users set password = '$password' where email = '$email'";
        mysqli_query($con, $query);
    }

    if ($_FILES['myfile']['name'] != "") {
        $src = $_FILES['myfile']['tmp_name'];
        $imageName = time() . "." . $ext[$index];
        $destination = "../../Profile/Model/" . $imageName;

        if (move_uploaded_file($src, $destination)) {
            $query = "update users set image = '$destination' where email = '$email'";
            mysqli_query($con, $query);
        }
    }

    $query = "update users set
                name = '$name',
                age = '$age',
                mobile = '$mobile',
                speciality = '$speciality'
            where email = '$email'";

    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => true, 'message' => 'Profile Updated']);
    } else {
        echo json_encode(['success' => false, 'errors' => ['general' => 'Failed to update profile']]);
    }
    exit();
?>