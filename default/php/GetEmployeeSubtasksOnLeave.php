<?php
include 'connection.php';
$leaveID = $_POST['leaveID'];
$querytoGetSubtaskArray = mysqli_query($con, "SELECT sp.*, stg.*, subt.*
FROM userleaves AS ul
INNER JOIN subtask AS subt
ON ul.empId = subt.empid
AND subt.status <> 4
AND subt.subtaskDue BETWEEN ul.Startdate AND ul.EndDate
INNER JOIN employeedata as emdata
ON emdata.ID = subt.empid
INNER JOIN subtask_priority AS sp
ON subt.subtaskpriority = sp.ID
INNER JOIN subtask_stages AS stg
ON subt.status = stg.id
WHERE ul.id = '$leaveID'");

$querytogetLeaveArray = mysqli_query($con, "SELECT ul.*,
emdata.EmpName, emdata.Position, emdata.Email, emdata.MobileNo
FROM userleaves AS ul
INNER JOIN employeedata as emdata
ON emdata.ID = ul.empId
WHERE ul.id = '$leaveID'");
if (mysqli_num_rows($querytoGetSubtaskArray) > 0) {
    while ($row = $querytoGetSubtaskArray->fetch_assoc()) {
        $SubtasksArray[] = $row;
    }
} else {
    $SubtasksArray = array();
}
if (mysqli_num_rows($querytogetLeaveArray) > 0) {
    while ($row = $querytogetLeaveArray->fetch_assoc()) {
        $LeaveEmpArray[] = $row;
    }
} else {
    $LeaveEmpArray = array();
}
$response = array(
    "SubtaskData" => $SubtasksArray,
    "LeavesData" => $LeaveEmpArray,
);
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
