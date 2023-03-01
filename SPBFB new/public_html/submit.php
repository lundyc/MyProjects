<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require 'lib/password.php';
require '_mysqli.php';

session_start();

if (empty($_POST['email'])) {
echo "no email";
} 

if (empty($_POST['password'])) {
echo "no password";
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
echo "email not valid";
}

$email = $mysqli->real_escape_string($_POST['email']);
$pass = $mysqli->real_escape_string($_POST['password']);

$query = "SELECT `password`, `id` FROM `members` WHERE `email` = '".$email."'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result->num_rows == 1) {

$r = $result->fetch_assoc();

if (password_verify($pass, $r['password'])) {

$_SESSION['userID'] = $r['id'];
echo "ok";
} else {
echo "did you type in the right password?";
}

} else {
echo "cannot find your email";
}
?>