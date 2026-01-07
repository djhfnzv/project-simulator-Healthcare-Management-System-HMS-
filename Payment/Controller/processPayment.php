<?php
session_start();
require_once '../../DB/dbUser.php';

$con = connection();
$email = $_SESSION['user']['email'];
$method = $_POST['method'];
$datetime = date("Y-m-d H:i:s");

/*store payment info */
if ($method === "card") 
    {
        $info = "Card: " . $_POST['card_number'];
    } 
    else
        {
            $info = "Mobile: " . $_POST['mobile_number'];
        }

/*Mark confirmed appointments as Paid*/
$query = "
    update appointmentsandbill
    set 
        status='completed',
        paymentMethod='$method',
        card_mobile_data='$info',
        datetime='$datetime'
    where patientEmail='$email' and status='confirmed'
";

mysqli_query($con, $query);

unset($_SESSION['totalBill']);

echo "<script>
alert('Payment Successful!');
window.location.href='../View/paymentHistory.php';
</script>";
