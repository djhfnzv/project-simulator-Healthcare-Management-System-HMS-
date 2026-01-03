<?php
    session_start();
    require_once '../../DB/dbUser.php';

    if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
        header("Location: ../../Login/View/login.php");
        exit();
    }

    $con = connection();
    $email = $_SESSION['user']['email'];

    $errors = [];

    $name       = $_POST['name'];
    $age        = $_POST['age'];
    $mobile     = $_POST['mobile'];
    $speciality = $_POST['speciality'];
    $password   = $_POST['password'];
    $confirm    = $_POST['confirmPassword'];

    if ($name == "") {
        $errors[] = "Name required";
    }

    if ($age != "" && !is_numeric($age)) {
        $errors[] = "Age must be numeric";
    }

    if ($mobile != "" && strlen($mobile) < 11) {
        $errors[] = "Invalid mobile number";
    }

    if ($password != "") {
        if ($password !== $confirm) {
            $errors[] = "Password doesn't match";
        }
    }

    if ($_FILES['myfile']['name'] != "") {
        $ext = explode('.', $_FILES['myfile']['name']);
        $index = count($ext) - 1;

        if (
            $ext[$index] != 'jpg' &&
            $ext[$index] != 'jpeg' &&
            $ext[$index] != 'png'
        ) {
            $errors[] = "Invalid image format";
        }
    }

    if (count($errors) > 0) {
        $_SESSION['profileError'] = $errors;
        header("Location: ../View/profileEdit.php");
        exit();
    }

    if ($password != "") {
        $query = "update users set password = '$password' where email = '$email'";
        mysqli_query($con, $query);
    }

    if ($_FILES['myfile']['name'] != "") {
        $src = $_FILES['myfile']['tmp_name'];
        $imageName = time() . "." . $ext[$index];
        $destination = "../Model/" . $imageName;

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
        $_SESSION['profileSuccess'] = "Profile Updated";
    } else {
        $_SESSION['profileError'] = ["Failed to update profile"];
    }

    header("Location: ../../Profile/View/profile.php");
    exit();
?>