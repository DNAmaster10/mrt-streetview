<?php
    if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
        header ("location: /pages/session_expired.php");
        die();
    }
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s",$_SESSION["username"]);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();
    if ($result) {
        if ($result == $_SESSION["password"]) {
            $logged_in = true;
        }
        else {
            unset($_SESSION["username"]);
            unset($_SESSION["password"]);
            header ("location: /pages/invalid_login.php");
            $logged_in = false;
            die();
        }
    }
    else {
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
        header ("location: /pages/invalid_login.php");
        $logged_in = false;
        die();
    }
?>
