<?php
	include 'connection.php';
    $Empsid = $_GET['Empsid'];
    $CommentID = $_GET['cmtID'];
    $mainCommentMessage = $_GET['mainCommentMessage'];
    $thisTaskId = $_GET['thisTaskId'];
    $DateOfComment = $_GET['dateofcmt'];
    $empdata = "SELECT * from `employeedata` WHERE `ID`= '$Empsid'";
    $ec = mysqli_query($con, $empdata);
    while ($empCommentData = $ec->fetch_assoc()) {
        $CommenterName = $empCommentData['EmpName'];
        if (!empty($empCommentData['ProfilePhoto']) == null) {
            $CommenterImg = 'assets/img/default.png';
        } else {
            $CommenterImg = $empCommentData['ProfilePhoto'];
        }
    }
?>
<?php
    // Set the timezone to your desired timezone
    date_default_timezone_set('Asia/Kolkata');
    // Get the current date and time as a DateTime object
    $current_datetime = new DateTime();
    // Create a DateTime object representing the date and time to compare using the variable
    $date_to_compare = new DateTime($DateOfComment);
    // Compare the two dates and times using the `diff()` method
    $diff = $current_datetime->diff($date_to_compare);
    // Get the time difference in days, hours, and minutes
    $days = $diff->days;
    $hours = $diff->h + ($diff->days * 24);
    $minutes = $diff->i;
    // Format the time difference as "x days y hours z minutes ago", "x hours y minutes ago", or "x minutes ago"
    if ($days > 0) {
        if ($days > 1) {
          $formatted_diff = $days.' days ago';
        } else {
          $formatted_diff = $days.' days '.$hours.' hours ago';
        }
    } elseif ($hours > 0) {
        $formatted_diff = $hours.' hours '.$minutes.' minutes ago';
    } else {
        $formatted_diff = $minutes.' minutes ago';
    }
?>
    <div class="d-flex flex-row p-2 pr-0 ">
    <img src="<?php echo $CommenterImg; ?>" width="40" height="40" class="rounded-circle mr-3">&nbsp
    &nbsp
    <div class="w-200">
      <div class="d-flex ">
        <div class="text-start">
          <span class="mr-2 fw-bold">
            <?php echo $CommenterName; ?>
          </span>
        </div>
        <small class="text-end  text-muted"
          style=" margin-top:2px; margin-left:20px; font-style:italic;">
          <?php echo $formatted_diff; ?>
        </small>&nbsp &nbsp
        <div class="text-end">
          <!-- <i class="bi bi-trash3-fill" id="<?php //echo $CommentID; ?>" onclick="ConfirmDelete(this.id)"></i> -->
        </div>
      </div>
      <p class="text-justify comment-text mb-0 d-flex justify-content-between" >
        <span>
          <?php echo $mainCommentMessage;
            // if (isset($ro['path'][13])) {
            //   $mi = substr($ro['path'], 13);
            //   echo "<br><a href='assets/Files/$mi' target='_blank'>$mi</a>";
            // }
          ?>
        </span>
          <i class="bi bi-reply" id=<?php echo $CommentID; ?> style="font-size:1.3rem; cursor:pointer;" onclick="ReplyToComment(this.id)"></i>
      </p>
      <form action="assets/php/RepliedComment.php?subid=<?php echo $thisTaskId; ?>&CommnetsID=<?php echo $CommentID; ?>" method="post" id="ReplyCommentForm<?php echo $CommentID; ?>" >
        <p class="d-none d-flex mb-0 mt-1" id="replyBox<?php echo $CommentID; ?>">
          <input type="text" class="form-control" placeholder="Reply to this comment..." name="ReplyComment<?php echo $CommentID; ?>" id="Re<?php echo $CommentID; ?>">
          <i class="bi bi-send-fill text-primary" id="Re<?php echo $CommentID; ?>" onclick="submitReplyComment(this.id);" style="font-size:20px; cursor:pointer; margin-left:-30px; margin-top:4px"></i>
        </p>
        <!-- <input type="text" name="CommnetsID" class="d-non" value="<?php //echo $CommentID; ?>"> -->
        <!-- <input type="text" name="CommentOnSubtaskID<?php //echo $subtasksidtosave; ?>" class="d-noe" value="<?php // echo $subtasksidtosave; ?>"> -->
      </form>
      <script>
        function submitReplyComment(idVal) {
          var inputBox = document.getElementById(idVal).value;
          if(inputBox != "" && inputBox != null) {
            document.getElementById("ReplyCommentForm<?php echo $CommentID; ?>").submit();
          }
        }
      </script>
    </div>
    <script>
      function ReplyToComment(cmtId) {
        var ReqId = "replyBox".concat(cmtId);
        document.getElementById(ReqId).classList.remove("d-none");
      }
    </script>
  </div>
