<?php
include("../_mysql.php");
include("../_functions.php");
include("../_settings.php");


$q = mysql_query("SELECT * FROM `smilies`");

$string = "[";

while ($r = mysql_fetch_array($q)) { 
$string .= "'". $r['url'] . "', ";
}

$string = substr($string,0,strlen($string) - 2);
$string .= "]";


echo $string;
?>