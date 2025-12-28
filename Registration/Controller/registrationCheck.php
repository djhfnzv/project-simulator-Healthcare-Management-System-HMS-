<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $gender = $_POST['gender'] ?? '';
    $bloodGroup = $_POST['bloodGroup'] ?? '';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $phone = $_POST['phone'];

    $errors = [];

    if ($name == "") $errors[] = "Name is required";
    if ($dob == "") $errors[] = "Date of Birth is required";
    if ($age == "" || !is_numeric($age) || $age <= 0) $errors[] = "Invalid age";
    if ($gender == "") $errors[] = "Gender is required";
    if ($bloodGroup == "") $errors[] = "Blood Group is required";
    if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email";
    if ($password == "") $errors[] = "Password is required";
    if ($password != $confirmPassword) $errors[] = "Passwords do not match";
    if ($phone == "" || !is_numeric($phone)) $errors[] = "Invalid phone number";

    // ❌ Validation failed
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../View/registration.php");
        exit();
    }

    // ✅ Validation success
    $_SESSION['user'] = [
        'name' => $name,
        'dob' => $dob,
        'age' => $age,
        'gender' => $gender,
        'bloodGroup' => $bloodGroup,
        'email' => $email,
        'password' => $password, // later: password_hash()
        'phone' => $phone
    ];

    header("Location: ../../Login/View/login.php");
    exit();

} else {
    header("Location: ../View/registration.php");
    exit();
}
?>
