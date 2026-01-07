<?php
session_start();
if (!isset($_SESSION['totalBill'])) {
    header("Location: paymentHistory.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="../Asset/stylePayment.css">
    <script src="../Asset/validatePayment.js"></script>
    <script>
        function showForm(type) {
            document.getElementById("cardForm").style.display = "none";
            document.getElementById("mobileForm").style.display = "none";
            document.getElementById(type).style.display = "block";
        }
    </script>
</head>
<body>

<h2>Choose Payment Method</h2>

<input type="radio" name="pay" onclick="showForm('cardForm')"> Card  
<input type="radio" name="pay" onclick="showForm('mobileForm')"> bKash/Nagad/Rocket  


<div id="cardForm" style="display:none;">
    <form id="cardFormElement" action="../Controller/processPayment.php" method="post">
        <table>
            <tr>
                <td>Card Number:</td>
                <td><input type="text" name="card_number" id="card_number"></td>
            </tr>
            <tr>
                <td>Name on Card:</td>
                <td><input type="text" name="card_name" id="card_name"></td>
            </tr>
            <tr>
                <td>Expiry Date:</td>
                <td><input type="month" name="card_expiry" id="card_expiry"></td>
            </tr>
            <tr>
                <td>CVV:</td>
                <td><input type="password" name="card_cvv" id="card_cvv"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input type="hidden" name="method" value="card">
                    <button type="submit" class="btn btn-pay">Proceed</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="mobileForm" style="display:none;">
    <form id="mobileFormElement" action="../Controller/processPayment.php" method="post">
        <table>
            <tr>
                <td>Mobile Number:</td>
                <td><input type="text" name="mobile_number" id="mobile_number"></td>
            </tr>
            <tr>
                <td>Amount:</td>
                <td><?= $_SESSION['totalBill'] ?> BDT</td>
            </tr>
            <tr>
                <td>PIN:</td>
                <td><input type="password" name="mobile_pin" id="mobile_pin"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input type="hidden" name="method" value="mobile">
                    <button type="submit" class="btn btn-pay">Proceed</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
