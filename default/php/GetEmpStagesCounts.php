<?php
include 'connection.php';

$eid = $_POST['employeeID'];
$query = mysqli_query($con, "SELECT
s.stages AS StageName,
SUM(CASE WHEN sub.status IS NOT NULL THEN 1 ELSE 0 END) AS Count
FROM subtask_stages AS s
LEFT JOIN subtask AS sub ON s.id = sub.status AND sub.empid = '$eid'
GROUP BY s.stages
ORDER BY s.id;");
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
