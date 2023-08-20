<?php
include "connection.php";
$rowID = $_POST['rowID'];

$sql = "DELETE FROM `time_sheet` WHERE `ID` = '$rowID'";
if (mysqli_query($con, $sql)) {
    $response = array(
        "success" => true
    );
}

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
