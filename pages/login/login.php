<?php
    session_start();
    if (isset($_SESSION["login_error_message"])) {
        $error_message = $_SESSION["login_error_message"];
        unset($_SESSION["login_error_message"]);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="./login_submit.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
        <p><?php if (isset($error_message)){echo $error_message;}?>
    </body>
</html>
