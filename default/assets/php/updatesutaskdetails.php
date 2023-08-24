<?php
session_start();
include 'connection.php';

$mobileNumber = $_SESSION['Mobile_No'];
$UpdaterInfo = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `MobileNo` = $mobileNumber");

while ($row = $UpdaterInfo->fetch_assoc()) {
    $ResEmpID = $row['ID'];
    $UpdaterName = $row['EmpName']; //commenter name
}

$subtaskId = $_POST['subtaskid'];
$subtaskname = mysqli_real_escape_string($con, $_POST['subtaskname']);
$subtaskpriority = $_POST['subtaskpriority'];
$subtaskdue = $_POST['subtaskdue'];
$subtaskcategory = $_POST['subtaskcategory'];
$subtaskdescription = mysqli_real_escape_string($con, $_POST['subtaskdescription']);
$subtaskassignee = $_POST['subtaskassignee'];
$subtaskreporter = $_POST['subtaskreporter'];

$Update = mysqli_query($con, "UPDATE `subtask` SET `subtaskname`='$subtaskname', `subtaskpriority`='$subtaskpriority', `subtaskDue`='$subtaskdue', `Category`='$subtaskcategory',`subtaskDescription`='$subtaskdescription', `empid`='$subtaskassignee', `Reporter`='$subtaskreporter' WHERE `subtask_ID`='$subtaskId'");

if ($Update) {
    $Activity_Title = "Subtask Details Updated";
    $Activity_Text = mysqli_real_escape_string($con, "Sub-task details are updated by <span class='text-primary'>$UpdaterName</span>");
    $Activity_Icon = mysqli_real_escape_string($con, "<i class='bi bi-arrow-repeat text-primary'></i>");
    $Activity_By = $ResEmpID;
    $InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `sutaskID`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$subtaskId')");
    if ($InsertInNotifi) {
        $response = array(
            "success" => true,
        );
    }
}
header('Content-Type: application/json');
echo json_encode($response);
