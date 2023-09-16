<?php
include 'connection.php';
$sbid = $_POST['subid'];
$query = mysqli_query($con, "SELECT subt.*, pjdt.ProjectName, sp.*,
empObj1.EmpName as AssigneeName,
empObj1.ProfilePhoto AS ProfileImageOfAssignee,
empObj1.Position AS AssigneeDesignation,
empObj1.ID AS AssigneeID,

empObj2.EmpName as ReporterName,
empObj2.ProfilePhoto AS ProfileImageOfReporter,
empObj2.Position AS ReporterDesignation,
empObj2.ID AS ReporterID,

empObj3.EmpName as CreaterName,
empObj3.ProfilePhoto AS ProfileImageOfCreatedBy
FROM subtask AS subt
INNER JOIN subtask_priority AS sp
ON subt.subtaskpriority = sp.ID
INNER JOIN subtask_stages AS stg
ON subt.status = stg.id
INNER JOIN taskdata as tskd
ON subt.Task_id = tskd.id
INNER JOIN projectdata as pjdt
ON tskd.Project_id = pjdt.SrNo
LEFT JOIN employeedata AS empObj1 ON subt.empid = empObj1.ID
LEFT JOIN employeedata AS empObj2 ON subt.Reporter = empObj2.ID
LEFT JOIN employeedata AS empObj3 ON subt.`Created_By` = empObj3.ID
WHERE subt.subtask_ID = '$sbid'");
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
