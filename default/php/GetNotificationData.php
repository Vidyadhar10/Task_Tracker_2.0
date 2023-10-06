<?php
session_start();
include 'connection.php';


$checkPassQueryCount = mysqli_query($con, "SELECT count(*) AS `NotificationsCount` FROM `notifications` WHERE `seen` = 0");
$row = mysqli_fetch_array($checkPassQueryCount);
$CalcCount = $row['NotificationsCount'];

if ($_SESSION['AdminStatus']) {
    $IsAdminStatus = true;
} else {
    $IsAdminStatus = false;
}

$checkPassQuery = mysqli_query($con, "SELECT * FROM `notifications` WHERE `seen` = 0 ORDER BY Activity_Time DESC");
if (mysqli_num_rows($checkPassQuery) <= 0) {
    $FinalResponse = array(
        "message" => "No Entries In Table",
        "NotiTableData" => [],
        "NotificationCount" => 0,
    );
} else {

    while ($result = $checkPassQuery->fetch_assoc()) {
        $responseD = array(
            "IsAdmin" => $IsAdminStatus,
            "ActivityID" => $result['ID'],
            "ActivityTitle" => $result['Activity_Title'],
            "ActivityText" => $result['Activity_Text'],
            "ActivityTime" => $result['Activity_Time'],
            "ActivityIcon" => $result['Activity_Icon'],
            "ActivityFlag" => $result['seen'],
            "ProjectName" => $result['ProjectName'],
            "ProjectID" => $result['ProjectID'],
            "ProjectKey" => $result['ProjectKey'],
            "subtaskId" => $result['sutaskID'],
            "ActCreator" => $result['Activity_By'],
            "Task_ID" => $result['Task_ID'],
            "activity_type" => $result['activity_type']
        );
        $response[] = $responseD;
    }
    $FinalResponse = array(
        "NotiTableData" => $response,
        "NotificationCount" => $CalcCount,
    );
}




header('Content-Type: application/json');
echo json_encode($FinalResponse);
