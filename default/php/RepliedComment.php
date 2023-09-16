<?php
session_start();
include 'connection.php';

$comments_id = $_POST['comments_id'];
$subtaskid = $_POST['subid'];
$reply_comment_msg = mysqli_real_escape_string($con, $_POST['reply_comment_msg']);
$reply_commenter_id = $_POST['reply_commenter_id'];

$resID = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `ID` = '$reply_commenter_id';");
while ($row = $resID->fetch_assoc()) {
    $ResEmpName = $row['EmpName'];
}

$sql = "INSERT INTO `replycomment`
(`comment-ID`,`subtask-ID`, `Emp-ID`, `CommentSentence`)
VALUES ('$comments_id','$subtaskid','$reply_commenter_id','$reply_comment_msg')";
if (mysqli_query($con, $sql)) {

    $queryToGetTaskName = mysqli_query($con, "SELECT * FROM `subtask` WHERE `subtask_ID` = '$subtaskid'");
    while ($results = $queryToGetTaskName->fetch_assoc()) {
        $subtaskname = $results['subtaskname']; //subtask name
        $createdby = $results['Created_By']; //subtask created by id
    }
    $Activity_Title = "Replied to comment";
    $Activity_Text = mysqli_real_escape_string($con, "<span class='text-primary'>$ResEmpName</span> has replied to comment of sub-task <span class='text-primary'>$subtaskname</span>");
    $Activity_Icon = mysqli_real_escape_string($con, "ri-question-answer-line");
    $Activity_By = $reply_commenter_id;
    $InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications`
    (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `sutaskID`)
    VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$subtaskid')");
    if ($InsertInNotifi) {
        $response = array(
            "success" => true,
        );
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
