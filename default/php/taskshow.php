<?php error_reporting(E_ALL); ?>

<?php
include 'connection.php';

$p_id = $_GET['PID'];

$sql = "SELECT * FROM `taskdata` AS `td`
INNER JOIN `tasks_priority` AS `tp`
ON `td`.`Task_priority` = `tp`.`ID`
INNER JOIN `employeedata` AS `epd`
ON `epd`.`ID` = `td`.`CreatedBy`
WHERE `Project_id`='$p_id'";
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = $result->fetch_assoc()) {
    $resultData[] = $row;
  }
} else {
  $resultData = array(
    "No Tasks Yet!"
  );
}

header('Content-Type: application/json');
echo json_encode($resultData);

?>