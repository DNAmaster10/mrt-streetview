<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    include $_SERVER["DOCUMENT_ROOT"]."/includes/check_login.php";
    $location_name = $conn->real_escape_string($_POST["location_name"]);
    $stmt = $conn->prepare("SELECT id FROM location WHERE location=?");
    $stmt->bind_param("s",$location_name);
    $stmt->execute();
    $stmt->bind_result($location_id);
    $stmt->fetch();
    $stmt->close();
    
    $stmt = $conn->prepare("SELECT 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Editing </title>
    </head>
    <body>
        
    </body>
</html>
