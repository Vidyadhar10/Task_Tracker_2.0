<?php
include '../connection.php';

$bg_id = $_POST['badgeID'];
$bg_type = $_POST['badgeType'];
$TnmArray = array(
  "proj_pri" => "project_priority",
  "task_pri" => "tasks_priority",
  "subtask_pri" => "subtask_priority",
  "subtask_cat" => "subtask_category",
  "subtask_stage" => "subtask_stages",
  "leave_cat" => "leave_types",
);
if (array_key_exists($bg_type, $TnmArray)) {
  $table_name = $TnmArray[$bg_type];
  $UpdateQuery = mysqli_query($con, "DELETE FROM $table_name WHERE `ID` = '$bg_id';");
  if ($UpdateQuery) {
    $response = array(
      "success" => true,
    );
  }
} else {
  $response = array(
    "success" => false,
  );
}

mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
