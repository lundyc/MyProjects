<?php
define ("INDEX_CHECK", 1);
include_once("../conf.inc.php");
include_once("../functions.inc.php");

//above lines check to see if user Ip is in banned IPs
if (mysql_num_rows(mysql_query("SELECT * FROM `banned_ip` WHERE IP='".getip()."'")) > 0) {
echo "It seems you have been banned from viewing this website."; 
echo "<br />"; 
echo "If you think you have been banned in error please contact me. admin@spb-fb.co.uk"; 
exit();
}
?>

  <html>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  <style>
 table, tr, td {
  vertical-align: top;
  }
  </style>
  
  <SCRIPT TYPE="text/javascript">
  <!-- Hide script from older browsers

function toggleMenu(currMenu) {
	if (document.getElementById) {
		thisMenu = document.getElementById(currMenu).style
		if (thisMenu.display == "block") {
			thisMenu.display = "none"
		}
		else {
			thisMenu.display = "block"
		}
		return false
	}
	else {
		return true
	}
}

  function popupform(myform, windowname)
  {
  if (! window.focus)return true;
    window.open('', windowname, 'height=400,width=720,scrollbars=yes');
    myform.target=windowname;
    return true;
  }
	// End hiding script -->
  </SCRIPT>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>SPB-FB Control Panel - BETA </title>
  <link href="lib/admin_style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" language="JavaScript" src="validate.js"></script>
  </head>
  <body>
    <div align="center">
    <div class="topdiv">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>    
      <td width="212" rowspan="2"><img src="cp_logo.gif" alt="XippY" width="212" height="68" />
        <div id="topNav">	

	<ul>
  <li><a href=''>Home</a></li>
  <li><a href="">BB Code / Icons</a></li>
  </ul>		
		<br />

  <ul>
  <li><a href="">Set Match Availability</a></li>
  <li><a href="">Training Schedule</a></li>
  <li><a href="">Clan Costs</a></li>
  <li><a href="">Message Centre (<font color=#000000>0</font> new)</a></li>
  <li><a href="">Change Your Password</a></li>
  </ul>
  <br />

  <ul>
  <li><a href="#" onClick="return toggleMenu('menu2')">News</a></li>
  <span id="menu2" class="menu">
  <li><a href=''>Manage News Categories</a></li>
  <li><a href=''>Manage News Articles</a></li>
  <li><a href=''>Add a News Article</a></li>
<br />
  </span>
  
  <li><a href="">Users</a></li>
  <li><a href="">Ranks&nbsp;/&nbsp;Permissions</a></li>
  <li><a href="">Manage Results</a></li>
  <li><a href="">Manage Fixtures</a></li>
  <li><a href="">Squads</a></li>
  <li><a href="">ED&nbsp;Ranks</a></li>
  <li><a href="">Forum</a></li>
  <li><a href="">Shoutbox</a></li>
  <li><a href="">Quick&nbsp;Details</a></li>
  <li><a href="">Unique&nbsp;IDs</a></li>
  <li><a href="">Polls</a></li>
  <li><a href="">Adverts</a></li>
  <li><a href="">Imagebank</a></li>
  <li><a href="">Match&nbsp;Types</a></li>
  <li><a href="">Custom&nbsp;Pages</a></li>
  <li><a href="">Banner&nbsp;/&nbsp;Themes</a></li>
  <li><a href="">IP/Email Bans</a></li>
  <li><a href="">About&nbsp;Us / Achievements</a></li>
  <li><a href="">Main Settings</a></li>
  <li><a href="">Clan Events</a></li>
  <li><a href="">Clan Costs / Donations</a></li>
  <li><a href="">Clan Training</a></li>
  <li><a href="">Server Monitors</a></li>
  <li><a href="">Control Panel Logs</a></li>
  </ul>
          </div></td>
      <td>&nbsp;</td>
      <td style="border-right: 1px solid #999;">&nbsp;</td>
      <td rowspan="2" valign="top" style="padding-top: 5px;">

	  <table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#f2f2f2" style="border-bottom: 1px solid black">
  <tr valign="middle">
  <td width="33%" align="left" nowrap="nowrap">
  <img src="arrow_r.gif" width="15" height="15" align="top"/>  <strong>SPB FB</strong> - Admin CP - Version: <?php echo $s['version']; ?></td>
  <td width="33%" align="center" nowrap="nowrap">
  <strong>Logged in as: </strong><?php echo idtoname(1);//$_SESSION['uid']); ?>  </td>
  <td width="33%" align="right" nowrap="nowrap">
  <a href="logout.php">Logout</a>&nbsp;&nbsp;  </td>
  </tr>
      </table>	  <?php
$view = htmlentities(addslashes(trim($_GET['page'])));
if (!$view) { $view = "main"; }
if (file_exists("modules/" . $view . ".php")) {
include_once ("modules/" . $view . ".php");
} else {
include_once ("modules/error.php");
}
?></td>
    </tr>
    <tr>
      <td>      
    <td>&nbsp;</td>
      <td style="border-right: 1px solid #999;">&nbsp;</td>
      </tr>
    </table>
      </div>
  		<br />
  		  <div class="footer"><br />© XippY Clan Solutions 2005 - 2008<br /><br /></div>
  </div>
  