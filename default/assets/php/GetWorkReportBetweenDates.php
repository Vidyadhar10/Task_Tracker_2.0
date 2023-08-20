<?php

include './connection.php';



$empID = $_POST['empID'];
$FromDT = $_POST['FromDT'];
$ToDT = $_POST['ToDT'];

if (isset($_POST['prjID'])) {
    $prjID = $_POST['prjID'];
    $GetReportBetweenDates = mysqli_query($con, "SELECT * FROM `time_sheet`
    WHERE DATE(`time_sheet`.`Time_Sheet_Entry`) BETWEEN '$FromDT' AND '$ToDT'
    AND `EmployeeID`='$empID' AND `Project_ID`='$prjID'");
    while ($row = $GetReportBetweenDates->fetch_assoc()) {
        $response[] = $row;
    }
} else {

    $GetReportBetweenDates = mysqli_query($con, "SELECT * FROM `time_sheet`
    WHERE DATE(`time_sheet`.`Time_Sheet_Entry`) BETWEEN '$FromDT' AND '$ToDT'
    AND `EmployeeID`='$empID'");
    while ($row = $GetReportBetweenDates->fetch_assoc()) {
        $response[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
