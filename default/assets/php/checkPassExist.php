<?php
include 'connection.php';

$enteredPass = $_POST['enteredPass'];
$usermobile = $_POST['loggedinUser'];
$pass = md5($enteredPass);


$checkPassQuery = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `MobileNo` = '$usermobile' AND `Password` ='$pass'");


// while ($row = $checkPassQuery->fetch_assoc()) {
if (mysqli_num_rows($checkPassQuery) > 0) {
    $response = array(
        "success" => true,
    );
} else {
    $response = array(
        "success" => false,
    );
}
// }

header('Content-Type: application/json');
echo json_encode($response);
