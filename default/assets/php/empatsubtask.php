<?php
include 'connection.php';
$p_id = $_SESSION['p_id'];
$sql = "SELECT * FROM `employeedata` inner join `empwork` on empwork.Emp_ID=employeedata.ID where empwork.Project_ID= $p_id";
// $q = "SELECT * FROM `employeedata`";
$result = $con->query($sql);
if (!$result) {
    die("Invalid query:" . $con->error);
}
while ($row = $result->fetch_assoc()) {
    echo "<option value=". $row["ID"] .">" . $row["EmpName"] . "</option>";
}
?>
