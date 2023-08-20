<?php

include 'connection.php';

$mail = $_POST['emailID'];

$GetOtpStored = mysqli_query($con, "SELECT `isSuperAdmin` FROM `employeedata` WHERE `Email` = '$mail'");
if (mysqli_num_rows($GetOtpStored) === 1) {
    $row = mysqli_fetch_assoc($GetOtpStored);
    $value = $row['isSuperAdmin'];
    $response = array(
        "success" => true,
        "message" => $value,
    );
}
header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
