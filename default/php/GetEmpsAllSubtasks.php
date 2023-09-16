<?php
include 'connection.php';

$eid = $_POST['employeeID'];
$query = mysqli_query($con, "SELECT sub.*,
emp1.EmpName AS AssigneeName, emp1.ProfilePhoto AS ProfileImageOfAssignee,
emp2.EmpName AS ReporterName, emp2.ProfilePhoto AS ProfileImageOfReporter,
emp3.EmpName AS CreatedByName, emp3.ProfilePhoto AS ProfileImageOfCreatedBy,
subPri.Sub_Priority AS SubTasksPriority,
subStage.stages AS Subtasks_Stage_status,
COUNT(CASE WHEN sub.status = 1 THEN 1 ELSE NULL END) AS BacklogCount,
COUNT(CASE WHEN sub.status = 2 THEN 1 ELSE NULL END) AS InProgressCount,
COUNT(CASE WHEN sub.status = 3 THEN 1 ELSE NULL END) AS TestingCount,
COUNT(CASE WHEN sub.status = 4 THEN 1 ELSE NULL END) AS CompletedCount,
pdt.ProjectName
FROM subtask AS sub
INNER JOIN taskdata AS tdt
ON sub.Task_id = tdt.id
INNER JOIN projectdata AS pdt
ON pdt.SrNo = tdt.Project_id
LEFT JOIN employeedata AS emp1 ON sub.empid = emp1.ID
LEFT JOIN employeedata AS emp2 ON sub.Reporter = emp2.ID
LEFT JOIN employeedata AS emp3 ON sub.`Created_By` = emp3.ID
INNER JOIN subtask_priority as subPri ON subPri.ID = sub.subtaskpriority
INNER JOIN subtask_stages AS subStage ON subStage.id = sub.status
WHERE sub.empid = '$eid'
GROUP BY sub.subtask_ID;");
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response = array(
        "No record found",
    );
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
