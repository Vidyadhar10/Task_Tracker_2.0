<?php

session_start();
include 'connection.php';
$p_id = $_POST['ProjIDToUpdate'];
$projKey = $_POST['inputProjKey'];
$projNm = $_POST['inputProjName'];
$mobileNumber = $_SESSION['Mobile_No'];

$resID = mysqli_query($con, "SELECT * FROM `employeedata` WHERE `MobileNo` = '$mobileNumber'");

while ($row = $resID->fetch_assoc()) {
    $UpdaterEmpID = $row['ID'];
    $UpdaterEmpName = $row['EmpName'];
}

$checkbox1 = implode(';', $_POST['selectedEmpIDs']);
$ResultQuery = mysqli_query($con, "UPDATE `projectdata` SET `assigned_emp`='$checkbox1' WHERE `SrNo`='$p_id'");
$my_array = explode(";", $checkbox1);
$ytc = [];
$empAr = [];

for ($i = 0; $i < count($my_array); $i++) {
    array_push($ytc, (int) $my_array[$i]);
    $queryToCheck = mysqli_query($con, "DELETE FROM `empwork` WHERE `Project_ID`='$p_id'");
}
for ($j = 0; $j < count($my_array); $j++) {
    array_push($empAr, (int) $my_array[$j]);
    $swq = "INSERT INTO `empwork` (`Emp_ID`,`Project_ID`,`Subtask_ID`) VALUES ('$empAr[$j]','$p_id','0')";
    mysqli_query($con, $swq);
}

if ($ResultQuery) {

    $Activity_Title = "Project employees updated";
    $Activity_Text = mysqli_real_escape_string($con, "Employees are updated to project <span class='text-success'>$projNm</span> by <span class='text-success'>$UpdaterEmpName</span>");
    $Activity_Icon = mysqli_real_escape_string($con, "<i class='bi bi-person-check text-success'></i>");
    $Activity_By = $UpdaterEmpID;

    $InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `ProjectName`, `ProjectID`,`ProjectKey`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$projNm', '$p_id', '$projKey')");
    if ($InsertInNotifi) {
        $response = array(
            "success" => true,
        );
    }
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
