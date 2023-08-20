<?php
	include 'connection.php';
	$sub = $_GET['sub'];
	$men = $_GET['men'];
    $task =$_GET['task'];
    $checkbox1 = implode(';', $_POST['assignEmp']);
	$sql = "UPDATE `subtask` SET `empid`='$checkbox1' WHERE `subtask_ID`=$sub";
	if (mysqli_query($con, $sql)) {
        header("location:../../task.php?id=$men&task=$task");
	}else {
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
	mysqli_close($con);
 ?>