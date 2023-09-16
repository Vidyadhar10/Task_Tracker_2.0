<?php
session_start();
include 'connection.php';
$admin_status = $_SESSION['AdminStatus'];
$mob = $_SESSION['Mobile_No'];
$QueryforCreatedBy = "SELECT * FROM `employeedata` WHERE `MobileNo`= '$mob'";
$executeQ = $con->query($QueryforCreatedBy);
while ($rowinfo = $executeQ->fetch_assoc()) {
    $createrID = $rowinfo['ID'];
    $createrName = $rowinfo['EmpName'];
}

$subtaskID = $_POST['subtask_ID'];
$target_stage = $_POST['NextStageID'];
$NextStageNM = $_POST['NextStageNM'];
$currentStage = $_POST['currentStageNM'];
$currentDateTime = date("Y-m-d h:i A");
// if it's in progress
if ($target_stage == 2) {
    $q = "UPDATE `subtask`
    SET `status` = '$target_stage',
    `SubtaskStartDate`='$currentDateTime'
    WHERE `subtask_ID` = '$subtaskID'";
} elseif ($target_stage == 4) {
    $q = "UPDATE `subtask`
    SET `status` = '$target_stage',
    `SubtaskEndDate`='$currentDateTime'
    WHERE `subtask_ID` = '$subtaskID'";
} else {
    $q = "UPDATE `subtask` SET `status` = '$target_stage' WHERE `subtask_ID` = '$subtaskID' ";
}
if (mysqli_query($con, $q)) {
    $queryToGetSubTaskName = mysqli_query($con, "SELECT * FROM `subtask` WHERE `subtask_ID` = '$subtaskID'");
    while ($results = $queryToGetSubTaskName->fetch_assoc()) {
        $subtaskname = $results['subtaskname']; //subtask name
        $createdby = $results['Created_By']; //subtask created by id
    }
    //adding to recent activity
    $ActivitySent = "The Stage of Sub-task $subtaskname has been changed to $NextStageNM from $currentStage by $createrName!";
    date_default_timezone_set('Asia/Kolkata');
    $time = date('h:i A', time());
    $date = date("Y-m-d");
    $sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
    mysqli_query($con, $sql2);

    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false));
}
mysqli_close($con);
