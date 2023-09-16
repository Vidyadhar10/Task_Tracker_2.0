<?php
include 'connection.php';

$employeeID = $_POST['EmpsID'];

$QueryAssignee = "SELECT DISTINCT pd.ProjectName, pd.SrNo
FROM `subtask` s
INNER JOIN `taskdata` t ON s.Task_id = t.id
INNER JOIN `projectdata` pd ON t.Project_id = pd.SrNo
WHERE s.empid='$employeeID'";

$AssigneeQuery = $con->query($QueryAssignee);
$projNameArray = array();

while ($row = $AssigneeQuery->fetch_assoc()) {
    $projNameArray[] = array(
        "projnm" => $row['ProjectName'],
        "projid" => $row['SrNo'],
    );
}


header('Content-Type: application/json');
echo json_encode($projNameArray);
mysqli_close($con);
