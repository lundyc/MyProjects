<?php
/*
Quiz Game by Colin Lundy

This page is for connecting to the Database .......
*/
session_start();

$db_host = '213.171.200.96';
$db_name = 'quiz';
$db_user = 'quiz_user';
$db_pass = 'James123@';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($mysqli->connect_errno)
{
    echo "<b>Failed to connect to MySQL:</b> " . $mysqli->connect_error;
    exit();
}

ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>