<?php
include 'connection.php';
$goal_id = $_POST['goal_id'];

$UpdateQuery = mysqli_query($con, "UPDATE `roadmap` SET `achived` = '1' WHERE `goal_id` ='$goal_id'");

if ($UpdateQuery) {
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
