<?php
// Assuming you have established a connection to the database
include 'connection.php';

// Get the selected date from the HTML input
$selected_date = $_POST['dateSelected'];
$employeeID = $_POST['EmpsID'];

// Prepare the SQL query
$query = mysqli_query($con, "SELECT * FROM `time_sheet` WHERE `RecordOfDate` = '$selected_date' AND `EmployeeID`='$employeeID'");

if (mysqli_num_rows($query) > 0) {

    while ($result = $query->fetch_assoc()) {
        $response[] = $result;
    }
} else {
    $response = array(
        "message" => "No rows present previously on this date",
    );
}

header('Content-Type: application/json');
echo json_encode($response);
