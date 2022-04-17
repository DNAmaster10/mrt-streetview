<?php
    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    if (!isset($_POST["username"])) {
        $_SESSION["login_error_message"] = "Please enter a username";
        header ("location: /pages/login/login.php");
        die();
    }
    else if (!isset($_POST["password"])) {
        $_SESSION["login_error_message"] = "Please enter a password";
        header ("location: /pages/login/login.php");
        die();
    }
    $username = $conn->real_escape_string($_POST["username"]);
    error_log($username);
    $password = $conn->real_escape_string($_POST["password"]);
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($raw_result);
    if ($raw_result->num_rows > 0) {
        $row = $raw_result->fetch_assoc();
		$result = $row["password"];
		unset($row);
		unset($raw_result);
    }
    else {
        $_SESSION["login_error_message"] = "Account not found.".$result;
        header ("location: /pages/login/login.php");
        die();
    }
    if ($result == $password) {
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        header ("location: /pages/user/home.php");
        die();
    }
    else {
        $_SESSION["login_error_message"] = "Invalid password.";
        header ("location: /pages/login/login.php");
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <p>If you are seeing this, a serious error has occured</p>
    </body>
</html>
