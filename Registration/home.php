<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: signUp.html");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<h2>Hello ! <?php echo $_SESSION['username']; ?></h2>

<h3>Stored User Data:</h3>
<p>
    <?php print_r($_SESSION['userData']); ?>
</p>

<form action="logout.php" method="post">
    <input type="submit" value="Logout">
</form>

</body>
</html>
