<?php
// Assuming you have established a connection to the database
include 'connection.php';

// Get the selected date from the HTML input
$selected_date = $_POST['dateSelected'];
$employeeID = $_POST['EmpsID'];

// Prepare the SQL query
$query = mysqli_query($con, "SELECT ts.*, pd.ProjectName, sb.subtaskname FROM `time_sheet` AS ts
INNER JOIN projectdata AS pd
ON pd.SrNo = ts.Project_ID
INNER JOIN subtask AS sb
ON sb.subtask_ID = ts.Subtask_ID
WHERE ts.`RecordOfDate` = '$selected_date'
AND ts.`EmployeeID`='$employeeID'");

if (mysqli_num_rows($query) > 0) {

    while ($result = $query->fetch_assoc()) {
        $response[] = $result;
    }
} else {
    $response = array();
}

header('Content-Type: application/json');
echo json_encode($response);
