<?php
include 'connection.php';
$pid = $_POST['pid'];
$ProjDetails = "SELECT * FROM `projectdata` as pd inner join project_priority as pp on pd.Priority = pp.ID WHERE `SrNo`='$pid'";
$resVal = $con->query($ProjDetails);
while ($row = $resVal->fetch_assoc()) {
    $projDescription = htmlspecialchars_decode($row['Description'], ENT_QUOTES);
    $projDescriForUpdateForm = mysqli_real_escape_string($con, $row['Description']);
    $ProjMission = stripslashes(mysqli_real_escape_string($con, $row['Mission']));
    $row['PROJDesc'] = $projDescription;
    $row['PROJDescForUpdate'] = $projDescriForUpdateForm;
    $row['PROJMission'] = $ProjMission;
    $AssignedEmployeesArray = explode(',', $row['assigned_emp']);

    $response[] = $row;
}
$attachmentsData = mysqli_query($con, "SELECT * from attachments where Project_ID = '$pid' order by ID desc");
$AttachmentDataArr = array();
while ($rs = $attachmentsData->fetch_assoc()) {
    $AttachmentDataArr[] = $rs;
}
$employeeData = array();
foreach ($AssignedEmployeesArray as $da) {

    $querytoGetEmployeesData = mysqli_query($con, "SELECT * FROM employeedata WHERE ID = '$da'");
    while ($a = $querytoGetEmployeesData->fetch_assoc()) {
        $employeeData[] = $a;
    }
}
$resultData = array(
    "projectData" => $response,
    "AttachmentData" => $AttachmentDataArr,
    "EmployeeData" => $employeeData,
);

header('Content-Type: application/json');
echo json_encode($resultData);
