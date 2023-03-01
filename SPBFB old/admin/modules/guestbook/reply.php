<?php
if (level($_SESSION['uid']) < 3) { 
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_GET['id'])) {


if (isset($_POST['action']) && $_POST['action'] == "doedit") {
$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['FCKeditor1'])) {
$_SESSION['error'] .= "<li>Please enter some Information</li>\n";
$error = 1;
}


if ($error == 0) {
$mainbody = checkquotes($_POST['FCKeditor1']);


mysql_query("INSERT INTO `guestbook_reply` (`replyto`, `date`, `author`, `ip`, `message`) VALUES ('".$_GET['id']."', '".date("Y-m-d")."', '".$_SESSION['uid']."', '".getip()."', '$mainbody');") or die(mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your information has been edited.
 </p>
</div>
<br>
<?php
unset($_SESSION['error']);
redirect("index.php?manager=guestbook", 5);
} else {
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Error Message</h2>
 <p>
 	<br />
There was a error with your form submission. Please check the following errors.<br>
<br>
<?php echo $_SESSION['error'];?>
 </p>
</div>
<br>

<?php
unset($_SESSION['error']);

$query = mysql_query("SELECT * FROM `guestbook` WHERE `id`='".$_GET['id']."'");
$r = mysql_fetch_array($query);

$query3 = mysql_query("SELECT * FROM `flags` WHERE `id` = '".$r['location']."' LIMIT 1;");
$results = mysql_fetch_array($query3);
  
  $date = explode("-", $r['date']);
$date 	= date("d M Y", mktime(0,0,0, $date['1'], $date['2'], $date['0'])); 

?>
<div class='tableborder'>
<div class='tableheaderalt'>Guestbook Entry Overview </div>

<table cellpadding='4' cellspacing='0' width='100%'>
<td width='30%' valign="top" class='tablerow1'>ID</td>
<td width='70%' class='tablerow2'><?php echo str_pad($r['id'], 5, "0", STR_PAD_LEFT);  ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'>Status</td>
<td class='tablerow2'><?php echo ($r['status'] == 1) ? "Accepted" : "Awaiting Acceptance"; ?></td>
</tr>	

<tr>
<td valign="top" class='tablerow1'>Date Submitted</td>
<td class='tablerow2'><?php echo $date; ?></td>
</tr>                

<tr>
<td valign="top" class='tablerow1'>Name</td>
<td class='tablerow2'><?php echo $r['author']; ?></td>
</tr>


<tr>
<td valign="top" class='tablerow1'>Email</td>
<td class='tablerow2'><?php echo (strlen($r['email']) > 0) ? $r['email'] : "N/A"; ?></td>
</tr>


<tr>
<td colspan="2" class='tablerow2'>
<?php echo nl2br(stripslashes(BBcode(icon($r['message'])))); ?></td>
</tr>			
</table>

</div>
<br />

<div class='tableborder'>
<div class='tableheaderalt'>Reply to Post </div>
<form method="post" name="post" action="index.php?view=admin&manager=guestbook&action=reply&id=<?php echo $_GET['id']; ?>">
<input type="hidden" name="action" value="doedit">
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 500;
$oFCKeditor->Value = '' ;
$oFCKeditor->Create() ;
?>
<table width="100%">
<tr><td align='center' class='tablesubheader' colspan='2' ><input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td></tr>
</table>
</form>
</div>
<?php
}

} else {

$query = mysql_query("SELECT * FROM `guestbook` WHERE `id`='".$_GET['id']."'");
$r = mysql_fetch_array($query);

$query3 = mysql_query("SELECT * FROM `flags` WHERE `id` = '".$r['location']."' LIMIT 1;");
$results = mysql_fetch_array($query3);
  
  $date = explode("-", $r['date']);
$date 	= date("d M Y", mktime(0,0,0, $date['1'], $date['2'], $date['0'])); 

?>
<div class='tableborder'>
<div class='tableheaderalt'>Guestbook Entry Overview </div>

<table cellpadding='4' cellspacing='0' width='100%'>
<td width='30%' valign="top" class='tablerow1'>ID</td>
<td width='70%' class='tablerow2'><?php echo str_pad($r['id'], 5, "0", STR_PAD_LEFT);  ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'>Status</td>
<td class='tablerow2'><?php echo ($r['status'] == 1) ? "Accepted" : "Awaiting Acceptance"; ?></td>
</tr>	

<tr>
<td valign="top" class='tablerow1'>Date Submitted</td>
<td class='tablerow2'><?php echo $date; ?></td>
</tr>                

<tr>
<td valign="top" class='tablerow1'>Name</td>
<td class='tablerow2'><?php echo $r['author']; ?></td>
</tr>


<tr>
<td valign="top" class='tablerow1'>Email</td>
<td class='tablerow2'><?php echo (strlen($r['email']) > 0) ? $r['email'] : "N/A"; ?></td>
</tr>


<tr>
<td colspan="2" class='tablerow2'>
<?php echo nl2br(stripslashes(BBcode(icon($r['message'])))); ?></td>
</tr>			
</table>

</div>
<br />

<div class='tableborder'>
<div class='tableheaderalt'>Reply to Post </div>
<form method="post" name="post" action="index.php?view=admin&manager=guestbook&action=reply&id=<?php echo $_GET['id']; ?>">
<input type="hidden" name="action" value="doedit">
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 500;
$oFCKeditor->Value = '' ;
$oFCKeditor->Create() ;
?>
<table width="100%">
<tr><td align='center' class='tablesubheader' colspan='2' ><input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td></tr>
</table>
</form>
</div>

<?php
}

} else {
?>
We could not find the post you were looking for because the ID is not numeric. This has been logged and forwarded to a admin.
<?php
}
?>