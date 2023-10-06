<?php
session_start();
include 'connection.php';
$targetDir = "./Project-Logo/";
$fileName = basename($_FILES["InputLogoImage"]["name"]);
$targetFilePath = $targetDir . $fileName;
$folderStore = "../Project-Logo/" . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
// move_uploaded_file($_FILES["InputProfileImage"]["tmp_name"], $folderStore)
if (move_uploaded_file($_FILES["InputLogoImage"]["tmp_name"], $folderStore)) {
    // Insert image path into database
    // echo "Image saved to folder";
} else {
    // echo "Failed to upload image file.";
}

$ProjNm = mysqli_real_escape_string($con, $_POST['inputProjName']);
$ProjDue = $_POST['inputProjStart'];
$ProjEndDT = $_POST['inputProjEnd'];
$ProjPriority = $_POST['projectPriority'];
$ProjDescription = "<p>" . $_POST['inputProjDescription'] . "";
$ProjDescription = mysqli_real_escape_string($con, $ProjDescription);
$ProjMission = "<p>" . $_POST['mission'] . " ";
$ProjMission = mysqli_real_escape_string($con, $ProjMission);


$Admin_mob = $_SESSION['Mobile_No'];
$m = "SELECT * FROM `employeedata` WHERE `MobileNo`='$Admin_mob'";
$re5 = $con->query($m);
while ($getAdminId = $re5->fetch_assoc()) {
    $Admin_id = $getAdminId['ID'];
    $ProjCreator = $getAdminId['EmpName'];
}
$nextProjID = "SELECT * FROM `projectdata`";
$IdRes = $con->query($nextProjID);
if (mysqli_num_rows($IdRes) <= 0) {
    $LastProjId = 1;
} else {

    while ($rowVal = $IdRes->fetch_assoc()) {
        $LastProjId = $rowVal['SrNo'];
    }
}
$LastProjId += 1;
$checkbox1 = $_POST['SelectedEmps'];
$acronym = $_POST['inputProjKey'];

// attached files store to table with extension
if (isset($_FILES['Attachments'])) {
    $errors = array();
    foreach ($_FILES['Attachments']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['Attachments']['name'][$key];
        $file_tmp = $_FILES['Attachments']['tmp_name'][$key];
        $file_type = $_FILES['Attachments']['type'][$key];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        if (empty($errors) == true) {
            $targetFilesPath = "assets/Project-Files/" . $file_name;
            move_uploaded_file($file_tmp, "../Project-Files/" . $file_name);
            echo "File uploaded successfully: " . $file_name . "<br>";
        } else {
            print_r($errors);
        }
        $AttachQuery = "INSERT INTO `attachments`(`Project_ID`, `File_Name`,`File_Path`, `File_Type`,`Attached_By`) VALUES ('$LastProjId','$file_name','$targetFilesPath','$file_extension','$Admin_id')";
        mysqli_query($con, $AttachQuery);
    }
}
// Adding data to table
$sql = "INSERT INTO `projectdata` (`ProjectName`,`ProjectLogo`,`ProjectKey`, `Start_Date`,`End_Date`, `Priority`, `Description`,`Mission`,`assigned_emp`,`Admin_emp_id`) VALUES ('$ProjNm','$targetFilePath','$acronym','$ProjDue','$ProjEndDT','$ProjPriority','$ProjDescription','$ProjMission','$checkbox1','$Admin_id')";
if (mysqli_query($con, $sql)) {
    $tre = "SELECT * FROM `projectdata`";
    $re = $con->query($tre);
    while ($roa = $re->fetch_assoc()) {
        $te = $roa['SrNo'];
    }
    $my_array = explode(";", $checkbox1);
    $ytc = [];
    for ($i = 0; $i < count($my_array); $i++) {
        array_push($ytc, (int) $my_array[$i]);
        // Send mail to this employee that you are added to this project
        $swq = "INSERT INTO `empwork` (`Emp_ID`,`Project_ID`,`Subtask_ID`) VALUES ('$ytc[$i]','$te','0')";
        mysqli_query($con, $swq);
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
$ActivitySent = "A new project $ProjNm has been created by $ProjCreator!";
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date('h:i A', time());
$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
mysqli_query($con, $sql2);

$Activity_Title = "Project Added";
$Activity_Text = mysqli_real_escape_string($con, "A new project <span class='text-info'>$ProjNm</span> has been added to system by <span class='text-info'>$ProjCreator</span>");
$Activity_Icon = mysqli_real_escape_string($con, "ri-file-mark-line");
$Activity_By = $Admin_id;
$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`, `ProjectID`,`activity_type`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By', '$LastProjId', 2)");
if ($InsertInNotifi) {
    $response = array(
        "success" => true,
    );
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
