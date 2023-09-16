<?php
// session_start();
include 'connection.php';
$sql = "SELECT * FROM `employeedata` WHERE `isAdmin`=0";
$result = $con->query($sql);
if (!$result) {
    die("Invalid query:" . $con->error);
}
// $invalidFeed="required";
while ($row = $result->fetch_assoc()) {
    echo "<tr class='text-center'>
            <td><a href='users-profile-adminPage.php?id=" . $row["ID"] . "' class=`text-primary` target='blank'>" . $row["EmpName"] . "</a></td>
            <td>" . $row["Position"] . "</td>";
    $q = "SELECT * FROM `empwork` WHERE Emp_ID=" . $row["ID"] . "";
    $r = $con->query($q);
    if (mysqli_num_rows($r) == 0) {
        echo "<td>Unassigned</td>";
    } else {
        echo "<td>Assigned</td>";
    }
    $t=0;
    if (isset($_SESSION['EmployeeArray'])) {
        $EmpArrayVar = $_SESSION['EmployeeArray'];
        for ($i = 0; $i < count($EmpArrayVar); $i++) {
                if ($row["ID"] == $EmpArrayVar[$i]) {
                    $t=1;
                }
        }
        if ($t==1) {
            echo "<td class='text-center'><input  type='checkbox' class='form-check-input required_group' name='assignEmp[]' value=" . $row["ID"] . " checked>
            </td>
        </tr>";
        } else {
            echo "<td class='text-center'><input  type='checkbox' class='form-check-input required_group' name='assignEmp[]' value=" . $row["ID"] . " >
            </td>
        </tr>";
        }
    }
}
?>