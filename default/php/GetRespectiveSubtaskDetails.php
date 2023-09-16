<?php
include 'connection.php';
$sid = $_POST['rowID'];
$query = mysqli_query($con, "SELECT * from subtask where subtask_ID = '$sid'");
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
