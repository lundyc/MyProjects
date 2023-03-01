 <?php
include("../_mysql.php");
include("../_functions.php");
include("../_settings.php");

header("Cache-Control: no-cache, must-revalidate", true); 
header("Expires: Sat, 1 Jan 2005 00:00:00 GMT");
header("Last-Modified: ".gmdate( "D, d M Y H:i:s")."GMT");
//header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

if (!isset($_SESSION['uid'])) { 
die("YOUR DEAD");
} 

$q = "SELECT 
`online_users`.`userID`, 

(SELECT realname FROM `profile` WHERE mid = `online_users`.`userID`) AS `real_name`, 
(SELECT username FROM `members` WHERE id = `online_users`.`userID`) AS `username`, 
(SELECT picture FROM `profile` WHERE mid = `online_users`.`userID`) AS `picture` 

FROM `online_users` WHERE `userID` > 0 ORDER BY userID";

$ergebnis=mysql_query($q);
while ($ds=mysql_fetch_array($ergebnis)) {
$ds['picture'] = (empty($ds['picture'])) ? "default.jpg" : $ds['picture'];
?>
<div style="padding: 2px;">
<img src="uploads/profiles/<?php echo $ds['picture']; ?>" width="40" height="40" />
<?php
echo $ds['real_name'];
?>
<div style="clear: both;"></div>

</div>
<?php
}

usleep(25000);
?>