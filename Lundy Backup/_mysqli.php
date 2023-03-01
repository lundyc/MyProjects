<?php
$DB_NAME = 'lundy_subway';
$DB_HOST = 'localhost';
$DB_USER = 'lundy_subway';
$DB_PASS = 'e039288466';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}


?>