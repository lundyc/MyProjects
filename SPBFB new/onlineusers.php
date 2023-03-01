<?php
include("_mysqli.php");
session_start();

header("Cache-Control: no-cache, must-revalidate", true); 
header("Expires: Sat, 1 Jan 2005 00:00:00 GMT");
header("Last-Modified: ".gmdate( "D, d M Y H:i:s")."GMT");
//header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

if (!isset($_SESSION['userID'])) { 
die("YOUR DEAD");
} 

$deltime = time()-60;
$wasdeltime = time()-86400;

$mysqli->query("DELETE FROM `online_users` WHERE time < $deltime");
//$mysqli->query("DELETE FROM `who_was_online WHERE time < $wasdeltime"); 

if (isset($_SESSION['userID'])) {
// IS ONLINE
$online = $mysqli->query("SELECT `userID` FROM `online_users` WHERE `userID` = '". $_SESSION['userID'] ."';");
if ($online->num_rows > 0) {
$mysqli->query("UPDATE `online_users` SET `time`= UNIX_TIMESTAMP() WHERE `userID`='".$_SESSION['userID']."'");
} else {
$mysqli->query("INSERT INTO `online_users` (time, userID) VALUES (UNIX_TIMESTAMP(), '".$_SESSION['userID']."')");
}

// WAS ONLINE
/*$wasonline = $mysqli->query("SELECT `userID` FROM `who_was_online` WHERE `userID` = '". $_SESSION['userID'] ."'");
if ($wasonline->num_rows) {
$mysqli->query("UPDATE `who_was_online` SET `time` = UNIX_TIMESTAMP() WHERE `userID` = '". $_SESSION['userID']."'");
} else {
$mysqli->query("INSERT INTO `who_was_online` (`time`, `userID`) VALUES (UNIX_TIMESTAMP(), '". $_SESSION['userID']."');");
}
*/

}
$q = "SELECT 
`online_users`.`userID`, 

(SELECT realname FROM `profile` WHERE mid = `online_users`.`userID`) AS `real_name`, 
(SELECT username FROM `members` WHERE id = `online_users`.`userID`) AS `username`, 
(SELECT picture FROM `profile` WHERE mid = `online_users`.`userID`) AS `picture` 

FROM `online_users` WHERE `userID` > 0 ORDER BY userID";

$res = $mysqli->query($q);
while($ds = $res->fetch_assoc()){
$ds['picture'] = (empty($ds['picture'])) ? "default.jpg" : $ds['picture'];
$name = explode(" ", $ds['real_name']);

?>
<div style="padding: 2px; margin-bottom: 3px; border-bottom: 1px solid #ccc;">
<img src="userfiles/profiles/<?php echo $ds['picture']; ?>" width="30" height="30" align="left" />
<big><?php echo $name[0]; ?> <br> <?php echo $name[1]; echo (isset($name[2])) ? ' ' . $name[2] : ''; ?></big>
<div style="clear: both;"></div>
</div>
<?php
}

usleep(25000);
?>