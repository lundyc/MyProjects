<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");
include_once("admin_functions.inc.php");

mysql_query("REPLACE INTO `online_users` SET `UserID`='".$_SESSION['uid']."', `page` = '".$_SERVER['QUERY_STRING']."', `lastview` = '".time()."', `ip` = '".ip2long(getip())."';");

//mysql_query("DELETE FROM `online_users` WHERE `UserID` = '".$_SESSION['uid']."'");

setcookie("cookuid", '', time()-3600, '/');
setcookie("cooklogged", '', time()-3600, '/');

session_destroy();
redirect("../index.php", 0);
?>