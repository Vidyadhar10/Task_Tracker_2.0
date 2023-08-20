<?php
session_start();
include './connection.php';
$project_id = $_SESSION["p_id"];

$data = array();
if (isset($_POST['GoalID'])) {
    $goalidd = $_POST['GoalID'];
    $wet = "SELECT * FROM `roadmap` WHERE `project_id`='$project_id' AND `goal_id` = '$goalidd'";
} else {
    $wet = "SELECT * FROM `roadmap` WHERE `project_id`='$project_id'";
}
$result = mysqli_query($con, $wet);
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    if (empty($row)) {
        // If there are no results, return a JSON object with a message
        $data = array('message' => 'No roadmap found');
    } else {
        $data[] = $row;
    }
}
header('content-Type:application/json');
echo json_encode($data);
