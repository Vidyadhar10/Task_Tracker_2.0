<?php
include 'connection.php';
session_start();

$headgoal = $_POST['goalHead'];
$goalDate = $_POST['goalDate'];
$goalDescription = $_POST['goalDescrip'];
$project_id = $_POST['projectid'];

$sql = "INSERT INTO `roadmap` (`project_id`, `goalDate`, `goal_head`, `goal_description`) VALUES ('$project_id', '$goalDate', '$headgoal', '$goalDescription')";
if (mysqli_query($con, $sql)) {
    $response = array(
        "success" => true
    );
} else {
    $response = array(
        "success" => false
    );
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);


?>