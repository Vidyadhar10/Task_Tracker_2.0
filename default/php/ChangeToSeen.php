<?php
include 'connection.php';

$idv = $_POST['NotifID'];
if (isset($_POST['readall']) && isset($_POST['seen'])) {

    $sqlForUpdate = mysqli_query($con, "UPDATE `notifications` SET `seen` = '1' WHERE `notifications`.`seen` = 0");
    if ($sqlForUpdate) {
        $response = array(
            "success" => true,
        );
    } else {
        $response = array(
            "success" => false,
        );
    }
} else {
    $sqlForUpdate = mysqli_query($con, "UPDATE `notifications` SET `seen` = '1' WHERE `notifications`.`ID` = '$idv'");
    if ($sqlForUpdate) {
        $response = array(
            "success" => true,
        );
    } else {
        $response = array(
            "success" => false,
        );
    }
}
header('Content-Type: application/json');
echo json_encode($response);
