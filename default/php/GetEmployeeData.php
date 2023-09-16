<?php
include 'connection.php';
$eid = $_POST['empid'];
$query = mysqli_query($con, "SELECT * from employeedata where ID = '$eid'");
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
