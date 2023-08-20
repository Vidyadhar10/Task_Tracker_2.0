<?php
include 'connection.php';


$checkPassQueryCount = mysqli_query($con, "SELECT count(*) AS `NotificationsCount` FROM `notifications` WHERE `seen` = 0");
$row = mysqli_fetch_array($checkPassQueryCount);
$CalcCount = $row['NotificationsCount'];

$checkPassQuery = mysqli_query($con, "SELECT * FROM `notifications` ORDER BY Activity_Time DESC");
if (mysqli_num_rows($checkPassQuery) <= 0) {
    $response = array(
        "message" => "No Entries In Table",
        "NotificationCount" => 0,
    );
}
while ($result = $checkPassQuery->fetch_assoc()) {
    $responseD = array(
        "NotificationCount" => $CalcCount,
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
        "ActCreator" => $result['Activity_By']
    );
    $response[] = $responseD;
}




header('Content-Type: application/json');
echo json_encode($response);
