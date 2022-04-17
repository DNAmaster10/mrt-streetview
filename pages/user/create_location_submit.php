<?php
    session_start();
    include $_SERVER."/includes/dbh.php";
    include $_SERVER."/includes/check_login.php";
    if (!isset($_POST["location_name"])) {
        $_SESSION["create_location_error_message"] = "Please enter a location name.";
        header ("location: /pages/user/create_location.php");
        die();
    }
    $location_name = $conn->real_escape_string($_POST["location_name"]);
    $stmp = $conn->prepare("SELECT location FROM locations WHERE location='?';");
    $stmp = $conn->bind_param("s",$location_name);
    $raw_result = $stmp->execute();
    if ($raw_result->num_rows > 0) {
        $_SESSION["create_location_error_message"] = "That location already exists! Try editing the already existing location rather than creating a new one.";
        header ("location: /pages/user/create_location.php");
        die()
    }
    else {
        $stmp = $conn->prepare("INSERT INTO locations (location) VALUES (?);");
        $stmp = $conn->bind_param("s",$location_name);
        $stmp->execute();

        $stmp = $conn->prepare("SELECT id FROM locations WHERE location='?';");
        $stmp = $conn->bind_param("s", $location_name);
        $raw_result = $stmp->execute();
        if ($raw_result->num_rows > 0) {
            $row = $raw_result->fetch_assoc();
            $result = $row["id"];
            mkdir($_SERVER["DOCUMENT_ROOT"]."/assets/images/".$result);
        }
    }
?>
