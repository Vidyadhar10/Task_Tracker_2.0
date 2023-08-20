<?php

session_start();
include 'connection.php';

$EMPID = $_SESSION['UserID'];


$getProjects = mysqli_query($con, "SELECT pd.*, emid.EmpName, pp.* from `projectdata` as pd Inner join employeedata as emid on pd.Admin_emp_id = emid.ID inner join project_priority as pp on pp.ID = pd.Priority where `Admin_emp_id`='$EMPID'");
while ($row = $getProjects->fetch_assoc()) {

    $pid = $row['SrNo'];

    //query to get Sub-task Count
    $queryToGetSubTaskCount = mysqli_query($con, "SELECT * FROM `taskdata`
    INNER JOIN `subtask` ON `taskdata`.`id` = `subtask`.`Task_id`
    WHERE `taskdata`.`Project_id` = '$pid'");
    $subtaskCount = mysqli_num_rows($queryToGetSubTaskCount);

    //getCompletedCount
    $queryToGetCompletedSubTaskCount = mysqli_query($con, "SELECT * FROM `taskdata`
    INNER JOIN `subtask` ON `taskdata`.`id` = `subtask`.`Task_id`
    WHERE `taskdata`.`Project_id` = '$pid' AND `subtask`.`status` = 4");
    $subtaskCompletedCount = mysqli_num_rows($queryToGetCompletedSubTaskCount);

    $row['subtaskCount'] = $subtaskCount;
    $row['subtaskCompletedCount'] = $subtaskCompletedCount;
    $response[] = $row;
}
header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
