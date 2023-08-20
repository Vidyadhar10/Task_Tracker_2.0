<?php
include 'connection.php';

// Query for Assignee name

$ProjID = $_POST['selectedProj'];

$EmployeeMobile = $_POST['EmpMobile'];
$queryToGetEmpID = mysqli_query($con, "SELECT `ID` FROM `employeedata` WHERE `MobileNo` = '$EmployeeMobile'");
$row = mysqli_fetch_assoc($queryToGetEmpID);
$employeeID = $row['ID'];


$QueryAssignee = "SELECT * FROM `taskdata` WHERE `Project_id` = '$ProjID'";
$taskID = $con->query($QueryAssignee);
while ($taskIDRow = $taskID->fetch_assoc()) {
    $taskIDArray[] = $taskIDRow['id'];
}
$taskIDArray = array_unique($taskIDArray);

// $response = array();
$visitedTasks = array();

for ($i = 0; $i < count($taskIDArray); $i++) {
    $SubtaskQuery = mysqli_query($con, "SELECT * FROM `subtask` WHERE `empid`='$employeeID' AND `Task_id`='$taskIDArray[$i]' AND `status`!= 1");

    while ($subtaskRow = $SubtaskQuery->fetch_assoc()) {
        $response[] = $subtaskRow;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
