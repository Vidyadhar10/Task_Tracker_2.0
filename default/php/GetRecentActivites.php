<?php
include 'connection.php';
$query = mysqli_query($con, "SELECT * from recent_activity order by ID desc Limit 10");
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
