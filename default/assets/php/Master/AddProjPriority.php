<?php
include '../connection.php';
if (isset($_POST['PriorityEntered']) && isset($_POST['PriorityColor'])) {
  $PriorityEntered = $_POST['PriorityEntered'];
  $color = $_POST['PriorityColor'];
  if ($PriorityEntered != "" || $PriorityEntered != null) {
    $PriorityEntered = ucfirst($PriorityEntered);
    $AddProiority = "INSERT INTO `project_priority` (`ProjectPriority`, `Priority_Color`) VALUES ('$PriorityEntered', '$color');";
    $con->query($AddProiority);
  }
}
if (isset($_POST['TaskPriEntered']) && isset($_POST['TaskPriorityColor'])) {
  $TaskPriEntered = $_POST['TaskPriEntered'];
  $color = $_POST['TaskPriorityColor'];
  if ($TaskPriEntered != "") {
    $TaskPriEntered = ucfirst($TaskPriEntered);
    $UpdateTaskPri = "INSERT INTO `tasks_priority` (`Tasks_Priority`, `Task_Priority_Color`) VALUES ('$TaskPriEntered', '$color');";
    $con->query($UpdateTaskPri);
  }
}

//leave
if (isset($_POST['leavecateinput'])) {
  $leavecateinput = $_POST['leavecateinput'];

  if (!empty($leavecateinput)) {
    $leavecat = ucfirst($leavecateinput);
    $UpdateTaskPri = "INSERT INTO `leavetable` (`Category`) VALUES ('$leavecat')";
    $updatetable = "ALTER TABLE empleave ADD COLUMN `$leavecat` VARCHAR(255)";

    if ($con->query($UpdateTaskPri) && $con->query($updatetable)) {
      // Both queries executed successfully
      echo json_encode(['success' => true, 'message' => 'Category added successfully']);
    } else {
      // Error occurred in one of the queries
      echo json_encode(['success' => false, 'message' => 'Failed to add category']);
    }
  } else {
    // Category input is empty
    echo json_encode(['success' => false, 'message' => 'Category input is empty']);
  }
}


//subtask priority
if (isset($_POST['SubTaskPriEntered']) && isset($_POST['SubtaskPriorityColor'])) {
  $SubTaskPriEntered = $_POST['SubTaskPriEntered'];
  $color = $_POST['SubtaskPriorityColor'];
  if ($SubTaskPriEntered != "") {
    $SubTaskPriEntered = ucfirst($SubTaskPriEntered);
    $UpdateSubtaskPriority = "INSERT INTO `subtask_priority` (`Sub_Priority`, `Subtask_Pri_Color`) VALUES ('$SubTaskPriEntered', '$color');";
    $con->query($UpdateSubtaskPriority);
  }
}

//subtask Stage
if (isset($_POST['SubTaskStageEntered']) && isset($_POST['SubtaskStageColor'])) {
  $SubTaskStageEntered = $_POST['SubTaskStageEntered'];
  $color = $_POST['SubtaskStageColor'];
  if ($SubTaskStageEntered != "") {
    $SubTaskStageEntered = ucfirst($SubTaskStageEntered);
    $UpdateSubTaskStage = "INSERT INTO `subtask_stages` (`Stages`, `Subtask_stage_color`) VALUES ('$SubTaskStageEntered', '$color');";
    $con->query($UpdateSubTaskStage);
  }
}
// subtask Category
if (isset($_POST['SubTaskCategoryEntered']) && isset($_POST['SubtaskCategoryColor'])) {
  $SubTaskCategoryEntered = $_POST['SubTaskCategoryEntered'];
  $color = $_POST['SubtaskCategoryColor'];
  if ($SubTaskCategoryEntered != "") {
    $SubTaskCategoryEntered = ucfirst($SubTaskCategoryEntered);
    $UpdateSubtaskCategory = "INSERT INTO `subtask_category` (`Sub_Category`, `Subtask_Cat_Color`) VALUES ('$SubTaskCategoryEntered', '$color');";
    $con->query($UpdateSubtaskCategory);
  }
}
?>
<?php mysqli_close($con); ?>