<?php
include("../_mysql.php");
include("../_functions.php");
include("../_settings.php");

header("Expires: Sat, 1 Jan 2005 00:00:00 GMT");
header("Last-Modified: ".gmdate( "D, d M Y H:i:s")."GMT");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

if (!isset($_SESSION['uid'])) { 
die("YOUR DEAD");
} 

if ($_POST['upcoming'] == "yes") {
mysql_query("INSERT INTO `band_notes` (`EventID` ,`UserID` ,`Body` ) VALUES ('".$_POST['EventID']."', '".$_SESSION['uid']."', '".$_POST['CommentsBody']."');");
?>
<div style="border-bottom: 1px solid #666; margin: 2px;">
<span style="width:25%; float: left; padding-left: 5px;"><strong><?php echo IDtoFullName($_SESSION['uid']); ?></strong></span>
<span style="width:75%; float:right;"><?php echo icon($_POST['CommentsBody']);  ?></span>
</div>
<?php
} else {
mysql_query("INSERT INTO `shoutbox` (`userID`, `date`, `message`) VALUES ('".$_SESSION['uid']."', '".time()."', '".$_POST['message']."')") or die("Cannot Post");
}

?>