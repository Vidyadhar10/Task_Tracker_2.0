<?php
session_start();
include 'connection.php';
$do = $_GET['do'];
$id = $_SESSION['cID'];
$totalTasks = $_SESSION['totalTasks'];
if ($totalTasks == 0) {
    $q = "update employeedata set isAdmin=$do where ID=$id";
    if (mysqli_query($con, $q)) {
        header("location:../../users-profile-adminPage.php?id=$id");
    } else {
        echo "ERROR: Could not able to execute $q. " . mysqli_error($con);
    }
    mysqli_close($con);
} else {
    echo "<script>
    alert('Assigned tasks must be 0 to make someone Admin');
    window.location.href = '../../users-profile-adminPage.php?id=$id';
    </script>";
}
?>