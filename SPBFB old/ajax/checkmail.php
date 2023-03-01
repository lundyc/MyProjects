<?php
include("../_mysql.php");

$link = mysql_connect($host, $user, $pwd);
mysql_select_db($db);

echo mysql_num_rows(mysql_query("SELECT `id` FROM `msgs` WHERE `to` = '".$_GET['UserID']."' AND status='unread'"));

mysql_close($link);
?>