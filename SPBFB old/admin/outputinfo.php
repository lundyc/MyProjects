<?php
/*
	header("Expires: Sat, 05 Nov 2005 00:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
*/
include("_mysql.php");
include("_functions.php");
include("_settings.php");

$shout = mysql_query("SELECT * FROM shoutbox ORDER BY `id` DESC");
$bgcolor = "#E2E8EB";

$words = array("chubby", "gay", "porn");
$replacement = array("*", "*", "*"); 

while($s = mysql_fetch_array($shout)) {

str_replace(":-)", ":)", $s['message']);
str_replace($words, $replacement, $s['message']);

$bgcolor = ($bgcolor == "#E2E8EB") ? "#BECCD3" : "#E2E8EB";
?>

<div style="text-align:left; background-color: <?php echo $bgcolor; ?>;">
<span style="font-weight:600;"><?php echo date("d/m g:ia", $s['date']); ?></span>
<span><?php echo IDtoFullName($s['userID']); ?>:</span><br />
<span><?php echo nl2br(icon($s['message'])); ?></span>
</div>
<?php
}

$shoutdeltime = time()-(2*24*60*60);

// Lets delete messages which are read and are older than 30 days
mysql_query("DELETE FROM `shoutbox` WHERE date < $shoutdeltime");

mysql_query("DELETE FROM `msgs` WHERE `status` = 'read' AND date < ".strtotime("last month")."");
mysql_query("DELETE FROM `online_users` WHERE time < $deltime");
mysql_query("DELETE FROM `who_was_online WHERE time < $wasdeltime"); 

if (isset($_SESSION['logged'])) {
// IS ONLINE

if(mysql_num_rows(mysql_query("SELECT userID FROM `online_users` WHERE `userID`='".$_SESSION['uid']."'")) > 0) {

mysql_query("UPDATE `online_users` SET `query` = '".$site."', `time`= '".time()."' WHERE `userID`='".$_SESSION['uid']."'");

}	
else mysql_query("INSERT INTO `online_users` (time, userID, nickname, query, ip) VALUES ('".time()."', '".$_SESSION['uid']."', '".idtoname($_SESSION['uid'])."', '$site', '".getip()."')");
	
// WAS ONLINE
if(mysql_num_rows(mysql_query("SELECT userID FROM `who_was_online` WHERE userID='".$_SESSION['uid']."'")))  
mysql_query("UPDATE `who_was_online` SET time='".time()."', query='$site' WHERE userID='".$_SESSION['uid']."'");
else mysql_query("INSERT INTO `who_was_online` (time, userID, nickname, query) VALUES ('".time()."', '".$_SESSION['uid']."', '".idtoname($_SESSION['uid'])."', '$site')");
} else {
$anz = mysql_num_rows(mysql_query("SELECT `ip` FROM `online_users` WHERE `ip`='".getip()."'"));

if($anz) mysql_query("UPDATE `online_users` SET time='".time()."', query='$site' WHERE ip='".getip()."'");
else mysql_query("INSERT INTO `online_users` (time, ip, query) VALUES ('".time()."','".getip()."', '$site')");
}
?>