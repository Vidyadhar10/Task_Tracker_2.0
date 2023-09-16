<?php
include 'connection.php';
$sql = "SELECT * FROM `employeedata` WHERE `isAdmin`=0";
$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}
header('Content-Type: application/json');
echo json_encode($response);
