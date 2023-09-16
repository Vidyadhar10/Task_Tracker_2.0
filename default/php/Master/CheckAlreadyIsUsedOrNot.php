<?php
include '../connection.php';

if (isset($_POST['SubTaskStageInputID']) && isset($_POST['SubtaskStage'])) {
    $StageID = $_POST['SubTaskStageInputID'];

    $queryToCheckStageUsedOrNot = mysqli_query($con, "SELECT * FROM `subtask` AS SB
    INNER JOIN `subtask_stages` AS SS
    ON SB.status = SS.id
    WHERE SB.`status`='$StageID'");
    if (mysqli_num_rows($queryToCheckStageUsedOrNot) > 0) {
        $response = array(
            "success" => true,
        );
    } else {
        $response = array(
            "success" => false,
        );
    }
}
if (isset($_POST['SubTaskCategoryInputID']) && isset($_POST['SubtaskCategory'])) {
    $CategoryID = $_POST['SubTaskCategoryInputID'];

    $queryToCheckStageUsedOrNot = mysqli_query($con, "SELECT * FROM `subtask` INNER JOIN `subtask_category` ON subtask.Category=subtask_category.ID WHERE `Category`='$CategoryID'");
    if (mysqli_num_rows($queryToCheckStageUsedOrNot) > 0) {
        $response = array(
            "success" => true,
        );
    } else {
        $response = array(
            "success" => false,
        );
    }
}
if (isset($_POST['SubTaskPriInputID']) && isset($_POST['SubtaskPriority'])) {
    $PriorityID = $_POST['SubTaskPriInputID'];

    $queryToCheckStageUsedOrNot = mysqli_query($con, "SELECT * FROM `subtask` INNER JOIN `subtask_priority` ON subtask.subtaskpriority=subtask_priority.ID WHERE `subtaskpriority`='$PriorityID'");
    if (mysqli_num_rows($queryToCheckStageUsedOrNot) > 0) {
        $response = array(
            "success" => true,
        );
    } else {
        $response = array(
            "success" => false,
        );
    }
}
if (isset($_POST['TaskPriInputID']) && isset($_POST['taskPriority'])) {
    $TaskPriID = $_POST['TaskPriInputID'];

    $queryToCheckStageUsedOrNot = mysqli_query($con, "SELECT * FROM `taskdata` INNER JOIN `tasks_priority` ON taskdata.Task_priority=tasks_priority.ID WHERE `Task_priority`='$TaskPriID'");
    if (mysqli_num_rows($queryToCheckStageUsedOrNot) > 0) {
        $response = array(
            "success" => true,
        );
    } else {
        $response = array(
            "success" => false,
        );
    }
}
header('Content-Type: application/json');
echo json_encode($response);
