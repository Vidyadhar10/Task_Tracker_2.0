<?php
include './connection.php';
$selectedValue = $_POST['SelectedValue'];
$employeeID = $_POST['EmpIDSel'];
$ProjectID = $_POST['ProjectID'];


// Determine the start and end dates based on the selected value
$endDate = date('Y-m-d'); // Current date
$startDate = date('Y-m-d', strtotime('-' . $selectedValue . ' days', strtotime($endDate)));

// To get AfterTime Count
$queryToGetDataBetween = mysqli_query($con, "SELECT * FROM `subtask`
INNER JOIN `taskdata` ON `subtask`.`Task_id` = `taskdata`.`id`
WHERE DATE(`subtask`.`Created Date`) BETWEEN '$startDate' AND '$endDate'
AND STR_TO_DATE(`subtask`.`StageChangedOn`, '%Y-%m-%d %H:%i') > STR_TO_DATE(`subtask`.`subtaskDue`, '%Y-%m-%d %H:%i')
AND `subtask`.`status` = 4
AND `subtask`.`empid` = '$employeeID'
AND `taskdata`.`Project_id` = '$ProjectID'");
$rowCountAfterTime = mysqli_num_rows($queryToGetDataBetween);

// To get OnTime Count
$queryToGetDataBetween2 = mysqli_query($con, "SELECT * FROM `subtask`
INNER JOIN `taskdata` ON `subtask`.`Task_id` = `taskdata`.`id`
WHERE DATE(`subtask`.`Created Date`) BETWEEN '$startDate' AND '$endDate'
AND STR_TO_DATE(`subtask`.`StageChangedOn`, '%Y-%m-%d %H:%i') = STR_TO_DATE(`subtask`.`subtaskDue`, '%Y-%m-%d %H:%i')
AND `subtask`.`status` = 4
AND `subtask`.`empid` = '$employeeID'
AND `taskdata`.`Project_id` = '$ProjectID'");
// mysqli_query($con, "SELECT * FROM `subtask` WHERE `Created Date` BETWEEN '$startDate' AND '$endDate' AND DATE(DATE_FORMAT(`StageChangedOn`, '%Y-%m-%d')) = DATE(DATE_FORMAT(`subtaskDue`, '%Y-%m-%d')) AND `status` = 4 AND `empid` = '$employeeID'");
$rowCountOnTime = mysqli_num_rows($queryToGetDataBetween2);

// To get BeforeTime Count
$queryToGetDataBetween3 = mysqli_query($con, "SELECT * FROM `subtask`
INNER JOIN `taskdata` ON `subtask`.`Task_id` = `taskdata`.`id`
WHERE DATE(`subtask`.`Created Date`) BETWEEN '$startDate' AND '$endDate'
AND STR_TO_DATE(`subtask`.`StageChangedOn`, '%Y-%m-%d %H:%i') < STR_TO_DATE(`subtask`.`subtaskDue`, '%Y-%m-%d %H:%i')
AND `subtask`.`status` = 4
AND `subtask`.`empid` = '$employeeID'
AND `taskdata`.`Project_id` = '$ProjectID'");
// mysqli_query($con, "SELECT * FROM `subtask` WHERE `Created Date` BETWEEN '$startDate' AND '$endDate' AND STR_TO_DATE(`StageChangedOn`, '%Y-%m-%d %H:%i') < STR_TO_DATE(`subtaskDue`, '%Y-%m-%d %H:%i') AND `status` = 4 AND `empid` = '$employeeID'");
$rowCountBeforeTime = mysqli_num_rows($queryToGetDataBetween3);

$responce = array(
    "After Time" => $rowCountAfterTime,
    "On Time" => $rowCountOnTime,
    "Before Time" => $rowCountBeforeTime,
);


header('Content-Type: application/json');
echo json_encode($responce);
mysqli_close($con);
