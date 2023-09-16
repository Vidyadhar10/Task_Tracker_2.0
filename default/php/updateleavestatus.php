<?php
include 'connection.php';

$leaveID = $_POST['leaveID'];
$status = $_POST['status'];

if (isset($_POST['reason'])) {
    $reason = $_POST['reason'];
    $reasonStr = mysqli_real_escape_string($con, $reason);
    // Prepare the SQL statement
    $sql = mysqli_query($con, "UPDATE userleaves
    SET ApproveStatus = '$status',
    DeclineReason = '$reasonStr'
    WHERE id = '$leaveID'");
} else {
    // Prepare the SQL statement
    $sql = mysqli_query($con, "UPDATE userleaves
    SET ApproveStatus = '$status'
    WHERE id = '$leaveID'");
}

if ($sql) {
    $response = array(
        'success' => true,
        'message' => 'Leave status updated successfully.'
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'Error updating leave status.'
    );
}
header('Content-Type: application/json');
echo json_encode($response);
