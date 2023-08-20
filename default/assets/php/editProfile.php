<?php
include 'connection.php';
session_start();
// $profilePic = $_POST['InputProfileImage'];
$targetDir = "assets/uploads/";
$fileName = basename($_FILES["InputProfileImage"]["name"]);
$targetFilePath = $targetDir.$fileName;
$folderStore = "../uploads/" . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
// move_uploaded_file($_FILES["InputProfileImage"]["tmp_name"], $folderStore)
if (move_uploaded_file($_FILES["InputProfileImage"]["tmp_name"], $folderStore)) {
    // Insert image path into database
    echo "Image saved to folder";
} else {
    echo "Failed to upload image file.";
}
$about = $_POST['about'];
$fullName = $_POST['fullName'];
$address = $_POST['address'];
$twitter = $_POST['twitter'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$linkedin = $_POST['linkedin'];
$mob = $_SESSION['Mobile_No'];
if ($fileName == "") {
    $q = "UPDATE `employeedata` SET `EmpName`='$fullName', `About`='$about',`Address`='$address', `Twitter`='$twitter', `Facebook`='$facebook', `Instagram`='$instagram', `Linkedin`='$linkedin' WHERE `MobileNo`=$mob";
} else {
    $q = "UPDATE `employeedata` SET `EmpName`='$fullName', `ProfilePhoto`='$targetFilePath', `About`='$about', `Address`='$address', `Twitter`='$twitter', `Facebook`='$facebook', `Instagram`='$instagram', `Linkedin`='$linkedin' WHERE `MobileNo`=$mob";
} 
if (mysqli_query($con, $q)) {
    header("location:../../users-profile.php");
} else {
    echo "ERROR: Could not able to execute $q. " . mysqli_error($con);
}
mysqli_close($con);
?>