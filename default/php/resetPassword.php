<?php
include 'connection.php';
$enteredEmail = $_POST['EmailID'];
$newPass = $_POST['newPassword'];
$pass = md5($newPass);

$UpdateQuery = mysqli_query($con, "UPDATE `employeedata` SET `Password` = '$pass' WHERE `Email` ='$enteredEmail'");

if ($UpdateQuery) {
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
