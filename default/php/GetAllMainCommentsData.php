<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connection.php';
$subtaskid = $_POST['subid'];
$query = mysqli_query($con, "SELECT
c.ID AS main_comment_id,
c.comment AS main_comment_text,
c.DateTime AS main_comment_datetime,
c.path AS FilePath,
employee_c.EmpName AS main_comment_author_name,
employee_c.ProfilePhoto AS main_comment_author_profile_photo
FROM
commentdata c
LEFT JOIN
employeedata employee_c ON c.EmpID = employee_c.ID
WHERE
c.subtaskid = '$subtaskid'
GROUP BY
c.ID, c.comment, employee_c.EmpName, employee_c.ProfilePhoto
ORDER BY
c.ID;");
if (mysqli_num_rows($query) > 0) {
    while ($row = $query->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response = array();
}
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
