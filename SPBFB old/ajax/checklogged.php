<?php
include("../_mysql.php");

$link = mysql_connect($host, $user, $pwd);
mysql_select_db($db);


$query2 = mysql_query("SELECT `force_logout` FROM `members` WHERE id = '{$_GET['UserID']}'");
$result = mysql_fetch_row($query2);

if ($result['0'] == 1) {
echo "yes";
} else {
echo "no";
}

mysql_close($link);
?>