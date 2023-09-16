<?php
include 'connection.php';


$enteredmobile = $_POST['MobileNum'];

$queryToCheckMobile = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `MobileNo` = '$enteredmobile'");

if (mysqli_num_rows($queryToCheckMobile) > 0) {
    $response = array(
        "success" => true,
    );
} else {
    $response = array(
        "success" => false,
    );
}

header('Content-Type: application/json');
echo json_encode($response);
