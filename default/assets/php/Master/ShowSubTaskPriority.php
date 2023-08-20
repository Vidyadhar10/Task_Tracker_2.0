<?php
include '../connection.php';
$query = "SELECT * FROM `subtask_priority`";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($optionData = $result->fetch_assoc()) {
        $options = $optionData['Sub_Priority'];
        $sub_task_pri_id = $optionData['ID'];
        $optionColor = $optionData['Subtask_Pri_Color'];
?>
        <div class="badge m-1" style="font-size:15px; background-color:<?php echo $optionColor; ?>; "><?php echo $options; ?><i class="bi bi-x-circle-fill text-light " id="<?php echo $sub_task_pri_id; ?>" onclick="selectedSubTaskPri(this.id)" style="font-size:20px; margin:10px; margin-right:-4px; cursor:pointer;"></i></div>
<?php
    }
}
?>
<form method="post" id="formSubTaskPriID" onsubmit="return false">
    <input type="hidden" id="SubTaskPriInput" name="SubTaskPriInput" value="" />
</form>