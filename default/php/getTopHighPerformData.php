<?php
include './connection.php';

$projID = $_POST['projID'];
$projStart = $_POST['projStart'];
$projEnd = $_POST['projEnd'];

$sql = "SELECT
    e.ID AS EmpID,
    e.EmpName,
    IFNULL(OnTimeTasks, 0) AS OnTimeTasks,
    IFNULL(BeforeTimeTasks, 0) AS BeforeTimeTasks,
    IFNULL(TaskTotal, 0) AS TotalTasks,
    IFNULL(TotalSubtasks, 0) AS TotalSubtasks
FROM employeedata e
LEFT JOIN (
    SELECT
        s.empid AS EmpID,
        COUNT(CASE
            WHEN DATE(s.Created_Date) BETWEEN '$projStart' AND '$projEnd'
            AND STR_TO_DATE(s.StageChangedOn, '%Y-%m-%d %H:%i') = STR_TO_DATE(s.subtaskDue, '%Y-%m-%d %H:%i') 
            AND s.status = 4 THEN 1
            ELSE NULL
        END) AS OnTimeTasks,
        COUNT(CASE
            WHEN DATE(s.Created_Date) BETWEEN '$projStart' AND '$projEnd'
            AND STR_TO_DATE(s.StageChangedOn, '%Y-%m-%d %H:%i') < STR_TO_DATE(s.subtaskDue, '%Y-%m-%d %H:%i') 
            AND s.status = 4 THEN 1
            ELSE NULL
        END) AS BeforeTimeTasks,
        COUNT(CASE
            WHEN s.status = 4 THEN 1
            ELSE NULL
        END) AS TaskTotal,
        COUNT(s.subtask_ID) AS TotalSubtasks
    FROM subtask s
    INNER JOIN taskdata t ON s.Task_id = t.id
    WHERE t.Project_id = '$projID'
    GROUP BY s.empid
) AS taskInfo ON e.ID = taskInfo.EmpID
WHERE e.ID IN (
    SELECT Emp_ID
    FROM empwork
    WHERE Project_ID = '$projID'
)";

$result = $con->query($sql);

$finalArray = array();
if (!$result) {
    die('Error: ' . mysqli_error($con));
}
while ($row = $result->fetch_assoc()) {
    $EmpID = $row["EmpID"];
    $perCount = $row["OnTimeTasks"] + $row['BeforeTimeTasks'];
    $finalArray[$EmpID] = array(
        "ID" => $EmpID,
        "EmpNm" => $row["EmpName"],
        "TotalSubtasks" => $row["TotalSubtasks"],
        "OnTimeTasks" => $row["OnTimeTasks"],
        "BeforeTimeTasks" => $row["BeforeTimeTasks"],
        "sum" => $row["OnTimeTasks"] + $row['BeforeTimeTasks'],
        "percentage" => ($row["TotalTasks"] != 0) ? ($perCount / $row["TotalTasks"]) * 100 : 0,
        "AfterTimeTasks" => $row["TotalSubtasks"] - $row["OnTimeTasks"] - $row['BeforeTimeTasks'],
    );
}

$response = array(
    "TopLow" => array_filter($finalArray, function ($item) {
        return $item["percentage"] < 80;
    }),
    "TopHigh" => array_filter($finalArray, function ($item) {
        return $item["percentage"] >= 80;
    })
);

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($con);
