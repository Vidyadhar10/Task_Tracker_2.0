<?php
include 'connection.php';
$tid = $_POST['tid'];
$query = mysqli_query($con, "SELECT td.*, em.EmpName, tpr.Tasks_Priority AS priorityOfTask FROM taskdata AS td
INNER JOIN employeedata AS em
ON td.CreatedBy = em.ID
INNER JOIN tasks_priority as tpr
ON tpr.ID = td.Task_priority
WHERE td.ID = '$tid'");
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
