<?php
require "connection.php";
$sql = "SELECT * FROM `taskdata` inner join `projectdata` on projectdata.SrNo=taskdata.Project_id inner join subtask on taskdata.id=subtask.Task_id";
$result = $con->query($sql);
if (!$result) {
    die("Invalid query:" . $con->error);
}
while ($row = $result->fetch_assoc()) {
    echo "<tr>            
            <td>" . $row["SrNo"] . "</td>
            <td>" . $row["ProjectName"] . "</td>
            <td>" . $row["id"] . "</td>
            <td>" . $row["Task_name"] . "</td>
            <td>" . $row["subtask_ID"] . "</td>
            <td>" . $row["subtaskname"] . "</td>
            <td>" . $row["subtaskDue"] . "</td>
            <td>" . $row["empid"] . "</td>
            </tr>";
}
?>