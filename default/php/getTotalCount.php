<?php
include 'connection.php';
$Admin_id = $_SESSION['Admin_id'];
$cnt = 0;
$wet = "SELECT * FROM `taskdata` inner join `projectdata` on projectdata.SrNo=taskdata.Project_id inner join `subtask` on taskdata.id=subtask.Task_id where FIND_IN_SET($Admin_id, REPLACE(projectdata.Admin_emp_id, ';', ',')) > 0 and subtask.Task_id='$t_id'";
$dsf = $con->query($wet);
while ($gst = $dsf->fetch_assoc()) {
    if ($gst['status'] == $statustext) {
        $cnt++;
    }
}
?>