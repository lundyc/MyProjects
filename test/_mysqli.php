<?php
$DB_NAME = 'subwayir_payroll';
$DB_HOST = 'localhost';
$DB_USER = 'subwayir_payroll';
$DB_PASS = 'piperhill67';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
// Report all PHP errors (see changelog)
error_reporting(E_ALL);

// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
?>