<?php
include 'connection.php';


$pid = $_POST['pid'];
$employeesSelected = $_POST['employeesSelected'];
$string = implode(',', $employeesSelected);
$UpdateQuery = mysqli_query($con, "UPDATE `projectdata`
SET `assigned_emp` = '$string'
WHERE `SrNo` ='$pid'");

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
