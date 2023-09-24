<?php
include './connection.php';

$sid = $_POST['subtaskID'];
$eid = $_POST['empID'];
$queryForHistory = mysqli_query($con, "INSERT INTO assignee_history
                    SELECT * FROM subtask
                    WHERE `subtask_ID` = '$sid';");

if ($queryForHistory) {

    $query = mysqli_query($con, "UPDATE subtask
            SET `empid` = '$eid'
            WHERE `subtask_ID` = '$sid';");
    if ($query) {
        $response = array(
            "success" => true,
        );
    } else {
        $response = array(
            "success" => false,
        );
    }
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
