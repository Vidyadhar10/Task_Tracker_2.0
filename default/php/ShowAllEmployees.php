<?php
                  include 'connection.php';
                  $sql = "SELECT * FROM `employeedata` WHERE `isAdmin`=0";
                  $result = $con->query($sql);
                  if (!$result) {
                    die("Invalid query:" . $con->error);
                  }
                  $nu = 1;
                  while ($row = $result->fetch_assoc()) {
                    echo "
                          <td>
                            <a href='users-profile-adminPage.php?id=" . $row["ID"] . "' class='text-primary'>" . $row["EmpName"] . "</a>
                          </td>
                          <td>" . $row["Position"] . "</td> ";
                    if ($row["status"] == 'Assigned') {
                      echo "<td style='padding-top:13px'>
                                <div class='badge bg-success'>Assigned</div>
                                </td>";
                    } else {
                      echo "<td style='padding-top:13px'>
                            <div class='badge bg-danger'>Unassigned</div>
                                </td>";
                    }
                    echo "<td class='text-center'>
                          <span>" . $row["totalTasks"] . "</span>
                          </td>";
                    echo "</tr> ";
                    $nu++;
                  }
                  mysqli_close($con);
?>