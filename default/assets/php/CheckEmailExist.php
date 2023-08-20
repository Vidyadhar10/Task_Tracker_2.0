<?php
include 'connection.php';

$email = $_POST['EmailID'];

$queryToCheckMail = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `Email` = '$email'");

if (mysqli_num_rows($queryToCheckMail) > 0) {
    $row = mysqli_fetch_assoc($queryToCheckMail);
    $empName = $row['EmpName'];
    $response = array(
        "success" => true,
        "message" => $empName,
    );
} else {
    $response = array(
        "success" => false,
    );
}

header('Content-Type: application/json');
echo json_encode($response);
