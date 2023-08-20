<?php
include '../connection.php';
$query = "SELECT * FROM `subtask_stages`";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($optionData = $result->fetch_assoc()) {
        $options = $optionData['stages'];
        $optionColor = $optionData['Subtask_stage_color'];
        $sub_task_stage_id = $optionData['id'];
?>
        <div class="badge m-1" style="font-size:15px; background-color:<?php echo $optionColor; ?>;"><?php echo $options; ?><i class="bi bi-x-circle-fill text-light " id="<?php echo $sub_task_stage_id; ?>" onclick="SelectedSubtaskStage(this.id)" style="font-size:20px; margin:10px; margin-right:-4px; cursor:pointer;"></i></div>
<?php
    }
}
?>
<form method="post" id="formSubTaskStageID" onsubmit="return false">
    <input type="hidden" id="SubTaskStageInput" name="SubTaskStageInput" value="" />
</form>