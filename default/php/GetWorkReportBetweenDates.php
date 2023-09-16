<?php

include './connection.php';



$empID = $_POST['empID'];
$FromDT = $_POST['FromDT'];
$ToDT = $_POST['ToDT'];

if (isset($_POST['prjID'])) {
    $prjID = $_POST['prjID'];
    $GetReportBetweenDates = mysqli_query($con, "SELECT ts.*, pd.ProjectName, sb.subtaskname
    FROM `time_sheet` AS ts
    INNER JOIN projectdata AS pd
    ON pd.SrNo = ts.Project_ID
    INNER JOIN subtask AS sb
    ON sb.subtask_ID = ts.Subtask_ID
    WHERE DATE(`ts`.`Time_Sheet_Entry`)
    BETWEEN '$FromDT' AND '$ToDT'
    AND ts.`EmployeeID`='$empID'
    AND ts.`Project_ID`='$prjID'");
    if (mysqli_num_rows($GetReportBetweenDates) > 0) {

        while ($row = $GetReportBetweenDates->fetch_assoc()) {
            $response[] = $row;
        }
    } else {
        $response = array();
    }
} else {

    $GetReportBetweenDates = mysqli_query($con, "SELECT ts.*, pd.ProjectName, sb.subtaskname
    FROM `time_sheet` AS ts
    INNER JOIN projectdata AS pd
    ON pd.SrNo = ts.Project_ID
    INNER JOIN subtask AS sb
    ON sb.subtask_ID = ts.Subtask_ID
    WHERE DATE(ts.`Time_Sheet_Entry`)
    BETWEEN '$FromDT' AND '$ToDT'
    AND ts.`EmployeeID`='$empID'");
    while ($row = $GetReportBetweenDates->fetch_assoc()) {
        $response[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
