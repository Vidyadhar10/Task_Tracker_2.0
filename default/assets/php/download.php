<?php
$filePath = $_GET['FPath']; // Replace with the actual file path
$fileName = $_GET['FName'];   // Replace with the desired file name for download

// Send appropriate headers for download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . filesize($filePath));

// Output the file content
readfile($filePath);
