<?php
include 'connection.php';
$mobi = $_SESSION['Mobile_No'];
$west = "SELECT * FROM `employeedata`  WHERE MobileNo=$mobi";
$rest = $con->query($west);
while ($roww = $rest->fetch_assoc()) {
    $EMPID = $roww['ID'];
}
$fsw = 0;
$wet = "SELECT * FROM `subtask` WHERE empid=$EMPID";
$dsf = $con->query($wet);
while ($gs = $dsf->fetch_assoc()) {
    if ($gs['status'] == $statustext) {
        $fsw++;
    }
}
?>