<?php
include '../connection.php';
$query = "SELECT * FROM `project_priority`";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($optionData = $result->fetch_assoc()) {
        $response[] = $optionData;
    }
} else {
    $response = array();
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
