<?php session_start(); ?>
<?php
include 'connection.php';
$AdminStatus = $_SESSION['AdminStatus'];
$mobileNumber = $_SESSION['Mobile_No'];
$ReplyCommentEmpId = "SELECT * FROM `employeedata` WHERE `MobileNo` = $mobileNumber";
$resID = mysqli_query($con, $ReplyCommentEmpId);
if (!$resID) {
    echo "error!";
}
while ($row = $resID->fetch_assoc()) {
    $ResEmpID = $row['ID'];
    $ResEmpName = $row['EmpName'];
}
$cmtid = $_GET['CommnetsID'];
$subtaskid = $_GET['subid'];
$var = 'ReplyComment' . $cmtid;
$msg = mysqli_real_escape_string($con, $_POST[$var]);
$sql = "INSERT INTO `replycomment` (`comment-ID`,`subtask-ID`, `Emp-ID`, `CommentSentence`) VALUES ('$cmtid','$subtaskid','$ResEmpID','$msg')";
if (mysqli_query($con, $sql)) {

    $queryToGetTaskName = mysqli_query($con, "SELECT * FROM `subtask` WHERE `subtask_ID` = '$subtaskid'");
    while ($results = $queryToGetTaskName->fetch_assoc()) {
        $subtaskname = $results['subtaskname']; //subtask name
        $createdby = $results['Created By']; //subtask created by id
    }
    $Activity_Title = "Replied to comment";
    $Activity_Text = mysqli_real_escape_string($con, "<span class='text-primary'>$ResEmpName</span> has replied to comment of sub-task <span class='text-primary'>$subtaskname</span>");
    $Activity_Icon = mysqli_real_escape_string($con, "<i class='bi bi-twitch text-info'></i>");
    $Activity_By = $createrID;
    $InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `sutaskID`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$subtaskid')");
    if ($InsertInNotifi) {

        $response = array(
            "success" => true,
        );
    }
    if ($AdminStatus == 1) {
        header("location:../../subtaskatadmin.php?tos=$subtaskid");
    } else {
        header("location:../../emptask.php?tos=$subtaskid");
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
mysqli_close($con);
?>