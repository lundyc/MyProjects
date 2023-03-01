<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");
include("admin_functions.inc.php");
include("fckeditor/fckeditor.php") ;

//checkloggedin();

/*
if (!isset($_SESSION['uid'])) {
header("location:../index.php");
} elseif (level($_SESSION['uid']) >= 2) {
isactive();
} else {
header("location:../index.php");
}
*/

checkbanned();
forcelogout();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>SPBFB: Admin Control Panel</title>
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Mon, 06 May 1996 04:57:00 GMT" />
<link rel="stylesheet" type="text/css" href="stylesheets/acp_css.css" media="all" />
<script type="text/javascript" src="scripts/bbcode.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="jquery.jplayer.min.js"></script>




</head>
<body>
<?php
$name = mysql_query("SELECT `realname` FROM `profile` WHERE `mid`='".$_SESSION['uid']."'");
$usr = mysql_fetch_array($name);

$levelarray = array('', 'Band Member', 'Band Committee', 'Administrator', 'Root Administrator', 'Webmaster');
?>

<div id='ipdwrapper'><!-- IPDWRAPPER -->
<!-- TOP TABS -->

<div class='tabwrap-main'>

<div class='logoright'><a href="index.php"><img src='images/banner.png' alt='SPBFB Logo' width="426" height="35" border='0' /></a></div>
</div>
<!-- / TOP TABS -->

<div class='sub-tab-strip'>
<div class='global-memberbar'>
 <a href='http://www.spb-fb.co.uk/' target='_blank'>Back to Homepage</a> &middot;
 <a href='logout.php'>Log Out</a>
</div>
<div class='navwrap'>
Welcome, <strong><?php echo ucfirst($usr['0']); ?></strong> (<?php echo idtoname($_SESSION['uid']); ?>) - Level: <?php echo level($_SESSION['uid']) . " [". $levelarray[level($_SESSION['uid'])]."]"; ?>

</div>

</div>
<div class='outerdiv' id='global-outerdiv'>

<table cellpadding='0' cellspacing='8' width='100%' id='tablewrap'>
<tr> <td width='18%' valign='top' id='leftblock'><?php include_once("layout/menu.php"); ?></td>
 <td width='66%' valign='top' id='rightblock'>
 <div><!-- RIGHT CONTENT BLOCK -->
 <?php
$view = (!isset($_GET['view'])) ? "main" : $_GET['view']; 

$view = htmlentities($view);
$view = addslashes($view);
$view = trim($view);
 
if (isset($_GET['manager'])) {
$manager = addslashes(htmlentities($_GET['manager']));
$file = "modules/". $manager. "/index.php";
}

if (isset($_GET['action'])) {
$action = addslashes(htmlentities($_GET['action']));
$file = "modules/" . $manager ."/". $action. ".php";
} 

if (!isset($file)) { 
$file = "modules/default/index.php";
}

if (file_exists($file)) {
include_once($file);
}
?>


</div>
</td>

<noscript>
<td width='16%' valign='top' id='leftblock'>
<div class='menuouterwrap'>
   <div class='menucatwrap'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/menu_title_bullet.gif' style='vertical-align:bottom' border='0' /> Latest Band News</div>
<table width='100%' cellspacing='0' cellpadding='3' align='center' border='0'>

<?php 
$query = mysql_query("SELECT * FROM `band_news` ORDER BY date desc");
$news = 0; //mysql_num_rows($query);

if ($news == 0) {
echo "<tr><td align=\"center\" >no band news</td></tr>";
}  else {

while ($n = mysql_fetch_array($query)) {

$query2 = mysql_query("SELECT `name` FROM `members` WHERE id = '".$n['uid']."'");
$u = mysql_fetch_array($query2);

$date = explode("-", $n['date']);
$date 	= date("d M Y", mktime(0,0,0, $date['1'], $date['2'], $date['0'])); 

?>
<tr>
<td width="792" >(<?php echo $date; ?>) <strong><?php echo $u['name']; ?></strong></td>
</tr>

<tr>
<td valign='middle' class='menulinkwrap'>
<?php
echo icon(bbcode($n['content'])); 
?></td>
</tr>

<?php
}

}
?>				    
      </table>
</div>
	
	</td>
</noscript>
</tr>
</table>

</div><!-- / OUTERDIV -->
 <div class='copy' align='center'>Saltcoats Protestant Boys Flute Band &copy 2007 </div>
</div><!-- / IPDWRAPPER -->

</body>
</html>


<?php
$site = (isset($_GET['manager'])) ? $_GET['manager'] : "admin";
$timeout = 2; 
$deltime = time()-60;
$wasdeltime = time()-86400;
$ip = getip();


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