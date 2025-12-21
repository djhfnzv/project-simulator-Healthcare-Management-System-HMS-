<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $phone = $_POST['phone'];

    $errors = [];

    if ($fullname == "") {
        $errors[] = "Full name is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if ($password != $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    if (!ctype_digit($phone)) {
        $errors[] = "Phone number must contain only digits";
    }

    // If errors exist → alert & go back
    if (count($errors) > 0) {

        echo "<script>";
        foreach ($errors as $error) {
            echo "alert('$error');";
        }
        echo "window.location.href='signUp.html';";
        echo "</script>";

    } else {

        $userData = array(
            "Full Name" => $fullname,
            "Email" => $email,
            "Phone" => $phone
        );

        $_SESSION['username'] = $fullname;
        $_SESSION['userData'] = $userData;

        echo "<script>
                alert('Registration Successful!');
                window.location.href='home.php';
              </script>";
    }
}
?>
