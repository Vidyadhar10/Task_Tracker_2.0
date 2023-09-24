<?php
session_start();

include 'connection.php';


$pid = $_POST['pid'];
$employeesSelected = $_POST['employeesSelected'];
$string = implode(',', $employeesSelected);
$UpdateQuery = mysqli_query($con, "UPDATE `projectdata`
SET `assigned_emp` = '$string'
WHERE `SrNo` ='$pid'");

$my_array = $employeesSelected;
$ytc = [];
$empAr = [];

for ($i = 0; $i < count($my_array); $i++) {
    array_push($ytc, (int) $my_array[$i]);
    $queryToCheck = mysqli_query($con, "DELETE FROM `empwork` WHERE `Project_ID`='$pid'");
}
for ($j = 0; $j < count($my_array); $j++) {
    array_push($empAr, (int) $my_array[$j]);
    $swq = "INSERT INTO `empwork` (`Emp_ID`,`Project_ID`,`Subtask_ID`) VALUES ('$empAr[$j]','$pid','0')";
    mysqli_query($con, $swq);
}


$getProjNm = mysqli_query($con, "SELECT ProjectName from projectdata where SrNo = $pid");
$row = mysqli_fetch_assoc($getProjNm);
$pnm = $row['ProjectName'];


if ($UpdateQuery) {

    $Activity_Title = "Project employees updated";
    $Activity_Text = mysqli_real_escape_string($con, "Employees are updated to project <span class='text-success'>$pnm</span>");
    $Activity_Icon = mysqli_real_escape_string($con, "ri-refresh-line");

    $Activity_By = $_SESSION['Admin_id'];

    $InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `ProjectID`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$pid')");
    if ($InsertInNotifi) {
        $response = array(
            "success" => true,
        );
    }
} else {
    $response = array(
        "success" => false,
    );
}
header('Content-Type: application/json');
echo json_encode($response);
