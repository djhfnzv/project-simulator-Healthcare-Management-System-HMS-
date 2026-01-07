<?php
    session_start();
    require_once '../../DB/dbUser.php';

    header('Content-Type: application/json');

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        exit();
    }

    $data = $_POST['user'] ?? '';
    if ($data === '') {
        echo json_encode(['success' => false, 'error' => 'No data received']);
        exit();
    }

    $userInput = json_decode($data, true);
    $email = $userInput['email'] ?? '';
    $password = $userInput['password'] ?? '';

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

    if ($email === "" || !isValidEmailManual($email)) {
        echo json_encode(['success' => false, 'error' => 'Invalid email format']);
        exit();
    }
    if ($password === "") {
        echo json_encode(['success' => false, 'error' => 'Password is required']);
        exit();
    }

    $con = connection();

    $query = "select * from users where email='$email' and password='$password'";
    $result = mysqli_query($con,$query);

    if (mysqli_num_rows($result) !== 1) {
        echo json_encode(['success' => false, 'error' => 'Invalid email or password']);
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

    $_SESSION['role'] = $user['role'];
    $_SESSION['username'] = $user['email'];
    $_SESSION['name'] = $user['name'];

    $query = "insert into userActivity (user_name, user_email, user_role)
                                VALUES ('{$user['name']}', '$email', '{$user['role']}')";
    mysqli_query($con,$query);

    setcookie('status', 'true', time() + 3000, '/');
    setcookie('user_role', $_SESSION['role'], time() + 3000, '/');
    setcookie('user_name', $_SESSION['name'], time() + 3000, '/');

    echo json_encode(['success' => true, 'message' => 'Login successful']);
    exit();
<<<<<<< HEAD


=======
>>>>>>> 4a0673b (Update : ajax-json implemented)
?>
