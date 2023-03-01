<?php
$DB_NAME = 'spbfb_website2';
$DB_HOST = 'localhost';
$DB_USER = 'spbfb_website';
$DB_PASS = 'e039288466';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

$shopConfig['shippingCost']  = '3.00';

?>