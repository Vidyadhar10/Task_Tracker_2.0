<?php
include 'connection.php';


$empID = $_POST['empId'];
$checkPassQuery = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `ID` = '$empID'");

while ($result = $checkPassQuery->fetch_assoc()) {
    $responseD = array(
        "success" => true,
        "empNM" => $result['EmpName']
    );
}




header('Content-Type: application/json');
echo json_encode($responseD);
