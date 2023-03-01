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

$parent = ($_POST['reply'] == "yes") ? $_POST['id'] : 0;

mysql_query("INSERT INTO `msgs` (`parent`,`to`, `from`, `subject`, `content`, `date`) VALUES 
('".$parent."', '".$_POST['senditto']."', '".$_SESSION['uid']."', '".$_POST['subject']."', '".$_POST['content']."', '".time()."') "); 

if( $parent == 0) {
	$parent = mysql_insert_id();
	mysql_query("UPDATE `msgs` SET `parent` = ".$parent." WHERE `id` = ".$parent.";");
}

?>

<table width="100%" border="0" cellpadding="5" cellspacing="5">
<TR>
<td style="width: 15%; vertical-align:top;">
<?php
echo ($_SESSION['uid'] == 0) ? "<i>SPB Webmaster</i>" : "<a href='./?view=profile&id=".$_SESSION['uid']."'>".IDtoName($_SESSION['uid'])."</a>";
?>
<br />
<span style="font-size: 10px; color:#999999;"><?php echo "Today, " . date("g:i A"); ?></span>
</td>

<td style="width: 85%; vertical-align:top; border-bottom: 1px solid #999999;">
<?php 
echo nl2br(wordwrap($_POST['content'], 75, "\n", true)); ?></td>
</TR>
</table>