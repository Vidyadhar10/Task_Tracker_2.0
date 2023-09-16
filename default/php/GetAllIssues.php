<?php
include 'connection.php';
$sql = "SELECT sb.*, pd.ProjectName, td.Task_name FROM `subtask` AS sb
INNER JOIN taskdata AS td on sb.Task_id = td.id
INNER JOIN projectdata AS pd on td.Project_id = pd.SrNo
WHERE sb.Category = 1";
$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}
header('Content-Type: application/json');
echo json_encode($response);
