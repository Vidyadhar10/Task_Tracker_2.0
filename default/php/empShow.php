<?php
    include 'connection.php';
    $sql = "SELECT * FROM `employeedata`";
    $result = $con->query($sql);
    if(!$result){
        die("Invalid query:".$con->error);
    }
    while($row = $result->fetch_assoc()){
        echo "<tr>
            <th scope=`row`><a href=`#`>#" . $row["ID"] . "</a></th>
            <td>" . $row["EmpName"] . "</td>
            <td><a href=`#` class=`text-primary`>" . $row["Position"] . "</a></td>            
            <td><span class=`badge bg-success`>Assigned</span></td>
            </tr>";
    }
?>