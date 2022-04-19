<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    include $_SERVER["DOCUMENT_ROOT"]."/includes/check_login.php";
    if (!isset($_POST["location_name"])) {
        $_SESSION["create_location_error_message"] = "Please enter a location name.";
        header ("location: /pages/user/create_location.php");
        die();
    }
    unset($result);
    $location_name = $conn->real_escape_string($_POST["location_name"]);
    $stmp = $conn->prepare("SELECT location FROM locations WHERE location=?");
    $stmt->bind_param("s", $location_name);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    error_log("Is found: " + $result);
    $stmt->close();
    if ($result == $location_name) {
        $_SESSION["create_location_error_message"] = "That location already exists! Try editing the already existing location rather than creating a new one.";
        header ("location: /pages/user/create_location.php");
        die();
    }
    else {
        $stmt = $conn->prepare("INSERT INTO locations (location) VALUES (?)");
        $stmt->bind_param("s", $location_name);
        $stmt->execute();
        $stmt->close();
        $stmt = $conn->prepare("SELECT id FROM locations WHERE location=?;");
        $stmt->bind_param("s", $location_name);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        error_log($result);
        $stmt->close();
        if ($result) {
            mkdir($_SERVER["DOCUMENT_ROOT"]."/assets/images/".$result);
        }
    }
?>
