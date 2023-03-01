<?php 
error_reporting(E_ALL ^ E_NOTICE); 

$toEmail = "colin@lundy.me.uk";

$email = "webmaster@mobile-smiles.co.uk";
$headers = "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n";

mail($toEmail, "test", "Test message", $headers);

echo "Email sent to " . $toEmail;
?>