<?php
session_start();
session_unset();
session_destroy();

header("Location: ../auth-logout-cover.html");
