<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");

mysql_query("DELETE FROM `shoutbox` WHERE `date` < ".strtotime("-8 day"));
?>