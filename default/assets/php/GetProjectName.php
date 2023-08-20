<?php
include 'connection.php';

$employeeID = $_POST['EmpsID'];

$QueryAssignee = "SELECT * FROM `subtask` WHERE `empid`='$employeeID'";
$AssigneeQuery = $con->query($QueryAssignee);
while ($AssigneeQueryOutput = $AssigneeQuery->fetch_assoc()) {
    $response[] = $AssigneeQueryOutput['Task_id'];
}
$taskIDArray = array_unique($response);
$projNameArray = array();
$visitedProjects = array();

foreach ($taskIDArray as $taskID) {
    $projNameQuery = mysqli_query($con, "SELECT * FROM `taskdata` WHERE `id`='$taskID'");
    $row2 = mysqli_fetch_assoc($projNameQuery);

    $projKey = $row2['Project_name'] . '_' . $row2['Project_id'];

    // Check if the project has already been added
    if (!in_array($projKey, $visitedProjects)) {
        $projNameArray[] = array(
            "projnm" => $row2['Project_name'],
            "projid" => $row2['Project_id'],
        );
        $visitedProjects[] = $projKey;
    }
}

header('Content-Type: application/json');
echo json_encode($projNameArray);
mysqli_close($con);
