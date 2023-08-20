<?php
include 'connection.php'; // Include the file with the database connection details

// Perform the database query to fetch the data from the table
$result = $con->query("SELECT * FROM leavetable");

// Fetch the data into an array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the database connection
$con->close();

// Send the data as a JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>