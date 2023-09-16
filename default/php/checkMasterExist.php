<?php
include 'connection.php';


$checkMasterQuery = mysqli_query($con, "SELECT * FROM `subtask_stages`");

if (mysqli_num_rows($checkMasterQuery) > 0) {
    $response = array(
        "success" => true,
    );
} else {
    $response = array(
        "success" => false,
    );
}

header('Content-Type: application/json');
echo json_encode($response);
