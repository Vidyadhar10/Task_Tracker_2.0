<?php
session_start();
include 'connection.php';

$FilesAttachedPath = '';
if (isset($_FILES['files'])) {
	$targetDir = "./Comment_Files/";

	// Loop through each uploaded file
	for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
		$fileName = basename($_FILES['files']['name'][$i]);
		$targetFilePath = $targetDir . $fileName;
		$FilesAttachedPath .= '--' . $targetFilePath;
		$folderStore = "../Comment_Files/" . $fileName;

		// Move the uploaded file to the target directory
		if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $folderStore)) {
			// File moved successfully, you can insert the file path into the database or perform other actions
			//echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully']);
		} else {
			// Error moving the file
			//echo json_encode(['status' => 'error', 'message' => 'Failed to upload file']);
		}
	}
}
$subtaskid = $_POST['subid'];
$comment_msg = mysqli_real_escape_string($con, $_POST['comment_msg']);
$commenter_id = $_POST['commenter_id'];


$sql = "INSERT INTO `commentdata`(`subtaskid`,`EmpID`, `comment`,`path`)
VALUES ('$subtaskid','$commenter_id','$comment_msg','$FilesAttachedPath')";
if (mysqli_query($con, $sql)) {

	// get task name
	$queryToGetTaskName = mysqli_query($con, "SELECT * FROM `subtask` AS sb
	INNER JOIN employeedata AS emd
	ON emd.ID = sb.Created_By
	WHERE `subtask_ID` = '$subtaskid'");
	while ($results = $queryToGetTaskName->fetch_assoc()) {
		$subtaskname = $results['subtaskname']; //subtask name
		$createdby = $results['Created_By']; //subtask created by id
		$CreatedByName = $results['EmpName']; //created by name
		$CreaterEmailId = $results['Email'];
	}

	$getCommenterNm = mysqli_query($con, "SELECT EmpName from employeedata where ID = '$commenter_id';");
	while ($rw = $getCommenterNm->fetch_assoc()) {
		$CommenterName = $rw['EmpName'];
	}




	$ActivitySent = "A new comment has been added by $CommenterName!";
	date_default_timezone_set('Asia/Kolkata');
	$time = date('h:i A', time());
	$date = date("Y-m-d");
	$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
	mysqli_query($con, $sql2);

	$Activity_Title = "Comment Added";
	$Activity_Text = mysqli_real_escape_string($con, "A new comment has been added to sub-task
					<span class='text-primary'>$subtaskname</span> by
					<span class='text-primary'>$CommenterName</span>");
	$Activity_Icon = mysqli_real_escape_string($con, "ri-message-2-line");
	$Activity_By = $commenter_id;
	$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications`
	(`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `sutaskID`,`activity_type`)
	VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$subtaskid',4)");

	$response = array(
		"success" => true,
	);
} else {
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
