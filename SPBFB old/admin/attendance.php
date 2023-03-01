<?php
include("_mysql.php");

error_reporting(E_ALL);

mysql_connect($host, $user, $pwd) or die('ERROR: Can not connect to MySQL-Server');
mysql_select_db($db) or die('ERROR: Can not connect to database "'.$db.'"');

if(!empty($_GET['attend'])){

if ($_GET['attend'] == "Delete") {
$q = "DELETE FROM `attendance` WHERE `UserID` = '".$_GET['UserID']."' AND `PracID` = '".$_GET['PracID']."'";
} else {
$q = "INSERT INTO `attendance` (`UserID` ,`PracID` ,`attended`) VALUES ('".$_GET['UserID']."', '".$_GET['PracID']."', '".$_GET['attend']."');";
}

$result = mysql_query($q);
}
?>