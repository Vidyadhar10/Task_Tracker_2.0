<?php
include 'connection.php';
$mobi = $_SESSION['Mobile_No'];
$west = "SELECT * FROM `employeedata` WHERE MobileNo=$mobi";
$rest = $con->query($west);
while ($roww = $rest->fetch_assoc()) {
    $EMPID = $roww['ID'];
}
$fsw = 0;
$wet = "SELECT * FROM `subtask` WHERE empid=$EMPID";
$dsf = $con->query($wet);
while ($gs = $dsf->fetch_assoc()) {
    $trStatus = $subtaskStages[$i]['id'];
    if ($gs['status'] == $trStatus) {
        $fsw++;
        $y = $gs['subtask_ID'];
        $sql2 = "SELECT * FROM `taskdata` inner join `projectdata` on projectdata.SrNo=taskdata.Project_id inner join subtask on taskdata.id=subtask.Task_id where subtask_ID= $y";
        $result2 = $con->query($sql2);
        while ($newq = $result2->fetch_assoc()) {
            $prname = $newq['Project_name'];
        }
        echo "<tr>
        <td><a href='emptask.php?tos=" . $gs['subtask_ID'] . "' </a>" . $gs["subtaskname"] . "</td> 
        <td>$prname</td>";
        $subtaskPriority=$gs['subtaskpriority'];
        $ShowPriority = mysqli_query($con,"SELECT * FROM `subtask_priority` WHERE ID='$subtaskPriority'");
                                while($priority=$ShowPriority->fetch_assoc()){
                                  $DisplayPriority=$priority['Sub_Priority'];
                                }
        if ($DisplayPriority == 'Low') {
            echo "<td>
            <span class='badge bg-success'> $DisplayPriority </span>
        </td>";
        } else if ($DisplayPriority == 'Medium') {
            echo "<td>
            <span class='badge bg-warning'> $DisplayPriority </span>
        </td>";
        } else {
            echo "<td>
            <span class='badge bg-danger'> $DisplayPriority </span>
        </td>";
        }
        $p = $gs['subtask_ID'];
          //Query for Allocated By
        $Allocated = $gs['Created By'];
        $QueryForAllocation = "SELECT * FROM `employeedata` inner join `subtask` on `subtask`.`Created By`=`employeedata`.`ID` WHERE `Created By`='$Allocated'";
        $executeQueryAllocated = $con->query($QueryForAllocation);
        while ($QueryOutputAllocated = $executeQueryAllocated->fetch_assoc()) {
            $AllocatedByName = $QueryOutputAllocated['EmpName'];
        }
        echo "<td>$AllocatedByName</td>";
        echo " <td>" . date("d-m-Y", strtotime($gs["subtaskDue"])) . "</td> ";
        echo "</tr> ";
    }
}
?>