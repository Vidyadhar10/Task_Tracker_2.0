<?php
include '../connection.php';
$query = "SELECT * FROM `leavetable`";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($optionData = $result->fetch_assoc()) {
        $options = $optionData['Category'];
        $task_Pri_id = $optionData['ID'];

        ?>
        <div class="badge m-1" style="font-size:15px; background-color:red;">
            <?php echo $options; ?><i class="bi bi-x-circle-fill text-light " id="<?php echo $task_Pri_id; ?>"
                style="font-size:20px; margin:10px; cursor:pointer; margin-right:auto"></i>
        </div>
        <?php
    }
} else {
    $options = "";
    //Please add filters
    echo "<script>alert('Please add some filter first!');</script>";
}
?>
<form method="post" id="formTaskID" onsubmit="return false">
    <input type="hidden" id="TaskBtnClickVal" name="TaskBtnClickVal" value="" />
</form>

<!-- onclick="selectedTaskOpton(this.id)" -->