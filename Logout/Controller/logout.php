<?php

    session_start();
    require_once '../../DB/dbUser.php';

    $con = connection();

    /* Update logout time BEFORE destroying session */
    if (isset($_SESSION['user'])) {

        $email = $_SESSION['user']['email'];

        $query = "update userActivity 
                set logout_time = NOW()
                where user_email = '$email'
                    and logout_time IS NULL
                order by login_time DESC
                limit 1";

        mysqli_query($con, $query);
    }

    /* Destroy all session data */
    $_SESSION = [];
    session_destroy();

    // Clear all cookies
    setcookie('status', '', time() - 3600, '/');
    setcookie('user_role', '', time() - 3600, '/');
    setcookie('user_name', '', time() - 3600, '/');


    header("Location: ../../Login/View/login.php");
    exit();
?>
