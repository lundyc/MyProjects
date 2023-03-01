<?php
include_once("_config.php");

setcookie(session_name(), '', 100);
session_unset();
session_destroy();
$_SESSION = array();
	header("Location: /quiz/index.php");
?>