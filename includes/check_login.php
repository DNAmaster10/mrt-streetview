<?php
    if (!isset($_SESSION["username"] || !isset($_SESSION["password"])) {
        header ("location: /pages/session_expired.php");
        die();
    }
    $stmt = $conn->prepare("SELECT password FROM users WHERE username='?'");
    $stmt = $conn->bind_param("s",$_SESSION["username"]);
    $raw_result = $stmt->execute();
    if ($raw_result->num_rows > 0) {
        $row = $raw_result->fetch_assoc();
        $result = $row["password"];
        unset($raw_result);
        unset($row);
        $logged_in = true;
    }
    else {
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
        header ("location: /pages/invalid_login.php");
        $logged_in = false;
        die();
    }
?>
