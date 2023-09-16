<?php
include 'connection.php';
$eid = $_POST['empid'];
$query = mysqli_query($con, "SELECT * FROM subtask AS subt
INNER JOIN subtask_priority AS sp
ON subt.subtaskpriority = sp.ID
INNER JOIN subtask_stages AS stg
ON subt.status = stg.id
WHERE empid = '$eid'");
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response = array();
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
