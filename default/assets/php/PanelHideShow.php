<?php
if (isset($_SESSION['AdminStatus']) && isset($_SESSION['Mobile_No'])) {

    // include 'assets/php/connection.php';
    $mobileNumber = $_SESSION['Mobile_No'];
    $AdminStatus = $_SESSION['AdminStatus'];
    if ($AdminStatus == 1) {
        echo "<script>
              document.querySelector('#workReport').style.display = 'none';
                </script>";
    } else {
        echo "<script>
                  document.querySelector('#MainThreeModules').style.display='none';
                  document.querySelector('#PartOfMainModules').style.display='none';

                </script>";
    }
} else {
    header("assets/php/logout.php");
}
