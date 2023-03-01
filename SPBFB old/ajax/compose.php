<?php
include("../_mysql.php");
include("../_functions.php");
include("../_settings.php");

$result = mysql_query("select `mid`,`realname`, `picture` from `profile` where realname like '".mysql_real_escape_string($_GET['query'])."%'");
while ($row = mysql_fetch_assoc($result)) {

$data[] = $row['mid'];
$suggestions[] = $row['realname'];
}

$posts = array("query" => $_GET['query'], "suggestions" => $suggestions, "data" => $data);

echo json_encode($posts);
mysql_close($link);
?>
