<?php
include 'connection.php';

$sql = "SELECT ul.*, emp.EmpName, emp.ProfilePhoto,emp.Position, ltype.leave_category
FROM `userleaves` AS ul
INNER JOIN employeedata AS emp ON ul.empId = emp.ID
INNER JOIN leave_types AS ltype ON ltype.ID = ul.leaveType";
$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}
header('Content-Type: application/json');
echo json_encode($response);
