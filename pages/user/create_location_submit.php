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
    $stmp = $conn->prepare("SELECT location FROM locations WHERE location=?;");
    $stmp->bind_param("s",$location_name);
    $stmp->execute();
    $stmp->bind_result($result);
    $stmp->fetch();
    if ($result) {
        $_SESSION["create_location_error_message"] = "That location already exists! Try editing the already existing location rather than creating a new one.";
        header ("location: /pages/user/create_location.php");
        die();
    }
    else {
        $stmp1 = $conn->prepare("INSERT INTO locations (location) VALUES (?);");
        $stmp1->bind_param("s",$location_name);
        $stmp1->execute();
        $stmp2 = $conn->prepare("SELECT id FROM locations WHERE location=?;");
        $stmp2->bind_param("s", $location_name);
        $stmp2->execute();
        $stmp2->bind_result($result);
        $stmp2->fetch();
        if ($result) {
            mkdir($_SERVER["DOCUMENT_ROOT"]."/assets/images/".$result);
        }
    }
?>
