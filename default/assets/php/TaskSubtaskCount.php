
<?php
include 'connection.php';

$ProjectID = $_POST['ProjectID'];
//query to get Task Count
$queryToGetTaskCount = mysqli_query($con, "SELECT * FROM `taskdata`
WHERE `taskdata`.`Project_id` = '$ProjectID'");
$taskCount = mysqli_num_rows($queryToGetTaskCount);

//query to get Sub-task Count
$queryToGetSubTaskCount = mysqli_query($con, "SELECT * FROM `taskdata`
INNER JOIN `subtask` ON `taskdata`.`id` = `subtask`.`Task_id`
WHERE `taskdata`.`Project_id` = '$ProjectID'");
$subtaskCount = mysqli_num_rows($queryToGetSubTaskCount);

$response = array(
    "success" => true,
    "TotalTasks" => $taskCount,
    "Totalsubtasks" => $subtaskCount
);

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
?>
