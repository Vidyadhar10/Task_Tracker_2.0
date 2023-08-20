<?php
include 'connection.php';


$enteredPass = $_POST['enteredPass'];
$usermobile = $_POST['loggedinUser'];
$pass = md5($enteredPass);


$UpdateQuery = mysqli_query($con, "UPDATE `employeedata` SET `Password` = '$pass' WHERE `MobileNo` ='$usermobile'");

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
