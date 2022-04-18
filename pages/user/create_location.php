<?php
    session_start();
    include $_SERVER["DOCUMENT_ROOT"]."/includes/dbh.php";
    include $_SERVER["DOCUMENT_ROOT"]."/includes/check_login.php";
    if (isset($_SESSION["create_location_error_message"]) {
        $error_message = $_SESSION["create_location_error_message"]);
        unset ($_SESSION["create_location_error_message"]);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create location</title>
    </head>
    <body>
        <p>Enter the name of the city or location you wish to create</p>
        <form action="create_location_submit.php" method="POST">
            <input type="text" name="location_name" placeholder="location">
            <input type="submit" value="Create">
        </form>
        <p><?php if(isset($error_message)) {echo $error_message;} ?></p>
    </body>
</html>
