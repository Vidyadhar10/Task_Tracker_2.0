<?php
include 'connection.php';

$selectedProjectID = $_POST['selectedProjectID'];
$SubtaskID = $_POST['SubtasksID'];

$starttime = $_POST['startTime'];
$endtime = $_POST['endTime'];
$TotalHours = $_POST['Totalhrs'];
$selectedDT = $_POST['selectedDate'];

$employeeID = $_POST['uid'];

// Query to get subtask dueDate
$queryToSubtaskDetails = mysqli_query($con, "SELECT * FROM `subtask`
INNER JOIN `taskdata`
ON `subtask`.`Task_id` = `taskdata`.`id`
WHERE `subtask`.`subtask_ID` = '$SubtaskID'
AND `taskdata`.`Project_id` = '$selectedProjectID'
AND `subtask`.`empid` = '$employeeID'");

while ($row = $queryToSubtaskDetails->fetch_assoc()) {
    $subtaskdue = $row['subtaskDue'];
    $SubtaskAssignedDate = $row['Created_Date'];
    $SubtaskStartDate = $row['SubtaskStartDate'];
    $subtaskEndDate = $row['SubtaskEndDate'];
}

$sql = "INSERT INTO `time_sheet`
(`Project_ID`, `Subtask_ID`,`Start_Time`,`End_Time`,`Total_Hours`,`SubtaskAssignedDate`,
`SubtaskStartDate`,`SubtaskEndDate`,`Deadline`,`RecordOfDate`,`EmployeeID`)
VALUES ('$selectedProjectID','$SubtaskID','$starttime','$endtime','$TotalHours','$SubtaskAssignedDate',
'$SubtaskStartDate','$subtaskEndDate','$subtaskdue','$selectedDT','$employeeID')";

if (mysqli_query($con, $sql)) {
    $response = array(
        "success" => true
    );
}

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
