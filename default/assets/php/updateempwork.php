<?php
 include 'connection.php';
                        // $yo =  $_SESSION["p_id"];
                        $sq = "SELECT * FROM `projectdata`";
                        $rees = $con->query($sq);
                        $ytc = array();
                        if (!$rees) {
                            die("Invalid query:" . $con->error);
                        }
                        while ($rod = $rees->fetch_assoc()) {
                            if (mysqli_num_rows($rees) > 0) {
                                 $yo=$rod['SrNo'];
                                $my_array = explode(";", $rod['assigned_emp']);
                                for ($i = 0; $i < count($my_array); $i++) {
                                    array_push($ytc, (int) $my_array[$i]);
                                        $swq = "INSERT INTO `empwork`( `Emp_ID`, `Project_ID`) VALUES ('$ytc[$i]','$yo')";
                                        mysqli_query($con,$swq);}
                                }
                            }                   
?>
