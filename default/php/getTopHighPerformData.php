<?php
include './connection.php';


$projID = $_POST['projID'];
$projStart = $_POST['projStart'];
$projEnd = $_POST['projEnd'];

$sqlEmpOnProj = "SELECT * FROM `employeedata`
INNER JOIN `empwork`
ON `empwork`.`Emp_ID`=`employeedata`.`ID`
WHERE `empwork`.`Project_ID` = '$projID'";
$EmpResult = $con->query($sqlEmpOnProj);

//1.Array for Employee names
$EmpArrayVar = array();
$EmpNames = array();
while ($row = $EmpResult->fetch_assoc()) {
    array_push($EmpArrayVar, $row["ID"]);
    $EmpNames[$row["ID"]] = $row["EmpName"];
}

//2.total ontime task of particular employees
$firstEmptyArray = array();
foreach ($EmpArrayVar as $row) {
    // To get OnTime Count
    $queryToGetDataBetween2 = mysqli_query($con, "SELECT * FROM `subtask`
    INNER JOIN `taskdata` ON `subtask`.`Task_id` = `taskdata`.`id`
    WHERE DATE(`subtask`.`Created_Date`) BETWEEN '$projStart' AND '$projEnd'
    AND STR_TO_DATE(`subtask`.`StageChangedOn`, '%Y-%m-%d %H:%i') = STR_TO_DATE(`subtask`.`subtaskDue`, '%Y-%m-%d %H:%i')
    AND `subtask`.`status` = 4
    AND `subtask`.`empid` = $row
    AND `taskdata`.`Project_id` = '$projID'");

    $rowCountOnTime = mysqli_num_rows($queryToGetDataBetween2);
    $firstEmptyArray[$row] = $rowCountOnTime;
}

//3.total beforetime task of particular employees
$SecondEmptyArray = array();
foreach ($EmpArrayVar as $row) {
    // To get BeforeTime Count
    $queryToGetDataBetween2 = mysqli_query($con, "SELECT * FROM `subtask`
    INNER JOIN `taskdata` ON `subtask`.`Task_id` = `taskdata`.`id`
    WHERE DATE(`subtask`.`Created_Date`) BETWEEN '$projStart' AND '$projEnd'
    AND STR_TO_DATE(`subtask`.`StageChangedOn`, '%Y-%m-%d %H:%i') < STR_TO_DATE(`subtask`.`subtaskDue`, '%Y-%m-%d %H:%i')
    AND `subtask`.`status` = 4
    AND `subtask`.`empid` = $row
    AND `taskdata`.`Project_id` = '$projID'");

    $rowCountBeforeTime = mysqli_num_rows($queryToGetDataBetween2);
    $SecondEmptyArray[$row] = $rowCountBeforeTime;
}

//4.sum of ontime before time
$sumArray = array();

// Compare and update the second array
foreach ($firstEmptyArray as $key => $value) {
    if (isset($SecondEmptyArray[$key])) {
        $sumArray[$key] = $SecondEmptyArray[$key] + $value;
    }
}
//5.Array to count total subtasks of employee
$totalSubtasksofemps = array();
foreach ($EmpArrayVar as $row) {

    //query to get Sub-task Count
    $queryToGetSubTaskCount = mysqli_query($con, "SELECT * FROM `taskdata`
    INNER JOIN `subtask` ON `taskdata`.`id` = `subtask`.`Task_id`
    WHERE `taskdata`.`Project_id` = '$projID'
    AND `subtask`.`empid` = $row");
    $subtaskCount = mysqli_num_rows($queryToGetSubTaskCount);

    $totalSubtasksofemps[$row] = $subtaskCount;
}

$AfterTimeArray = array();
// 6.array to check percentage below 80 % 
$resultforTopLow = array();

foreach ($sumArray as $key => $value1) {
    if (isset($totalSubtasksofemps[$key])) {
        $value2 = $totalSubtasksofemps[$key];
        if ($value2 != 0) {

            $percentage = ($value1 / $value2) * 100;
            if ($percentage < 80) {
                $resultforTopLow[$key] = $percentage;
            }
        }

        $AfterTimeTasks = $value2 - $value1;
        $AfterTimeArray[$key] = $AfterTimeTasks;
    }
}

$finalArrayforTopLow = array();

foreach ($resultforTopLow as $key => $value) {
    $finalArrayforTopLow[] = array(
        "ID" => $key,
        "EmpNm" => $EmpNames[$key],
        "TotalSubtasks" => $totalSubtasksofemps[$key],
        "OnTimeTasks" => $firstEmptyArray[$key],
        "BeforeTimeTasks" => $SecondEmptyArray[$key],
        "sum" => $sumArray[$key],
        "percentage" => $resultforTopLow[$key],
        "AfterTimeTasks" => $AfterTimeArray[$key],


    );
}

// 7.array to check percentage  80 % and above
$resultforTopHigh = array();

foreach ($sumArray as $key => $value1) {
    if (isset($totalSubtasksofemps[$key])) {
        $value2 = $totalSubtasksofemps[$key];
        if ($value2 != 0) {

            $percentage = ($value1 / $value2) * 100;
            if ($percentage >= 80) {
                $resultforTopHigh[$key] = $percentage;
            }
        }

        $AfterTimeTasks = $value2 - $value1;
        $AfterTimeArray[$key] = $AfterTimeTasks;
    }
}

$finalArrayforTopHigh = array();

foreach ($resultforTopHigh as $key => $value) {
    $finalArrayforTopHigh[] = array(
        "ID" => $key,
        "EmpNm" => $EmpNames[$key],
        "TotalSubtasks" => $totalSubtasksofemps[$key],
        "OnTimeTasks" => $firstEmptyArray[$key],
        "BeforeTimeTasks" => $SecondEmptyArray[$key],
        "sum" => $sumArray[$key],
        "percentage" => $resultforTopHigh[$key],
        "AfterTimeTasks" => $AfterTimeArray[$key],


    );
}

$response = array(
    "TopLow" => $finalArrayforTopLow,
    "TopHigh" => $finalArrayforTopHigh
);

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($con);
