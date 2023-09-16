<?php
include 'connection.php';
session_start();

if (isset($_FILES["empProfilePhoto"]) && $_FILES["empProfilePhoto"]['error'] === UPLOAD_ERR_OK) {
    $targetDir = "./user_profile_photo/";
    $fileName = basename($_FILES["empProfilePhoto"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $folderStore = "../user_profile_photo/" . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["empProfilePhoto"]["tmp_name"], $folderStore)) {
        // Insert image path into database
        // echo "Image saved to folder";
    } else {
        // echo "Failed to upload image file."
    }
} else {
    $fileName = '';
}

$eid = $_POST['empid'];
$fullName = $_POST['empName'];
$address = $_POST['empAddress'];
$about = $_POST['empAbout'];

$twitter = $_POST['TwitterUnm'];
$facebook = $_POST['FacebookUnm'];
$instagram = $_POST['InstaUnm'];
$linkedin = $_POST['LinkedUnm'];

if ($fileName == "") {
    $q = "UPDATE `employeedata` SET
    `EmpName`='$fullName',
    `About`='$about',
    `Address`='$address',
    `Twitter`='$twitter',
    `Facebook`='$facebook',
    `Instagram`='$instagram',
    `Linkedin`='$linkedin'
    WHERE `ID`='$eid'";
} else {
    $q = "UPDATE `employeedata` SET
    `EmpName`='$fullName',
    `ProfilePhoto`='$targetFilePath',
    `About`='$about',
    `Address`='$address',
    `Twitter`='$twitter',
    `Facebook`='$facebook',
    `Instagram`='$instagram',
    `Linkedin`='$linkedin'
    WHERE `ID`='$eid'";
}
if (mysqli_query($con, $q)) {
    $response = array(
        "success" => true,
    );
} else {
    $response = array(
        "success" => false,
    );
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
