<?php
include 'connection.php';
session_start();
$mob = $_SESSION['Mobile_No'];
$targetFilePath = "";
$q = "UPDATE `employeedata` SET `ProfilePhoto`='$targetFilePath' WHERE `MobileNo`=$mob";
if (mysqli_query($con, $q)) {
    header("location:../../users-profile.php");
} else {
    echo "ERROR: Could not able to execute $q. " . mysqli_error($con);
}
mysqli_close($con);
echo "success";
?>