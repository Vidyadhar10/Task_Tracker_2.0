<?php
    include '../connection.php';
    if (isset($_POST['btnClickedValue'])) {
        $word = $_POST['btnClickedValue'];
        $UpdateColPri = "DELETE FROM `project_priority` WHERE `ID` = '$word'";
        $con->query($UpdateColPri);
    }
    if (isset($_POST['TaskBtnClickVal'])) {
      $TaskBtnClickVal = $_POST['TaskBtnClickVal'];
      if ($TaskBtnClickVal != "") {
        $UpdateColPri = "DELETE FROM `tasks_priority` WHERE `ID` = '$TaskBtnClickVal'";
        $con->query($UpdateColPri);
      }
    }
  if (isset($_POST['SubTaskPriInput'])) {
    $SubTaskPriInput = $_POST['SubTaskPriInput'];
       if ($SubTaskPriInput != "") {
        $UpdateColPri = "DELETE FROM `subtask_priority` WHERE `ID` = '$SubTaskPriInput'";
        $con->query($UpdateColPri);
      }
    }
  if (isset($_POST['SubTaskStageInput'])) {
    $SubTaskStageInput = $_POST['SubTaskStageInput'];
       if ($SubTaskStageInput != "") {
        $UpdateColStage = "DELETE FROM `subtask_stages` WHERE `ID` = '$SubTaskStageInput'";
        $con->query($UpdateColStage);
      }
    }
    if (isset($_POST['SubTaskCategoryInput'])) {
      $SubTaskCategoryInput = $_POST['SubTaskCategoryInput'];
         if ($SubTaskCategoryInput != "") {
          $UpdateColCategory = "DELETE FROM `subtask_category` WHERE `ID` = '$SubTaskCategoryInput'";
          $con->query($UpdateColCategory);
        }
    }
?>