<?php
include 'connection.php';


$mailADDress = $_POST['emailAddress'];
$OTPGenerated = $_POST['OTPGen'];


$queryToStoreOTP = mysqli_query($con, "UPDATE `employeedata` SET `isSuperAdmin` = '$OTPGenerated' WHERE `Email` = '$mailADDress'");

if ($queryToStoreOTP) {
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
