<?php

session_start();
include 'connection.php';

$EMPID = $_SESSION['UserID'];


$getProjects = mysqli_query($con, "SELECT
pd.ProjectName, pd.SrNo, pd.Start_Date, pd.End_Date, pd.ProjectLogo, pd.Admin_emp_id, pd.Created_Date,
emid.EmpName,
pp.*,
(
    SELECT COUNT(*)
    FROM `taskdata` AS td
    INNER JOIN `subtask` AS st ON td.`id` = st.`Task_id`
    WHERE td.`Project_id` = pd.`SrNo`
) AS subtaskCount,
(
    SELECT COUNT(*)
    FROM `taskdata` AS td
    INNER JOIN `subtask` AS st ON td.`id` = st.`Task_id`
    WHERE td.`Project_id` = pd.`SrNo` AND st.`status` = 4
) AS subtaskCompletedCount,
(
    SELECT COUNT(*)
    FROM `taskdata` AS td WHERE
    td.`Project_id` = pd.`SrNo`
    ) AS totalTaskCount
FROM
`projectdata` AS pd
INNER JOIN
`employeedata` AS emid ON pd.`Admin_emp_id` = emid.`ID`
INNER JOIN
`project_priority` AS pp ON pp.`ID` = pd.`Priority`
WHERE
pd.`Admin_emp_id` = '$EMPID'
ORDER BY SrNo DESC");
while ($row = $getProjects->fetch_assoc()) {

    $response[] = $row;
}
header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
