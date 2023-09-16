<?php
include 'connection.php';
$Admin_id = $_POST['adminID'];

$projectCountQuery = mysqli_query($con, "SELECT COUNT(*) AS `ProjectsCount` FROM `projectdata` WHERE `Admin_emp_id` = $Admin_id");
$row = mysqli_fetch_array($projectCountQuery);
$ProjectsCount = $row['ProjectsCount'];

$EmpCountQuery = mysqli_query($con, "SELECT COUNT(*) AS `EmployeesCount` FROM `employeedata` WHERE `isAdmin`=0");
$row = mysqli_fetch_array($EmpCountQuery);
$totEmpCount = $row['EmployeesCount'];

$TaskCountQuery = mysqli_query($con, "SELECT COUNT(*) AS `TasksCount` FROM `taskdata`");
$row = mysqli_fetch_array($TaskCountQuery);
$TasksCount = $row['TasksCount'];

$IssueCountQuery = mysqli_query($con, "SELECT COUNT(*) AS `SubtasksIssueCount` FROM `subtask` WHERE `Category`='1'");
$row = mysqli_fetch_array($IssueCountQuery);
$IssuesCount = $row['SubtasksIssueCount'];

$response = array(
    "ProjectsCount" => $ProjectsCount,
    "EmployeesCount" => $totEmpCount,
    "TasksCount" => $TasksCount,
    "IssuesCount" => $IssuesCount,
);

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
