<?php
include 'connection.php';

$ProjectID = $_POST['projectid'];

$goalidDofachived = $_POST['markedasachived'];
$RoadmapID = $_POST['goalid'];

$headgoal = $_POST['goalHead'];
$goalDate = $_POST['goalDate'];
$goalDescription = $_POST['goalDescrip'];

if ($goalidDofachived == $RoadmapID) {
    $UpdateRMachievedQuery = mysqli_query($con, "UPDATE `roadmap` SET `goalDate`='$goalDate', `goal_head`='$headgoal', `goal_description`='$goalDescription', `achived` = 1 WHERE `project_id`='$ProjectID' AND `goal_id` = '$RoadmapID'");
} else {
    $UpdateRMachievedQuery = mysqli_query($con, "UPDATE `roadmap` SET `goalDate`='$goalDate', `goal_head`='$headgoal', `goal_description`='$goalDescription' WHERE `project_id`='$ProjectID' AND `goal_id` = '$RoadmapID'");
}


if ($UpdateRMachievedQuery) {
    $response = array(
        "success" => true,
    );
} else {
    $response = array(
        "success" => false,
    );
}

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
