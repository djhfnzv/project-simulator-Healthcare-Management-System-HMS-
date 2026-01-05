<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../Asset/cssLogin.css">
    </head>
    <script src="../Asset/sccriptLogin.js"></script>
        <fieldset>
            <h1>Login</h1>
    </head>
    <script src="../Asset/login.js"></script>
        <fieldset>
            <legend><b>User Registration</b></legend>
                <form action="../Controller/loginCheck.php" method="post" onsubmit="return validateLogin()">
                    <table>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" id="email" name ="email" required><div id="emailError" style="color:red;"></div></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" id="password" name ="password" required><div id="passwordError" style="color:red;"></div></td>
                        </tr>
                    </table>
                    <input type="submit" value="Login"><div id="successMessage" style="color:green;"></div>
                </form>
                <form action="../../Registration/View/registration.php">
                    <input type="submit" value="Register">
                </form>
        </fieldset>
    </body>
</html>