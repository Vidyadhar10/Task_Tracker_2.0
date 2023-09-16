<?php
session_start();
include 'connection.php';

$Admin_mob = $_SESSION['Mobile_No'];
$m = "SELECT * FROM `employeedata` WHERE `MobileNo`='$Admin_mob'";
$re5 = $con->query($m);
while ($getAdminId = $re5->fetch_assoc()) {
	$Admin_id = $getAdminId['ID'];
	$admin = $getAdminId['EmpName'];
}
$EmpNm = $_POST['inputEmpName'];
$EmpEml = $_POST['inputEmpEmail'];
$EmpMob = $_POST['inputEmpMobile'];
$EmpPos = $_POST['inputEmpPosition'];
$EmpAdd = $_POST['inputEmpAddress'];
$EmpPass = $_POST['PasswordForEmp'];
$passWd = md5($EmpPass);

// $formData = $_POST['formData'];

// $query_columns = "SELECT COLUMN_NAME
//                   FROM INFORMATION_SCHEMA.COLUMNS
//                   WHERE TABLE_NAME = 'empleave'
//                   AND COLUMN_NAME <> 'id'";

// $result = mysqli_query($con, $query_columns);
// $columns = "";

// while ($row = mysqli_fetch_assoc($result)) {
// 	$column = $row['COLUMN_NAME'];
// 	$columns .= "`$column`, ";
// }

// $values = "";
// foreach ($formData as $inputName => $inputValue) {

// 	$columnValue = $inputValue;

// 	// Escape the column values to prevent SQL injection
// 	$columnValue = mysqli_real_escape_string($con, $columnValue);


// 	$values .= "'$columnValue', ";
// }

// // Remove the trailing comma and whitespace from the columns and values strings
// $columns = rtrim($columns, ", ");
// $values = rtrim($values, ", ");


$sql = "INSERT INTO `employeedata` (`EmpName`, `Email`, `MobileNo`, `Position`, `Address`, `Password`) VALUES ('$EmpNm', '$EmpEml', '$EmpMob', '$EmpPos', '$EmpAdd','$passWd')";
if (mysqli_query($con, $sql)) {
	$ActivitySent = "A new employee $EmpNm has been added by $admin!";
	date_default_timezone_set('Asia/Kolkata');
	$time = date('h:i A', time());
	$date = date("Y-m-d");
	$sql2 = "INSERT INTO `recent_activity`(`Time`, `Activity`, `Date`) VALUES ('$time','$ActivitySent', '$date')";
	mysqli_query($con, $sql2);

	$Activity_Title = "Employee Added";
	$Activity_Text = mysqli_real_escape_string($con, "A new employee <span class='text-success'>$EmpNm</span> has been added to the system by <span class='text-success'>$admin</span>");
	$Activity_Icon = mysqli_real_escape_string($con, "bx bx-user-check");
	$Activity_By = $Admin_id;
	$InsertInNotifi = mysqli_query($con, "INSERT INTO `notifications` (`Activity_Title`, `Activity_Text`,`Activity_Icon`,`Activity_By`)VALUES('$Activity_Title', '$Activity_Text', '$Activity_Icon', '$Activity_By')");



	if ($InsertInNotifi) {
		$response = array(
			"success" => true,
		);
	} else {
		$response = array(
			"success" => false,
			"error" => mysqli_error($con)
		);
	}
} else {
	$response = array(
		"success" => false,
		"error" => mysqli_error($con)
	);
}

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
