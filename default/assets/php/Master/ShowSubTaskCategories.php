<?php
include '../connection.php';
$query = "SELECT * FROM `subtask_category`";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($optionData = $result->fetch_assoc()) {
        $options = $optionData['Sub_Category'];
        $sub_task_category_id = $optionData['ID'];
        $optionColor = $optionData['Subtask_Cat_Color'];

?>
        <div class="badge m-1" style="font-size:15px;  background-color:<?php echo $optionColor; ?>;"><?php echo $options; ?><i class="bi bi-x-circle-fill text-light " id="<?php echo $sub_task_category_id; ?>" onclick="SelectedSubtaskCategory(this.id)" style="font-size:20px; margin:10px; margin-right:-4px; cursor:pointer;"></i></div>
<?php
    }
}
?>
<form method="post" id="formSubtaskCategory" onsubmit="return false">
    <input type="hidden" id="SubTaskCategoryInput" name="SubTaskCategoryInput" value="" />
</form>