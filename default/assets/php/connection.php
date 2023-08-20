<?php
    $server ="localhost";
    $name = "root";
    $pass = "";
    $db = "ccpl";
    $con = new mysqli($server, $name, $pass, $db);
    if (!$con) {
        die("Error".mysqli_error($con));
    }
?>