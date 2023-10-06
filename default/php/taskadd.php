<?php
session_start();
include 'connection.php';

$CreaterMobile = $_SESSION['Mobile_No'];
$QueryforCreatedBy = "SELECT * FROM `employeedata` WHERE `MobileNo`= '$CreaterMobile'";
$executeQ = $con->query($QueryforCreatedBy);
while ($rowinfo = $executeQ->fetch_assoc()) {
	$createrID = $rowinfo['ID'];
	$createrName = $rowinfo['EmpName'];
}

$p_id = $_POST['ProjIDD'];
$p_name = $_POST['Proj_NAME'];
$P_key = $_POST['ProjKEY'];

$taskNm = mysqli_real_escape_string($con, $_POST['taskName']);
$taskPriority  = $_POST['taskpri'];
$taskDue = $_POST['taskDue'];
$taskDescription = mysqli_real_escape_string($con, $_POST['taskDescription']);

$CreaterMobile = $_SESSION['Mobile_No'];
$QueryforCreatedBy = "SELECT * FROM `employeedata` WHERE `MobileNo`= '$CreaterMobile'";
$executeQ = $con->query($QueryforCreatedBy);
while ($rowinfo = $executeQ->fetch_assoc()) {
	$createrID = $rowinfo['ID'];
	$createrNames = $rowinfo['EmpName'];
}

$T_Key = 1;
$retriveTaskKey = "SELECT * FROM `taskdata` WHERE `Project_id`='$p_id' ORDER BY `TaskKey`";

$resultQ = $con->query($retriveTaskKey);
if (mysqli_num_rows($resultQ) > 0) {
	while ($rowData = $resultQ->fetch_assoc()) {
		$T_Key = $rowData['TaskKey'];
	}
	$T_Key = $T_Key + 1;
	$num = $T_Key;
	if (strlen(strval($num)) == 1) {
		$T_Key_Text =  $P_key . '-00' . $T_Key;
	} elseif (strlen(strval($num)) == 2) {
		$T_Key_Text =  $P_key . '-0' . $T_Key;
	} else {
		$T_Key_Text =  $P_key . '-' . $T_Key;
	}
	$sql = "INSERT INTO taskdata (`Task_name`, `Task_priority`, `Task_Due`, `Task_description`,`TaskKey`,`TaskKeyText`,`Project_id`,`CreatedBy`) VALUES ('$taskNm ', '$taskPriority', '$taskDue', '$taskDescription','$T_Key','$T_Key_Text','$p_id','$createrID')";
	mysqli_query($con, $sql);


	//adding to recent activity
	$ActivitySent = "A new Task $taskNm has been added by $createrName !";
	date_default_timezone_set('Asia/Kolkata');
	$time = date('h:i A', time());
	$date = date("Y-m-d");
	$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
	mysqli_query($con, $sql2);
	$response = array(
		"success" => true,
	);

	$Activity_Title = "Task Added";
	$Activity_Text = mysqli_real_escape_string($con, "A new task <span class='text-warning'>$taskNm</span> has been added to <span class='text-warning'>$p_name</span> by <span class='text-warning'>$createrNames</span>");
	$Activity_Icon = mysqli_real_escape_string($con, "ri-file-list-line");
	$Activity_By = $createrID;
	$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`,`ProjectID`,`Task_ID`,`activity_type`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By','$p_id','$T_Key',3)");
	if ($InsertInNotifi) {

		$response = array(
			"success" => true,
		);
	}
} else {
	//Retrive rows then insert
	$num = $T_Key;
	if (strlen(strval($num)) == 1) {
		$T_Key_Text =  $P_key . '-00' . $T_Key;
	} elseif (strlen(strval($num)) == 2) {
		$T_Key_Text =  $P_key . '-0' . $T_Key;
	} else {
		$T_Key_Text =  $P_key . '-' . $T_Key;
	}
	$sql = "INSERT INTO `taskdata` (`Task_name`, `Task_priority`, `Task_Due`, `Task_description`,`TaskKey`,`TaskKeyText`,`Project_id`,`CreatedBy`) VALUES ('$taskNm ', '$taskPriority', '$taskDue', '$taskDescription','$T_Key','$T_Key_Text','$p_id','$createrID')";
	mysqli_query($con, $sql);

	//adding to recent activity
	$ActivitySent = "A new Task $taskNm has been added by $createrName!";
	date_default_timezone_set('Asia/Kolkata');
	$time = date('h:i A', time());
	$date = date("Y-m-d");
	$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
	mysqli_query($con, $sql2);
	$response = array(
		"success" => true,
	);

	$Activity_Title = "Task Added";
	$Activity_Text = mysqli_real_escape_string($con, "A new task <span class='text-warning'>$taskNm</span> has been added to <span class='text-warning'>$p_name</span> by <span class='text-warning'>$createrNames</span>");
	$Activity_Icon = mysqli_real_escape_string($con, "ri-file-list-line");
	$Activity_By = $createrID;
	$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`,`ProjectID`,`Task_ID`,`activity_type`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By','$p_id','$T_Key',3)");
	if ($InsertInNotifi) {

		$response = array(
			"success" => true,
		);
	}
}

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
