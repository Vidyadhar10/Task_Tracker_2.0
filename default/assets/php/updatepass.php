<?php
include 'connection.php';
session_start();
$mob = $_SESSION['Mobile_No'];
$cpasswor=$_POST['password'];
$cpassword=md5($cpasswor);
$nPassword=$_POST['newpassword'];
$confPassword=$_POST['renewpassword'];
$as=md5($nPassword);
if($nPassword==$confPassword){
    $q = "UPDATE `employeedata` SET `Password`='$as' WHERE `MobileNo`='$mob' AND `Password`='$cpassword'";
    if (mysqli_query($con, $q)) {
        // header("location:../../users-profile.php");
        echo 'true';
    } else {
        echo "ERROR: Could not able to execute $q. " . mysqli_error($con);
    }
}
?>