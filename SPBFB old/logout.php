<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");
systeminc('globals.inc');

mysql_query("UPDATE `members` SET `force_logout` = '0' WHERE `id` = '".$_SESSION['uid']."'");
mysql_query("DELETE FROM `online_users` WHERE `UserID` = '".$_SESSION['uid']."'");

// WAS ONLINE
if(mysql_num_rows(mysql_query("SELECT userID FROM `who_was_online` WHERE userID='".$_SESSION['uid']."'")))  
mysql_query("UPDATE `who_was_online` SET time='".time()."' WHERE userID='".$_SESSION['uid']."'");
else mysql_query("INSERT INTO `who_was_online` (time, userID, nickname) VALUES ('".time()."', '".$_SESSION['uid']."', '".idtoname($_SESSION['uid'])."')");

setcookie("cookuid", '', time()-3600, '/');
setcookie("cooklogged", '', time()-3600, '/');

session_destroy();
header("location: index.php");
?>
