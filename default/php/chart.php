<?php
include 'connection.php';
session_start();
$Admin_id = $_SESSION['Admin_id'];

$data = array();
$wet = "SELECT pd.ProjectName,
SUM(CASE WHEN st.Status = 4 THEN 1 ELSE 0 END) AS TotalCompletedSubtasks,
SUM(CASE WHEN st.Status <> 4 THEN 1 ELSE 0 END) AS TotalIncompleteSubtasks
FROM projectdata pd
JOIN taskdata td ON pd.SrNo = td.project_id
JOIN subtask st ON td.id = st.task_id
WHERE pd.Admin_emp_id = $Admin_id
GROUP BY pd.ProjectName;

";
$result = mysqli_query($con, $wet);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
header('content-Type:application/json');
echo json_encode($data);
