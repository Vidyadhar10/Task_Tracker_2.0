<?php
    include 'connection.php';
    $sqlForID = "SELECT * FROM projectdata";
    $resultIDRow = $con->query($sqlForID);
    while ($rowValue = $resultIDRow->fetch_assoc()) {
        $output=$rowValue['SrNo'];
    }
    echo $output;
?>