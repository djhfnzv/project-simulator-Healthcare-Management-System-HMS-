<?php
    session_start();
    require_once '../../DB/dbUser.php';

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: ../View/login.php");
        exit();
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === "" || $password === "") {
        echo "null submission!";
        exit();
    }

    $con = connection();

    $query = "select * from users where email='$email' and password='$password'";
    $result = mysqli_query($con,$query);

    if (mysqli_num_rows($result) !== 1) {
        echo "invalid user!";
        exit();
    }

    $user = mysqli_fetch_assoc($result);

    $_SESSION['user'] = [
        'name'       => $user['name'],
        'role'       => $user['role'],
        'email'      => $user['email'],
        'dob'        => $user['dob'],
        'age'        => $user['age'],
        'gender'     => $user['gender'],
        'blood'      => $user['bloodgroup'],
        'phone'      => $user['mobile'],
        'speciality' => $user['speciality'],
        'image'      => $user['image']
    ];

    $_SESSION['role']= $user['role'];
    $_SESSION['username']= $user['email'];
    $_SESSION['name']= $user['name'];

    $query = "insert into userActivity (user_name, user_email, user_role)
                                VALUES ('{$user['name']}', '$email', '{$user['role']}')";
    mysqli_query($con,$query);

    setcookie('status', 'true', time() + 3000, '/');
    setcookie('user_role', $_SESSION['role'], time() + 3000, '/');
    setcookie('user_name', $_SESSION['name'], time() + 3000, '/');

    header("Location: ../../Role_Based_Access_Control/Controller/homeRedirect.php");
    exit();

?>
