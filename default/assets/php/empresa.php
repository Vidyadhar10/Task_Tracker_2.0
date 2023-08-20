<?php
    include 'connection.php';
    $sql = "SELECT * FROM `employeedata`";
    $result = $con->query($sql);
    if(!$result){
        die("Invalid query:".$con->error);
    }
    while($row = $result->fetch_assoc()){
        echo "<tr class='text-center'>
            <th scope=`row`><a href=`#`>#" . $row["ID"] . "</a></th>
            <td>" . $row["EmpName"] . "</td>
            <td><a href=`#` class=`text-primary`>" . $row["Position"] . "</a></td>   
            <td>" . $row["totalTasks"] ."</td>         
            <td class='text-center'><input type='checkbox' name='assignEmp[]' value=". $row["ID"] ."></td>
            </tr>";
    }
?>
