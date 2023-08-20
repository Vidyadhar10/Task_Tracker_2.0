<?php
include '../connection.php';
$query = "SELECT * FROM `project_priority`";
$result = $con->query($query);
if ($result->num_rows > 0) {
    while ($optionData = $result->fetch_assoc()) {
        $options = $optionData['ProjectPriority'];
        $optionColor = $optionData['Priority_Color'];
        $proj_Pri_id = $optionData['ID'];
?>
        <div class="badge m-1" style="font-size:15px; background-color:<?php echo $optionColor; ?>;"><?php echo $options; ?><i class="bi bi-x-circle-fill text-light " id="<?php echo $proj_Pri_id; ?>" onclick="RemoveFilter(this.id)" style="font-size:20px; margin:10px; margin-right:-4px; cursor:pointer;"></i></div>
<?php
    }
} else {
    $options = "";
    //Please add filters
    echo "<script>alert('Please add some filter first!');</script>";
}
?>
<form method="post" onsubmit="return false;" id="formID">
    <input type="hidden" id="btnClickedValue" name="btnClickedValue" value="" />
</form>