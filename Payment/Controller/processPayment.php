<?php
session_start();
require_once '../../DB/dbUser.php';

if (!isset($_SESSION['user']) || !isset($_SESSION['user']['email'])) {
    header("Location: ../../Login/View/login.php");
    exit();
}

$con = connection();
$email = $_SESSION['user']['email'];
$method = $_POST['method'] ?? '';
$datetime = date("Y-m-d H:i:s");


if (empty($method)) {
    echo "<script>alert('Payment method required!');history.back();</script>";
    exit();
}

if ($method === "card") {

    $card = trim($_POST['card_number'] ?? '');

    if (empty($card) || !is_numeric($card) || strlen($card) < 12) {
        echo "<script>alert('Invalid card number!');history.back();</script>";
        exit();
    }

    $info = "Card: " . $card;

} 
elseif ($method === "mobile") {

    $mobile = trim($_POST['mobile_number'] ?? '');

    if (empty($mobile) || !is_numeric($mobile) || strlen($mobile) < 11) {
        echo "<script>alert('Invalid mobile number!');history.back();</script>";
        exit();
    }

    $info = "Mobile: " . $mobile;

} 
else {
    echo "<script>alert('Invalid payment method!');history.back();</script>";
    exit();
}


$query = "
    update appointmentsandbill
    set 
        status='completed',
        paymentMethod='$method',
        card_mobile_data='$info',
        datetime='$datetime'
    where patientEmail='$email'
    and status='confirmed'";

mysqli_query($con, $query);

unset($_SESSION['totalBill']);

echo "<script>
alert('Payment Successful!');
window.location.href='../View/paymentHistory.php';
</script>";
