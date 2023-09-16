<?php
session_start();
include 'connection.php';
$mobileNumber = $_SESSION['Mobile_No'];
$commentEmpId = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `MobileNo` = $mobileNumber");

while ($row = $commentEmpId->fetch_assoc()) {
	$ResEmpID = $row['ID'];
	$CommentDeleterNm = $row['EmpName']; //commenter name
}

$id = $_GET['tos'];
$subtaskIDD = $_POST['subtasksID'];
$res = $_POST['DelComment'];
$DelAllReply = "DELETE FROM `replycomment` WHERE `replycomment`.`ID` = '$res'";
mysqli_query($con, $DelAllReply);

$ActivitySent = "A comment has been deleted by $CommentDeleterNm !";
date_default_timezone_set('Asia/Kolkata');
$time = date('h:i A', time());
$date = date("Y-m-d");
$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
mysqli_query($con, $sql2);

$queryToGetTaskName = mysqli_query($con, "SELECT * FROM `subtask` WHERE `subtask_ID` = '$subtaskIDD'");
while ($results = $queryToGetTaskName->fetch_assoc()) {
	$subtaskname = $results['subtaskname']; //subtask name
	$createdby = $results['Created By']; //subtask created by id
}
$Activity_Title = "Comment deleted";
$Activity_Text = mysqli_real_escape_string($con, "<span class='text-danger'>$CommentDeleterNm</span> has deleted a comment of sub-task <span class='text-danger'>$subtaskname</span>");
$Activity_Icon = mysqli_real_escape_string($con, "<i class='bi bi-trash text-danger'></i>");
$Activity_By = $ResEmpID;
$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `sutaskID`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$subtaskIDD')");
if ($InsertInNotifi) {

	$response = array(
		"success" => true,
	);
}

mysqli_close($con);
