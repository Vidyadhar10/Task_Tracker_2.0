<?php
include 'connection.php';
$p_id = $_GET['projectId'];
$sql = "SELECT ID, EmpName FROM `employeedata` inner join `empwork` on empwork.Emp_ID=employeedata.ID where empwork.Project_ID= $p_id";
// $q = "SELECT * FROM `employeedata`";
$result = $con->query($sql);
if (!$result) {
    die("Invalid query:" . $con->error);
}
while ($row = $result->fetch_assoc()) {
    $result4[] = $row;
}

header('Content-Type: application/json');
echo json_encode($result4);
