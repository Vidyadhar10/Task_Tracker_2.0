<?php
include 'connection.php';
$commentID = $_POST['commentID'];
$query = mysqli_query($con, "SELECT
rc.CommentSentence AS reply_comment_text,
rc.DateTime AS reply_comment_datetime,
employee_rc.EmpName AS reply_comment_author_name,
employee_rc.ProfilePhoto AS reply_comment_author_profile_photo 
FROM
replycomment rc
LEFT JOIN
employeedata employee_rc ON rc.`Emp-ID` = employee_rc.ID
WHERE
rc.`comment-ID` = '$commentID'
ORDER BY
rc.ID;");
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
