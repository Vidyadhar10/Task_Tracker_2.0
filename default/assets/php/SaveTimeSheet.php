<?php
include 'connection.php';
$selectedProjectNm = $_POST['selectedProject'];
$selectedProjectID = $_POST['selectedProjectID'];

$Subtasknm = $_POST['SubtaskName'];
$SubtaskID = $_POST['SubtasksID'];

$starttime = $_POST['startTime'];
$endtime = $_POST['endTime'];
$TotalHours = $_POST['Totalhrs'];
$selectedDT = $_POST['selectedDate'];


// Query for Employee ID
$EmployeeMobile = $_POST['EmpMobile'];
$queryToGetEmpID = mysqli_query($con, "SELECT `ID` FROM `employeedata` WHERE `MobileNo` = '$EmployeeMobile'");
$row = mysqli_fetch_assoc($queryToGetEmpID);
$employeeID = $row['ID'];

// Query to get subtask dueDate
$queryToSubtaskDetails = mysqli_query($con, "SELECT * FROM `subtask`
INNER JOIN `taskdata`
ON `subtask`.`Task_id` = `taskdata`.`id`
WHERE `subtask`.`subtaskname` = '$Subtasknm'
AND `taskdata`.`Project_name` = '$selectedProjectNm'
AND `subtask`.`empid` = '$employeeID'");

while ($row = $queryToSubtaskDetails->fetch_assoc()) {
    $subtaskdue = $row['subtaskDue'];
    $SubtaskAssignedDate = $row['Created Date'];
    $SubtaskStartDate = $row['SubtaskStartDate'];
    $subtaskEndDate = $row['SubtaskEndDate'];
}

$sql = "INSERT INTO `time_sheet` (`Project_Name`,`Project_ID`,`Subtask`,`Subtask_ID`,`Start_Time`,`End_Time`,`Total_Hours`,`SubtaskAssignedDate`,`SubtaskStartDate`,`SubtaskEndDate`,`Deadline`,`RecordOfDate`,`EmployeeID`) VALUES ('$selectedProjectNm','$selectedProjectID','$Subtasknm','$SubtaskID','$starttime','$endtime','$TotalHours','$SubtaskAssignedDate','$SubtaskStartDate','$subtaskEndDate','$subtaskdue','$selectedDT','$employeeID')";
if (mysqli_query($con, $sql)) {
    $response = array(
        "success" => true
    );
}

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
