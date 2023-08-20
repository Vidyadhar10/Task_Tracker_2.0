<?php
session_start();
session_unset();
session_destroy();
// if (isset($_GET['logout'])) {
// //     header("Location: ../../pages-login.html?logout=true");
// // } else {
header("Location: ../../auth-signin-cover.html");
// }
