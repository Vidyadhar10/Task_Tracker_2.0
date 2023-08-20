<?php
session_start();
include 'connection.php';
include 'subtaskStages.php';
$first_stage = $subtaskStages[1]['id'];
echo $first_stage;
$t_id = $_GET['id'];
$t_name = $_GET['name'];
$ProjTaskKey = $_SESSION['ProjTaskKey'];
$subtaskNm = mysqli_real_escape_string($con, $_POST['subtaskName']);
$subtaskPriority = $_POST['subtaskPriority'];
$subtaskDue = $_POST['subtaskDue'];
//  $taskStatus = $_POST['inputEmpPosition'];
$subtaskDescription = mysqli_real_escape_string($con, $_POST['subtaskDescription']);
$checkbox1 = $_POST['subtaskassignEmp'];
$subtaskReport = $_POST['subtaskReporter'];
$subtaskstage = $_POST['subtaskStages'];
$CreaterMobile = $_SESSION['Mobile_No'];
$QueryforCreatedBy = "SELECT * FROM `employeedata` WHERE `MobileNo`= '$CreaterMobile'";
$executeQ = $con->query($QueryforCreatedBy);
while ($rowinfo = $executeQ->fetch_assoc()) {
	$createrID = $rowinfo['ID'];
	$CreatorNm = $rowinfo['EmpName'];
	$createrNames = $rowinfo['EmpName'];
}
$subtaskkey = 1;
$retriveTaskKey = "SELECT * FROM subtask WHERE `Task_name`='$t_name' AND `Task_id`='$t_id' ORDER BY `subtask_ID`";
$resultQ = $con->query($retriveTaskKey);
if (mysqli_num_rows($resultQ) > 0) {
	while ($rowData = $resultQ->fetch_assoc()) {
		$subtaskkey = $rowData['SubTaskKey'];
	}
	$subtaskkey = $subtaskkey + 1;
	$num = $subtaskkey;
	if (strlen(strval($num)) == 1) {
		$subtaskkeytext = $ProjTaskKey . '-00' . $subtaskkey;
	} elseif (strlen(strval($num)) == 2) {
		$subtaskkeytext = $ProjTaskKey . '-0' . $subtaskkey;
	} else {
		$subtaskkeytext = $ProjTaskKey . '-' . $subtaskkey;
	}
	$sql = "INSERT INTO subtask (`subtaskname`,`SubTaskKey`,`SubTaskKeyText`, `subtaskpriority`, `subtaskDue`, `subtaskdescription`,`empid`,`Task_name`,`Task_id`,`status`,`Reporter`,`Category`,`Created By`) VALUES ('$subtaskNm ','$subtaskkey', '$subtaskkeytext', '$subtaskPriority', '$subtaskDue', '$subtaskDescription','$checkbox1','$t_name','$t_id','$first_stage','$subtaskReport','$subtaskstage','$createrID')";
	if (mysqli_query($con, $sql)) {

		//adding to recent activity
		$ActivitySent = "A new Subtask $subtaskNm has been added by $CreatorNm!";
		date_default_timezone_set('Asia/Kolkata');
		$time = date('h:i A', time());
		$date = date("Y-m-d");
		$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
		mysqli_query($con, $sql2);
		$response = array(
			"success" => true,
		);

		$Activity_Title = "Sub-task Added";
		$Activity_Text = "A new sub-task <span class=`text-info`>$subtaskNm</span> has been added to  task <span class=`text-info`>$t_name</span> by <span class=`text-info`>$createrNames</span>";
		$Activity_Icon = mysqli_real_escape_string($con, "<i class='bi bi-subtract text-info'></i>");
		$Activity_By = $createrID;
		$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By')");
		if ($InsertInNotifi) {

			$response = array(
				"success" => true,
			);
		}
		header("location:../../task.php?task=$t_name&id=$t_id");
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
} else {
	$num = $subtaskkey;
	if (strlen(strval($num)) == 1) {
		$subtaskkeytext = $ProjTaskKey . '-00' . $subtaskkey;
	} elseif (strlen(strval($num)) == 2) {
		$subtaskkeytext = $ProjTaskKey . '-0' . $subtaskkey;
	} else {
		$subtaskkeytext = $ProjTaskKey . '-' . $subtaskkey;
	}
	$sql = "INSERT INTO subtask (`subtaskname`,`SubTaskKey`,`SubTaskKeyText`, `subtaskpriority`, `subtaskDue`, `subtaskdescription`,`empid`,`Task_name`,`Task_id`,`status`,`Reporter`,`Category`,`Created By`) VALUES ('$subtaskNm ','$subtaskkey', '$subtaskkeytext', '$subtaskPriority', '$subtaskDue', '$subtaskDescription','$checkbox1','$t_name','$t_id','$first_stage','$subtaskReport','$subtaskstage','$createrID')";
	// $sql = "INSERT INTO subtask (`subtaskname`,`SubTaskKey`,`SubTaskKeyText`, `subtaskpriority`, `subtaskDue`, `subtaskdescription`,`empid`,`Task_name`,`Task_id`) VALUES ('$subtaskNm ','$subtaskkey', '$subtaskkeytext', '$subtaskPriority', '$subtaskDue', '$subtaskDescription','$checkbox1','$t_name','$t_id','$first_stage')";
	if (mysqli_query($con, $sql)) {

		//adding to recent activity
		$ActivitySent = "A new Subtask $subtaskNm has been added by $CreatorNm !";
		date_default_timezone_set('Asia/Kolkata');
		$time = date('h:i A', time());
		$date = date("Y-m-d");
		$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
		mysqli_query($con, $sql2);
		$response = array(
			"success" => true,
		);
		$Activity_Title = "Sub-task Added";
		$Activity_Text = mysqli_real_escape_string($con, "A new sub-task <span class='text-info'>$subtaskNm</span> has been added to  task <span class='text-info'>$t_name</span> by <span class='text-info'>$createrNames</span>");
		$Activity_Icon = mysqli_real_escape_string($con, "<i class='bi bi-subtract text-info'></i>");
		$Activity_By = $createrID;
		$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By')");
		if ($InsertInNotifi) {

			$response = array(
				"success" => true,
			);
		}
		header("location:../../task.php?task=$t_name&id=$t_id");
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
}

mysqli_close($con);
