<?php
include 'connection.php';

// $t_id = $_SESSION["t_id"];
// $tnam = $_GET['task'];
// $sql = "SELECT * FROM `subtask` WHERE `Task_id` = '$t_id' ORDER BY `subtask_ID` DESC";
// $result = $con->query($sql);
// if (!$result) {
//   die("Invalid query:" . $con->error);
// }
// $row_id = 1;
// while ($row = $result->fetch_assoc()) {

//   // query for created by name
//   $Creater = $row['Created By'];
//   $QueryCreater = "SELECT * FROM `employeedata` inner join `subtask` on `subtask`.`Created By`=`employeedata`.`ID` WHERE `Created By`='$Creater'";
//   $executeQuery = $con->query($QueryCreater);
//   while ($QueryOutput = $executeQuery->fetch_assoc()) {
//     $CreaterName = $QueryOutput['EmpName'];
//   }

//   // Query for Assignee name
//   $Assigned_To = $row['empid'];
//   $QueryAssignee = "SELECT * FROM `employeedata` inner join `subtask` on `subtask`.`empid`=`employeedata`.`ID` WHERE `empid`='$Assigned_To'";
//   $AssigneeQuery = $con->query($QueryAssignee);
//   while ($AssigneeQueryOutput = $AssigneeQuery->fetch_assoc()) {
//     $AssigneeName = $AssigneeQueryOutput['EmpName'];
//   }

//   //Query for Reporter Name
//   $Report_To = $row['Reporter'];
//   $ReporterQuery = "SELECT * FROM `employeedata` inner join `subtask` on `subtask`.`Reporter`=`employeedata`.`ID` WHERE `Reporter`='$Report_To'";
//   $ReporterQ = $con->query($ReporterQuery);
//   while ($ReporterQOutput = $ReporterQ->fetch_assoc()) {
//     $ReporterName = $ReporterQOutput['EmpName'];
//   }

//   echo "<tr>
//             <td><a href='subtaskatadmin.php?tos=" . $row['subtask_ID'] . "'>" . $row["subtaskname"] . "</a></td>"; 
?>
<?php
//   if (isset($subtaskStages[$row["status"]]['name'])) {
//     $mm = $subtaskStages[$row["status"]]['name'];
//   }
//   $Priority_id = $row['subtaskpriority'];
//   $getText = "SELECT * FROM `subtask_priority` where `ID` = '$Priority_id'";
//   $someText = $con->query($getText);
//   while ($availText = $someText->fetch_assoc()) {
//     $reqText = $availText['Sub_Priority'];
//   }
//   echo "<td>
//         <span class='badge bg-primary'>$reqText<span class='d-none' > ##$mm</span></span>
//         </td>";
// 
?>
 <?php

  //   echo "
  //     <td>$AssigneeName</td>
  //     <td>$ReporterName</td>
  //     <td>$CreaterName</td>
  //     <td>" . date("d-m-Y h:i A", strtotime($row["Created Date"])) . "</td>
  //     <td>" . date("d-m-Y h:i A", strtotime($row["subtaskDue"])) . "</td>
  //     <td>
  //        <a href='#' onclick='DeleteSubtask(" . $row['subtask_ID'] . ")'><i class='fa fa-trash-o'></i></a>
  //     </td>
  //   </tr>";
  //   $row_id++;
  // }
  // // <td class='d-none'>$mm</td>


  $pid = $_POST['pid'];
  $tid = $_POST['tid'];

  $result = mysqli_query($con, "SELECT sub.*,
  emp1.EmpName AS AssigneeName, emp1.ProfilePhoto AS ProfileImageOfAssignee,
  emp2.EmpName AS ReporterName, emp2.ProfilePhoto AS ProfileImageOfReporter,
  emp3.EmpName AS CreatedByName, emp3.ProfilePhoto AS ProfileImageOfCreatedBy,
  subPri.Sub_Priority AS SubTasksPriority,
  subStage.stages AS Subtasks_Stage_status,
  COUNT(CASE WHEN sub.status = 1 THEN 1 ELSE NULL END) AS BacklogCount,
  COUNT(CASE WHEN sub.status = 2 THEN 1 ELSE NULL END) AS InProgressCount,
  COUNT(CASE WHEN sub.status = 3 THEN 1 ELSE NULL END) AS TestingCount,
  COUNT(CASE WHEN sub.status = 4 THEN 1 ELSE NULL END) AS CompletedCount
  FROM subtask AS sub
  INNER JOIN taskdata AS tdt
  ON sub.Task_id = tdt.id
  INNER JOIN projectdata AS pdt
  ON pdt.SrNo = tdt.Project_id
  LEFT JOIN employeedata AS emp1 ON sub.empid = emp1.ID
  LEFT JOIN employeedata AS emp2 ON sub.Reporter = emp2.ID
  LEFT JOIN employeedata AS emp3 ON sub.`Created_By` = emp3.ID
  INNER JOIN subtask_priority as subPri ON subPri.ID = sub.subtaskpriority
  INNER JOIN subtask_stages AS subStage ON subStage.id = sub.status
  WHERE pdt.SrNo = '$pid'
  AND tdt.id = '$tid'
  GROUP BY sub.subtask_ID;");
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $response[] = $row;
    }
  } else {
    $response = array(
      "success" => "no records found",
    );
  }
  mysqli_close($con);
  header('Content-Type: application/json');
  echo json_encode($response);
  ?>