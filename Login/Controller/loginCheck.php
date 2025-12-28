<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: ../View/login.php");
        exit();
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    /*dummy data*/

    $dummyUsers = [

        "admin@hospital.com" => [
            "role" => "Admin",
            "password" => "admin123",
            "name" => "System Admin",
            "age" => 40,
            "dob" => "1985-01-01",
            "mobile" => "01711111111"
        ],

        "doctor2@hospital.com" => [
            "role" => "Doctor",
            "password" => "doctor234",
            "name" => "Dr. Karim",
            "age" => 50,
            "dob" => "1975-09-12",
            "mobile" => "01766666666",
            "speciality" => "Neurology"
        ],

        "doctor3@hospital.com" => [
            "role" => "Doctor",
            "password" => "doctor345",
            "name" => "Dr. Sultana",
            "age" => 38,
            "dob" => "1987-04-22",
            "mobile" => "01777777777",
            "speciality" => "Gynecology"
        ],

        "doctor4@hospital.com" => [
            "role" => "Doctor",
            "password" => "doctor456",
            "name" => "Dr. Hossain",
            "age" => 42,
            "dob" => "1983-12-05",
            "mobile" => "01788888888",
            "speciality" => "Orthopedics"
        ],

        "doctor5@hospital.com" => [
            "role" => "Doctor",
            "password" => "doctor567",
            "name" => "Dr. Mahmud",
            "age" => 35,
            "dob" => "1990-06-18",
            "mobile" => "01799999999",
            "speciality" => "Dermatology"
        ],

        "doctor6@hospital.com" => [
            "role" => "Doctor",
            "password" => "doctor678",
            "name" => "Dr. Farzana",
            "age" => 40,
            "dob" => "1985-10-30",
            "mobile" => "01611111111",
            "speciality" => "Pediatrics"
        ],

        "nurse2@hospital.com" => [
            "role" => "Nurse",
            "password" => "nurse234",
            "name" => "Nurse Salma",
            "age" => 32,
            "dob" => "1993-07-14",
            "mobile" => "01622222222"
        ],

        "nurse3@hospital.com" => [
            "role" => "Nurse",
            "password" => "nurse345",
            "name" => "Nurse Rima",
            "age" => 29,
            "dob" => "1996-02-09",
            "mobile" => "01633333333"
        ],

        "nurse4@hospital.com" => [
            "role" => "Nurse",
            "password" => "nurse456",
            "name" => "Nurse Nabila",
            "age" => 34,
            "dob" => "1991-08-27",
            "mobile" => "01644444444"
        ],

        "nurse5@hospital.com" => [
            "role" => "Nurse",
            "password" => "nurse567",
            "name" => "Nurse Farah",
            "age" => 27,
            "dob" => "1998-01-19",
            "mobile" => "01655555555"
        ],

        "nurse6@hospital.com" => [
            "role" => "Nurse",
            "password" => "nurse678",
            "name" => "Nurse Jannat",
            "age" => 31,
            "dob" => "1994-11-03",
            "mobile" => "01666666666"
        ],

        "patient2@hospital.com" => [
            "role" => "Patient",
            "password" => "patient234",
            "name" => "Rahim Uddin",
            "age" => 55,
            "dob" => "1970-05-08",
            "mobile" => "01677777777"
        ],

        "patient3@hospital.com" => [
            "role" => "Patient",
            "password" => "patient345",
            "name" => "Karima Begum",
            "age" => 48,
            "dob" => "1977-09-16",
            "mobile" => "01688888888"
        ],

        "patient4@hospital.com" => [
            "role" => "Patient",
            "password" => "patient456",
            "name" => "Imran Hossain",
            "age" => 26,
            "dob" => "1999-12-25",
            "mobile" => "01699999999"
        ],

        "patient5@hospital.com" => [
            "role" => "Patient",
            "password" => "patient567",
            "name" => "Nusrat Jahan",
            "age" => 34,
            "dob" => "1991-03-11",
            "mobile" => "01511111111"
        ],

        "patient6@hospital.com" => [
            "role" => "Patient",
            "password" => "patient678",
            "name" => "Sajid Khan",
            "age" => 41,
            "dob" => "1984-07-29",
            "mobile" => "01522222222"
        ],

        "doctor@hospital.com" => [
            "role" => "Doctor",
            "password" => "doctor123",
            "name" => "Dr. Rahman",
            "age" => 45,
            "dob" => "1980-05-10",
            "mobile" => "01722222222",
            "speciality" => "Cardiology"
        ],

        "nurse@hospital.com" => [
            "role" => "Nurse",
            "password" => "nurse123",
            "name" => "Nurse Ayesha",
            "age" => 30,
            "dob" => "1995-03-15",
            "mobile" => "01733333333"
        ],

        "patient@hospital.com" => [
            "role" => "Patient",
            "password" => "patient123",
            "name" => "Asif Akber",
            "age" => 22,
            "dob" => "2003-08-20",
            "mobile" => "01744444444"
        ],

        "reception@hospital.com" => [
            "role" => "Receptionist",
            "password" => "recept123",
            "name" => "Reception Tania",
            "age" => 28,
            "dob" => "1997-11-02",
            "mobile" => "01755555555"
        ]
    ];

    

    $_SESSION['dummyUsers'] = $dummyUsers;

    /*for dummy*/

    if (isset($dummyUsers[$email]) && $dummyUsers[$email]['password'] === $password) {

        $_SESSION['user'] = $dummyUsers[$email];
        $_SESSION['user']['email'] = $email;
        $_SESSION['loggedin'] = true;

        switch ($_SESSION['user']['role']) {
            case "Admin":
                header("Location: ../../Admin/View/adminDashboard.php");
                break;
            case "Doctor":
                header("Location: ../../Doctor/View/doctorDashboard.php");
                break;
            case "Nurse":
                header("Location: ../../Nurse/View/nurseDashboard.php");
                break;
            case "Patient":
                header("Location: ../../Patient/View/patientDashboard.php");
                break;
            case "Receptionist":
                header("Location: ../../Receptionist/View/receptionDashboard.php");
                break;
        }
        exit();
    }

    /*registered*/

    if (isset($_SESSION['user'])) {

        $storedEmail = $_SESSION['user']['email'];
        $storedPassword = $_SESSION['user']['password'];

        if ($email === $storedEmail && $password === $storedPassword) {
            $_SESSION['loggedin'] = true;
            header("Location: ../../Dashboard/View/home.php");
            exit();
        }
    }

    /* invalid */

    $_SESSION['errors'] = ["Invalid email or password"];
    header("Location: ../View/login.php");
    exit();
?>
