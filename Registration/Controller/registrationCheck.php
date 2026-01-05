<?php
session_start();
require_once '../../DB/dbUser.php';

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

    function isValidEmailManual($email)
    {
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
        $_SESSION['errors'] = $errors;
        header("Location: ../View/registration.php");
        exit();
    }

    $role = 'Patient';
    $speciality = '';
    $image = '';

    $con = connection();
    $query = "insert into users(name,age,dob,gender,bloodgroup,email,password,mobile,role,speciality,image)
                        values ('$name','$age','$dob','$gender','$bloodGroup','$email','$password','$phone','$role','$speciality','$image')";

    $result = mysqli_query($con,$query);

    if(!$result){
        echo "Registration Failed";
    }

    header("Location: ../../Login/View/login.php");
    exit();

} else {
    header("Location: ../View/registration.php");
    exit();
}
?>
