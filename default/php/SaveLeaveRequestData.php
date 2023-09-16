<?php
// Assuming you have already established a database connection
include './connection.php';

// Get form data
$empId = $_POST['employeeId'];
$StartDate = $_POST['fromdate'];
$EndDate = $_POST['toDate'];
$leaveType = $_POST['category'];
$reason = mysqli_real_escape_string($con, $_POST['reason']);

// Insert the leave record into the userleaves table
$query = "INSERT INTO userleaves (`empId`, `Startdate`, `EndDate`, `reason`, `leaveType`) VALUES ('$empId', '$StartDate', '$EndDate', '$reason', '$leaveType')";

$executeQ = mysqli_query($con, $query);

// Execute the query
if ($executeQ) {
    // Retrieve the employee information
    $queryValue = "SELECT `ID`, `EmpName`, `Email`, `MobileNo`, `Position`, `Address`, `status` FROM employeedata WHERE ID = $empId";
    $empQuery = mysqli_query($con, "SELECT `ID`, `EmpName`, `Email`, `MobileNo`, `Position`, `Address`, `status` FROM employeedata WHERE ID = '$empId'");

    while ($employee = $empQuery->fetch_assoc()) {
        // Get the inserted values
        $insertedValues = array(
            "EmpName" => $employee['EmpName'],
            "Email" => $employee['Email'],
            "MobileNo" => $employee['MobileNo'],
            "Position" => $employee['Position'],
            "StartDate" => $StartDate,
            "EndDate" => $EndDate,
            "Reason" => $reason
        );
    }

    // Return success response with the inserted values
    $response = array(
        "message" => "Leave saved successfully",
        "insertedValues" => $insertedValues
    );
}

echo json_encode($response);
mysqli_close($con);
header('Content-Type:application/json');
