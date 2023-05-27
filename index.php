<?php
error_reporting(0);
$logFile = 'data.log';
$userIP = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$date = date('Y-m-d');
$time = date('H:i:s');

$logData = "$userIP,$userAgent,$date,$time\n";
file_put_contents($logFile, $logData, FILE_APPEND);

header('Location: login.php');
exit();
?>