<?php
$catagories = array();
include 'connection.php';
$q = "SELECT * FROM `subtask_stages`";
$result2 = $con->query($q);
$subtaskStages = array();
$incr = 1;
while ($row = $result2->fetch_assoc()) {
    $subtaskStages[$incr] = array(
        'id' => $row['id'],
        'name' => $row['stages'],
    );
    $incr++;
}
?>