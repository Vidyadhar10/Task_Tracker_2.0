<?php
// Assuming you have already established a database connection
include 'connection.php';
$empid = $_POST['empid'];
$status = $_POST['status'];


// Prepare the SQL query
$query = "SELECT ul.*, lt.leave_category FROM userleaves AS ul
INNER JOIN leave_types AS lt
ON ul.leaveType = lt.ID
WHERE ul.empId = '$empid'";

if ($status == '') {
    // If status is blank, include records with null or blank ApproveStatus
    $query .= " AND (ul.ApproveStatus IS NULL OR ul.ApproveStatus = '')";
} else {
    // If status is not blank, include records with the specified status
    $query .= " AND ul.ApproveStatus = '$status'";
}
$query .= " ORDER BY ul.id DESC";
// print_r($query);c:\xampp\htdocs\Optimal\Task-Manager\leaveformdata.php

// Execute the SQL query
$result = mysqli_query($con, $query);

// Create an empty array to store the data
$data = array();

// Fetch the data and store it in the array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($con);

// Return the data as JSON
echo json_encode($data);
