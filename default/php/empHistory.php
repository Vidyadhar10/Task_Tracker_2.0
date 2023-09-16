<?php
include 'connection.php';
$EMPID = $id;
$sq = "SELECT * FROM `subtask`";
$res = $con->query($sq);
$ytc = array();
if (!$res) {
    die("Invalid query:" . $con->error);
}
while ($ro = $res->fetch_assoc()) {
    if (mysqli_num_rows($res) > 0) {
        $my_array = explode(";", $ro['empid']);
        for ($i = 0; $i < count($my_array); $i++) {
            $intarry[$i] = (int) $my_array[$i];
            if ($intarry[$i] == $EMPID) {
                array_push($ytc, $ro['subtask_ID']);
            }
        }
    }
}
// echo count($ytc);
$fsw = 0;
for ($r = 0; $r < count($ytc); $r++) {
    $wet = "SELECT * FROM `subtask` WHERE `subtask_ID`=$ytc[$r]";
    $dsf = $con->query($wet);
    while ($gs = $dsf->fetch_assoc()) {
        $fsw++;
        $y = $gs['subtask_ID'];
        $sql2 = "SELECT * FROM `taskdata` inner join subtask on taskdata.id=subtask.Task_id where subtask_ID= $y";
        $result2 = $con->query($sql2);
        while ($newq = $result2->fetch_assoc()) {
            $prname = $newq['Project_name'];
            echo "<tr>
        <td scope='row'><a href='#'>$fsw </a></td>
        <td>" . $newq["Project_name"] . "</td>
        <td>" . $newq["Task_name"] . "</td> 
        <td>" . $newq["Task_status"] . "%</td> 
        <td>" . $gs["subtaskname"] . "</td>
        <td>" . $gs["status"] . "</td>";
            echo "
    </tr> ";
        }
    }
}
?>