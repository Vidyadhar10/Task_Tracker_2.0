<?php session_start(); ?>
<?php
include 'connection.php';
print_r(count($_FILES));
$AdminStatus = $_SESSION['AdminStatus'];
$mobileNumber = $_SESSION['Mobile_No'];
$targetDir = "assets/Files/";
$fileName = basename($_FILES["Attachments"]["name"]);
$targetFilePath = $targetDir . $fileName;
$folderStore = "../Files/" . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
if (move_uploaded_file($_FILES["Attachments"]["tmp_name"], $folderStore)) {
	// Insert image path into database
	echo "Image saved to folder";
} else {
	echo "Failed to upload image file.";
}
$commentEmpId = "SELECT * FROM `employeedata` WHERE `MobileNo` = $mobileNumber";
$resID = mysqli_query($con, $commentEmpId);
if (!$resID) {
	echo "error!";
}
while ($row = $resID->fetch_assoc()) {
	$ResEmpID = $row['ID'];
	$CommenterName = $row['EmpName']; //commenter name
}
date_default_timezone_set("Asia/Kolkata");
$comment = mysqli_real_escape_string($con, $_POST['comment']); //comment msg
$id = $_GET['subid'];
$res = $_GET['tos'];
$Date = new DateTime();
$Date = $Date->format('Y-m-d H:i:s');
$time = date("h:i");




$sql = "INSERT INTO `commentdata` (`subtaskid`,`EmpID`, `comment`, `date`, `time`,`path`) VALUES ('$id','$ResEmpID','$comment','$Date','$time','$targetFilePath')";
if (mysqli_query($con, $sql)) {

	// get task name
	$queryToGetTaskName = mysqli_query($con, "SELECT * FROM `subtask` WHERE `subtask_ID` = '$id'");
	while ($results = $queryToGetTaskName->fetch_assoc()) {
		$subtaskname = $results['subtaskname']; //subtask name
		$createdby = $results['Created By']; //subtask created by id
	}

	$queryToGetSubtaskCreater = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `ID` = '$createdby'");
	while ($resRowOfCB = $queryToGetSubtaskCreater->fetch_assoc()) {
		$CreatedByName = $resRowOfCB['EmpName']; //created by name
		$CreaterEmailId = $resRowOfCB['Email'];
	}



	$ActivitySent = "A new comment has been added by $CommenterName!";
	date_default_timezone_set('Asia/Kolkata');
	$time = date('h:i A', time());
	$date = date("Y-m-d");
	$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
	mysqli_query($con, $sql2);
	$response = array(
		"success" => true,
	);


	$Activity_Title = "Comment Added";
	$Activity_Text = mysqli_real_escape_string($con, "A new comment has been added to sub-task <span class='text-primary'>$subtaskname</span> by <span class='text-primary'>$CommenterName</span>");
	$Activity_Icon = mysqli_real_escape_string($con, "<i class='bi bi-chat-right-dots text-primary'></i>");
	$Activity_By = $createrID;
	$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `sutaskID`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$id')");
	if ($InsertInNotifi) {

		$response = array(
			"success" => true,
		);
	}

?>

	<!-- CDN for AJAX -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
		$.get("../../Email/email_comment_added.php", function(htmlCode) {
			htmlCode = htmlCode.replace("[Admin Name]", '<?php echo $CreatedByName; ?>');
			htmlCode = htmlCode.replace("[SubTask Name]", '<?php echo $subtaskname; ?>');
			htmlCode = htmlCode.replace("[Name of commenter]", '<?php echo $CommenterName; ?>');
			htmlCode = htmlCode.replace("[Date]", '<?php echo $Date + $time; ?>');
			htmlCode = htmlCode.replace("[Redirect_Link]", "http://localhost/07%20March/Task-Manager/pages-login.html");

			var EmailBody = htmlCode;
			$.ajax({
				url: "../../Email/SendMail.php",
				method: 'POST',
				data: {
					email: '<?php echo $CreaterEmailId; ?>',
					subject: 'Someone has commented',
					body: EmailBody
				},
				success: function(result) {

					console.log("commnet added");
					<?php if ($AdminStatus == 1) {
						header("location:../../subtaskatadmin.php?tos=$id");
					} else {
						header("location:../../emptask.php?tos=$id");
					} ?>

				}
			});
		});
	</script>
<?php

} else {
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
mysqli_close($con);
?>