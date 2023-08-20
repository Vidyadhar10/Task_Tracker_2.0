<?php
 include 'connection.php';
                        $yo =  $_SESSION["p_id"];
                        $sq = "SELECT * FROM `projectdata` WHERE `SrNo`= $yo";
                        $rees = $con->query($sq);
                        $ytc = array();
                        if (!$rees) {
                            die("Invalid query:" . $con->error);
                        }
                        while ($rod = $rees->fetch_assoc()) {
                            if (mysqli_num_rows($rees) > 0) {
                                $my_array = explode(";", $rod['assigned_emp']);
                                for ($i = 0; $i < count($my_array); $i++) {
                                    array_push($ytc, (int) $my_array[$i]);
                                }
                            }
                        }
                        $k=1;
                         for ($j=0; $j<count($ytc); $j++) {
                         $sql = "SELECT * FROM `employeedata`WHERE ID=$ytc[$j] AND `isAdmin`=false";
                         $result = $con->query($sql);
                         if (!$result) {
                             die("Invalid query:".$con->error);
                         }
                         while($row = $result->fetch_assoc()){
                             echo "<tr>
                                 <th class='text-center'  scope=`row`><a href=`#`>$k</a></th>
                                 <td>" . $row["EmpName"] . "</td>
                                 <td class='text-center' ><a href=`#` class=`text-primary`>" . $row["Position"] . "</a></td>     
                                 </tr>";
                         }
                         $k++;
                        }
?>
