<?php
include 'connection.php';
$rdt = $_GET['rdtVal'];
$CommentID = $_GET['cmtID'];
$replyData = mysqli_query($con, "SELECT * FROM `replycomment` WHERE `subtask-ID`=$rdt ORDER BY `ID` DESC");
while ($resultRow = $replyData->fetch_assoc()) {
  if ($resultRow['comment-ID'] == $CommentID) { ?>
    <?php
    $replyCommenterID = $resultRow['Emp-ID'];
    $employeeDetails = mysqli_query($con, "SELECT * from `employeedata` WHERE `ID`= '$replyCommenterID'");
    while ($empRow = $employeeDetails->fetch_assoc()) {
      if (!empty($empRow['ProfilePhoto']) == null) {
        $replyCommenterImg = 'assets/img/default.png';
      } else {
        $replyCommenterImg = $empRow['ProfilePhoto'];
      }
      $replyCommenterName = $empRow['EmpName'];
    }
    $replyCommenterMessage = $resultRow['CommentSentence'];
    $timeOfReplyComment = $resultRow['DateTime'];
    $replyCmtID = $resultRow['ID'];
    // Set the timezone to your desired timezone
    date_default_timezone_set('Asia/Kolkata');
    // Get the current date and time as a DateTime object
    $current_datetime = new DateTime();
    // Create a DateTime object representing the date and time to compare using the variable
    $date_to_compare = new DateTime($timeOfReplyComment);
    // Compare the two dates and times using the `diff()` method
    $diff = $current_datetime->diff($date_to_compare);
    // Get the time difference in days, hours, and minutes
    $days = $diff->days;
    $hours = $diff->h + ($diff->days * 24);
    $minutes = $diff->i;
    // Format the time difference as "x days y hours z minutes ago", "x hours y minutes ago", or "x minutes ago"
    if ($days > 0) {
      if ($days > 1) {
        $CalculatedTimeDiff = $days . ' days ago';
      } else {
        $CalculatedTimeDiff = $days . ' days ' . $hours . ' hours ago';
      }
    } elseif ($hours > 0) {
      $CalculatedTimeDiff = $hours . ' hours ' . $minutes . ' minutes ago';
    } else {
      $CalculatedTimeDiff = $minutes . ' minutes ago';
    }
    ?>
    <!-- Reply to comment div  -->
    <div class="d-flex flex-row p-2 pr-0 m-4 mt-0 mb-0">
      <img src="<?php echo $replyCommenterImg; ?>" width="30" height="30" class="rounded-circle mr-3">&nbsp
      &nbsp
      <div class="w-200">
        <div class="d-flex">
          <div class="text-start">
            <span class="mr-2 fw-bold">
              <?php echo $replyCommenterName; ?>
            </span>
          </div>
          <small class="text-end  text-muted" style=" margin-top:2px; margin-left:20px; font-style:italic;">
            <?php echo $CalculatedTimeDiff; ?>
          </small>&nbsp &nbsp
          <div class="text-end">
            <i class="bi bi-trash3-fill text-danger" style="cursor:pointer;" id="<?php echo $replyCmtID; ?>" onclick="ConfirmDelete(this.id, <?php echo $rdt ?>)"></i>
          </div>
        </div>
        <p class="text-justify comment-text mb-0 d-flex justify-content-between">
          <span><?php echo $replyCommenterMessage;
                // if (isset($ro['path'][13])) {
                //   $mi = substr($ro['path'], 13);
                //   echo "<br><a href='assets/Files/$mi' target='_blank'>$mi</a>";
                // }
                ?></span>
          <!-- <i class="bi bi-reply" id=<?php //echo $CommentID; 
                                          ?> style="font-size:1.3rem; cursor:pointer;" onclick="ReplyToComment(this.id)"></i> -->
        </p>
        <p class="d-none d-flex mb-0 mt-1" id="replyBox<?php echo $CommentID; ?>">
          <input type="text" class="form-control" placeholder="Add a comment..." name="ReplyComment" id="Re<?php echo $CommentID; ?>">
          <i class="bi bi-send-fill text-primary" onclick="" style="font-size:20px; cursor:pointer; margin-left:-30px; margin-top:4px"></i>
        </p>
      </div>
    </div>
<?php  }
}
?>