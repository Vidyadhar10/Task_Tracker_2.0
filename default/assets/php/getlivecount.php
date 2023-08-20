<?php
include 'connection.php';
// $sql = "SELECT leaveType, COUNT(*) AS total_count
// FROM userleaves
// WHERE startDate > CURDATE()
// GROUP BY leaveType
// UNION
// SELECT DISTINCT leaveType, 0 AS total_count
// FROM userleaves
// WHERE leaveType NOT IN(SELECT leaveType FROM userleaves WHERE startDate > CURDATE());
// ";

$sql = "SELECT ul.leaveType, COUNT(*) AS total_count
FROM userleaves AS ul INNER JOIN leavetable AS lt
ON ul.leaveType = lt.Category
WHERE ul.startDate > CURDATE() GROUP BY lt.Category";

$result = mysqli_query($con, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $leaveType = $row['leaveType'];
    $totalCount = $row['total_count'];

    $data[] = array(
        'leaveType' => $leaveType,
        'total_count' => $totalCount
    );
}

// Return the data as a JSON response
header('Content-Type: application/json');
echo json_encode($data);
