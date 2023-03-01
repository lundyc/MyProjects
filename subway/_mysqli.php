<?php
session_start();

$_SESSION['logged_in'] = 1;

$DB_NAME = 'lundy_nabb';
$DB_HOST = 'localhost';
$DB_USER = 'lundy_nabb';
$DB_PASS = 'uownitall';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

$shopConfig['shippingCost']  = '3.00';

?>