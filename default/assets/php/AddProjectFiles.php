<?php
session_start();
include 'connection.php';

$Admin_mob = $_SESSION['Mobile_No'];
$projID = $_SESSION["p_id"];
$m = "SELECT * FROM `employeedata` WHERE `MobileNo`='$Admin_mob'";
$re5 = $con->query($m);
while ($getAdminId = $re5->fetch_assoc()) {
    $Admin_id = $getAdminId['ID'];
    $ProjCreator = $getAdminId['EmpName'];
}

$nextProjID = "SELECT * FROM `projectdata`";
$IdRes = $con->query($nextProjID);
while ($rowVal = $IdRes->fetch_assoc()) {
    $LastProjId = $rowVal['SrNo'];
}
$LastProjId += 1;



if (isset($_FILES['UploadFile'])) {
    // Retrieve the uploaded files
    $uploadedFiles = $_FILES['UploadFile'];

    // Destination directory for the uploaded files
    $targetDirectory = 'assets/Project-Files/';

    // Iterate over each uploaded file
    for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
        $fileName = $uploadedFiles['name'][$i];
        $fileTmpPath = $uploadedFiles['tmp_name'][$i];
        $fileSize = $uploadedFiles['size'][$i];
        $fileError = $uploadedFiles['error'][$i];
        $file_extension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Check for any upload errors
        if ($fileError === UPLOAD_ERR_OK) {
            // Generate a unique file name to prevent conflicts
            // $uniqueFileName = uniqid() . '_' . $fileName;

            // Move the uploaded file to the destination directory
            $targetFilePath = $targetDirectory . $fileName;
            if (move_uploaded_file($fileTmpPath, "../Project-Files/" . $fileName)) {
                // File upload successful
                $AttachQuery = mysqli_query($con, "INSERT INTO `attachments`(`Project_ID`, `File_Name`,`File_Path`, `File_Type`,`Attached_By`) VALUES ('$projID','$fileName','$targetFilePath','$file_extension','$Admin_id')");
                if ($AttachQuery) {
                    $responseVar = true;
                } else {
                    $responseVar = false;
                }
            } else {
                // Failed to move the uploaded file
                $responseVar = false;
            }
        } else {
            // An error occurred during file upload
            $responseVar = false;
        }
    }
    $response = array(
        "success" => true,
    );
} else {
    // No files were uploaded
    $response = array(
        "success" => false,
    );
}


header('Content-Type: application/json');
echo json_encode($response);