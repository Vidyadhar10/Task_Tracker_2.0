<?php
session_start();
include 'connection.php';

$createrID = $_SESSION['Admin_id'];
$createrName = $_SESSION['Uname'];

$p_id = $_POST['pid'];
$tid = $_POST['tid'];

$getTaskKey = mysqli_query($con, "SELECT TaskKeyText, Task_name FROM taskdata where id = $tid");
while ($row = $getTaskKey->fetch_assoc()) {
    # code...
    $ProjTaskKey = $row['TaskKeyText'];
    $Task_name = $row['Task_name'];
}

$subtaskNm = mysqli_real_escape_string($con, $_POST['subtasknm']);
$subtaskPriority  = $_POST['subtaskpri'];
$subtaskDue = $_POST['subtaskDue'];
$subtaskDescription = mysqli_real_escape_string($con, $_POST['subtaskDescription']);
$subtaskcategory = $_POST['subtaskcategory'];
$assignee = $_POST['assignee'];
$reporter = $_POST['reporter'];


$retriveTaskKey = "SELECT * FROM subtask WHERE `Task_id`='$tid' ORDER BY `subtask_ID`";
$resultQ = $con->query($retriveTaskKey);
if (mysqli_num_rows($resultQ) > 0) {
    while ($rowData = $resultQ->fetch_assoc()) {
        $subtaskkey = $rowData['SubTaskKey'];
    }
}
if (isset($subtaskkey)) {
    $subtaskkey = $subtaskkey + 1;
} else {
    $subtaskkey = 1;
}
$num = $subtaskkey;
if (strlen(strval($num)) == 1) {
    $subtaskkeytext = $ProjTaskKey . '-00' . $subtaskkey;
} elseif (strlen(strval($num)) == 2) {
    $subtaskkeytext = $ProjTaskKey . '-0' . $subtaskkey;
} else {
    $subtaskkeytext = $ProjTaskKey . '-' . $subtaskkey;
}
$sql = "INSERT INTO subtask (`subtaskname`,`SubTaskKey`,`SubTaskKeyText`,
`subtaskpriority`, `subtaskDue`, `subtaskdescription`,`empid`,
`Task_id`,`status`,`Reporter`,`Category`,`Created_By`)
VALUES ('$subtaskNm ','$subtaskkey', '$subtaskkeytext', '$subtaskPriority', '$subtaskDue',
'$subtaskDescription','$assignee','$tid','1','$reporter',
'$subtaskcategory','$createrID')";
if (mysqli_query($con, $sql)) {

    //adding to recent activity
    $ActivitySent = "A new Subtask $subtaskNm has been added by $createrName!";
    date_default_timezone_set('Asia/Kolkata');
    $time = date('h:i A', time());
    $date = date("Y-m-d");
    $sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`)
    VALUES ('$time','$ActivitySent', '$date')";
    mysqli_query($con, $sql2);
    $response = array(
        "success" => true,
    );

    $Activity_Title = "Sub-task Added";
    $Activity_Text = "A new sub-task <span class='text-info'>$subtaskNm</span>
     has been added to  task <span class='text-info'>$Task_name</span> 
     by <span class='text-info'>$createrName</span>";
    $Activity_Icon = mysqli_real_escape_string($con, "bx bx-list-check");
    $Activity_By = $createrID;
    $InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications`
    (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`,`sutaskID`,`activity_type`)
    VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By','$subtaskkey',4)");
    if ($InsertInNotifi) {
        $response = array(
            "success" => true,
        );
    }
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
