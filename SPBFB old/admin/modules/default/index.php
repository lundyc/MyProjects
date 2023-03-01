<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
.style2 {
	color: #00FF00;
	font-weight: bold;
}
-->
</style>

<div style='font-size:30px; padding-left:7px; letter-spacing:-2px; border-bottom:1px solid #EDEDED'>
 Welcome to the SPBFB Admin Panel
</div>

<br />


<div class='homepage_pane_border'>
<div class='homepage_section'>Common Actions</div>
<table width='100%' cellspacing='0' cellpadding='4' id='common_actions'>
<tr>
<td width='33%' valign='top'>
<div>
<a href='./?manager=practice' title='Manage Next Practice'>
<img src='images/tabs_main/practice.png' alt='Manage Next Practice' width="26" height="26" border='0' /> Manage Next Practice</a></div>
<div>
<a href='./?manager=guestbook' title='Manage Guestbook'>
<img src='images/tabs_main/epiphany-bookmarks.png' alt='Manage Guestbook' width="26" height="26" border='0' /> Manage Guestbook</a></div>
</td>
<td width='33%' valign='top'>
<div><a href='./?manager=gallery' title='Manage Gallery'><img src='images/tabs_main/gallery.png' alt='Manage Gallery' width="26" height="26" border='0' /> Manage Gallery </a></div>

<div>
<a href='./?manager=parades' title='Manage Events'>
<img src='images/tabs_main/events.png' alt='Manage Events' width="26" height="26" border='0' /> Manage Events</a></div>
</td>
<td width="33%" valign="top">
<div><a href='index.php?manager=attendance' title='Attendance Manager'><img src='images/tabs_main/events.png' border='0' alt='Attendance Manager' /> Attendance Manager</a></div>	
<div><a href='./?manager=members&action=add' title='Add Member'><img src='images/tabs_main/user-icon.png' alt='Add Member' width="26" height="26" border='0' /> Add Member</a></div>
</td>
</tr>
</table>
</div>

<noscript>
<div class='homepage_pane_border'>
		 <div class='homepage_section'>Common Actions</div>
		 <table width='100%' cellspacing='0' cellpadding='4' id='common_actions'>
			 <tr>
			  <td width='33%' valign='top'>
				<div><a href='#' title='Manage Members'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/members.png' alt='Manage Members' width="24" height="24" border='0' /> Manage Members</a></div>
				<div><a href='index.php?view=parades' title='Process Validating Members'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/forums.png' alt='Process Validating Members' width="24" height="24" border='0' /> Manage Parades </a></div>
				<div><a href='index.php?view=gallery_pictures' title='Manage Forums'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/skins.png' alt='Manage Forums' width="24" height="24" border='0' /> Manage Gallery </a></div>			</td>
			<td width='33%' valign='top'>
				<div><a href='index.php?view=news' title='Edit System Settings'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/emos.png' alt='Edit System Settings' width="24" height="24" border='0' /> Manage News </a></div>
				<div><a href='index.php?view=edithistory' title='Language Manager'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/languages.png' border='0' alt='Language Manager' /> Information Manager</a></div>
				<div><a href='#' title='Bulk Mailer'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/bulkmail.png' border='0' alt='Bulk Mailer' /> Bulk Mailer</a></div>			</td>
			<td width='33%' valign='top'>
				<div><a href='index.php?view=guestbook' title='Manage Groups'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/groups.png' border='0' alt='Manage Groups' /> Manage Guestbook</a></div>
				<div><a href='#' title='Language Manager'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/settings.png' alt='Language Manager' width="24" height="24" border='0' /> Edit System Settings </a></div>
				<div><a href='index.php?view=bandnews' title='Emoticon Manager'><img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/folder_components/index/emos.png' border='0' alt='Emoticon Manager' /> Band News Manager</a></div>			 </tr>
		 </table>
</div>
</noscript>

<br />

<?php
# News 
$news_numrows = mysql_num_rows(mysql_query("SELECT `id` FROM `news`"));

# Events
$upcoming_numrows = mysql_num_rows(mysql_query("SELECT `id` FROM `events` WHERE status='0'"));
$finshed_numrows = mysql_num_rows(mysql_query("SELECT `id` FROM `events` WHERE status='1'"));
$reports_numrows = mysql_num_rows(mysql_query("SELECT `report` FROM `events_reports`, `events` WHERE events.status='1' AND events_reports.EventID=events.id AND CHAR_LENGTH(report) = 0;"));

# Gallery
$cat_numrows = mysql_num_rows(mysql_query("SELECT `cid` FROM `gallery_categories`"));
$gallery_numrows = mysql_num_rows(mysql_query("SELECT `id` FROM `gallery`"));

# Guestbook
$guestposts_numrows = mysql_num_rows(mysql_query("SELECT `id` FROM `guestbook`"));
$gueststatus0_numrows = mysql_num_rows(mysql_query("SELECT `id` FROM `guestbook` WHERE status='0'"));

# Members
$users_numrows = mysql_num_rows(mysql_query("SELECT `id` FROM `members`"));

# This will only display to Colin Lundy
if ($_SESSION['uid'] == 1) {
?>
<div class='homepage_pane_border'>
<div class='homepage_section'>Lundy's Actions</div>
<table width='100%' cellspacing='0' cellpadding='4' id='common_actions'>
<tr>
<td width='33%' valign='top'>
<div>
<a href="./?manager=todo">
<img src='images/tabs_main/logs.png' alt='Todo List' width="24" height="24" border='0' /> Todo List</a>
</div>
</td>
<td width="33%" valign="top">
<div>
<a href='./?manager=logs' title='Control Panel Logs'><img src='images/tabs_main/logs.png' alt='Control Panel Logs' width="24" height="24" border='0' /> Panel Logs</a></div>
</td>
<td width="33%" valign="top">
<div>
<a href='./?manager=settings' title='Edit System Settings'><img src='images/tabs_main/logs.png' alt='Edit System Settings' width="24" height="24" border='0' /> Edit System Settings</a></div>
</td>
</tr>
</table>
</div>
<br />

<?php
}
?>
<div class='tableheaderalt'>Quick Overview </div>
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>

<tr>
<td class='tablerow1'  width='25%'  valign='middle'>News Posts </td>
<td class='tablerow2'  width='25%'  valign='middle'><?php echo $news_numrows; ?></td>
<td width="25%" class='tablerow1'>Members</td>
<td width="25%" class='tablerow2'><?php echo $users_numrows;?></td>
</tr> 
 
 
<tr>
<td class='tablerow1'  valign='middle'>Band Information </td>
<td colspan="3"  valign='middle' class='tablerow2'><?PHP
$grabinfo = mysql_query("SELECT * FROM `info` ORDER BY `id` ASC");
$info_rows = mysql_num_rows($grabinfo);
while ($info = mysql_fetch_array($grabinfo)) {
$img = (strlen($info['content']) > 0) ? "tick" : "exclamation";

echo $info['title'] . " <img src='images/".$img.".png' /> &nbsp;&nbsp;";
}
?></td>
</tr>
<tr>
<td class='tablerow1'  valign='middle'>Parades</td>
<td colspan="3"  valign='middle' class='tablerow2'>Upcoming:
  <?=$upcoming_numrows;?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
-  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
Finshed:
<?=$finshed_numrows;?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
-  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if ($reports_numrows > 0) {
echo "<span style='color: #DE381B; font-size: larger; font-weight: bold; '>";
}
?>
Reports needing Entered: : <?php echo $reports_numrows; ?>
<?php
if ($reports_numrows > 0) {
echo "</span>";
}
?></td>
</tr>
<tr>
<td class='tablerow1'  valign='middle'>Gallery</td>
<td colspan="3"  valign='middle' class='tablerow2'>Categories: <?php echo $cat_numrows; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
-  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
Pictures:
<?=$gallery_numrows; ?></td>
</tr>
<tr>
<td class='tablerow1'  valign='middle'>Guestbook</td>
<td colspan="3"  valign='middle' class='tablerow2'>Posts: <?php echo $guestposts_numrows; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
-  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if ($gueststatus0_numrows > 0) {
echo "<span style='color: #DE381B; font-size: larger; font-weight: bold; '>";
}
?>
Posts in need of Validated: <?php echo $gueststatus0_numrows; ?>
<?php
if ($gueststatus0_numrows > 0) {
echo "</span>";
}
?></td>
</tr>
 
 <noscript>
 <tr>
  <td class='tablerow1'>&nbsp;&nbsp;&#124;-Awaiting Validation</td>
  <td colspan="3" class='tablerow2'><?php echo $validating_numrows; ?></td>
  </tr>
 </noscript>
</table>
