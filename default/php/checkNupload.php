
<?php
$fileData = $_POST['file'];
$targetDir = "assets/uploads/";
$fileName = basename($_FILES["InputProfileImage"]["name"]);
$targetFilePath = $targetDir.$fileName;
$folderStore = "../uploads/" . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
?>