<?php
include 'connection.php';
$emailID = $_POST['emailAdd'];

$GetOtpStored = mysqli_query($con, "UPDATE `employeedata` SET `isSuperAdmin` = NULL WHERE `Email` = '$emailID'");
if ($GetOtpStored) {
    $response = array(
        "success" => true
    );
} else {
    $response = array(
        "success" => false
    );
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
