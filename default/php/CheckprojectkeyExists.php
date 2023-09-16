<?php
include 'connection.php';


$enteredprojkey = $_POST['ProjKey'];

$queryToCheckprojkeyExist = mysqli_query($con, "SELECT * FROM `projectdata` WHERE `ProjectKey` = '$enteredprojkey'");

if (mysqli_num_rows($queryToCheckprojkeyExist) > 0) {
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
