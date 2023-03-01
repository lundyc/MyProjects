<?php
if (level($_SESSION['uid']) >= 3) { 

if (isset($_GET['id'])) {

if (isset($_POST['action']) && $_POST['action'] == "doedit") {

$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['author'])) {
$_SESSION['error'] .= "<li>Please enter a Author</li>\n";
$error = 1;
}

if (empty($_POST['FCKeditor1'])) {
$_SESSION['error'] .= "<li>Please enter a message</li>\n";
$error = 1;
}

if (empty($error)) {
$author = trim(addslashes(htmlentities($_POST['author'], ENT_QUOTES)));
$email = trim(addslashes(htmlentities($_POST['email'], ENT_QUOTES)));
$location = $_POST['location'];
$content = trim(addslashes($_POST['FCKeditor1']));

mysql_query("UPDATE `guestbook` SET `author` = '".$author."', `email` = '".$email."', `location` = '".$location."', `message` = '$content' WHERE `id` =".(int)$_GET['id']." LIMIT 1 ;") or die("Error: " . mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your guestbook entry has been edited.
 </p>
</div>
<br>

<?php
redirect("index.php?manager=guestbook", 3);
} else {
$query = mysql_query("SELECT * FROM `guestbook` WHERE id = '".(int)$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (!$r) {
die("This post does not exisit or has been removed by the admin");
}

$date = explode("-", $r['date']);
$date = date("d.M.Y", mktime(0,0,0, $date['1'], $date['2'], $date['0']));

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

<div class='tableborder'>
 <div class='tableheaderalt'>Edit Guestbook Entry</div>


<form method="post" name="post" action="index.php?manager=guestbook&action=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return checkForm(this)">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='25%'  valign='middle'><b>ID</b></td>
<td width="35%" class='tablerow2'><?php echo str_pad($r['id'], 5, "0", STR_PAD_LEFT);  ?></td>
<td width="19%" valign="top" class='tablerow1'><strong>IP</strong></td>
<td width="21%" class='tablerow2'><?php echo $r['ip']; ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'><strong>Name</strong></td>
<td class='tablerow2' colspan="3"><input name="author" type="text" value="<?php echo $r['author']; ?>" size="64" maxlength="64" /></td>
</tr>

<tr>
<td valign="top" class='tablerow1'><strong>Email</strong></td>
<td class='tablerow2' colspan="3"><input name="email" type="text" value="<?php echo $r['email']; ?>" size="64" maxlength="64"  /></td>
</tr>


<tr>
<td valign="top" class='tablerow1'><strong>Date Submitted</strong></td>
<td valign='middle' colspan="3" class='tablerow2'><?php echo $date; ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'><strong>Location</strong></td>
<td valign='middle' colspan="3" class='tablerow2'>
<select name="location">
<?php
$q = mysql_query("SELECT * FROM `flags` ORDER BY name ASC");
while ($fl = mysql_fetch_array($q)) {

if ($fl['id'] == $r['location']){
$checked = "selected";
} else {
$checked = "";
}
?>
<option value="<?php echo $fl['id']; ?>" <?php echo $checked; ?> /><?php echo $fl['name']; ?></option><?php echo "\n"; ?>
<?php
}
?>
</select></td>
</tr>

<tr>
<td colspan="4" valign="top" class='tablerow1'>
<strong>Guestbook Message</strong> - This is the message from the User.</td>
</tr>


  <tr>
<td colspan="4" class='tablerow2' valign='middle' align="center"><?PHP echo buttonBB("MainBody"); ?></td>
  </tr>
  
  <tr>
    <td align="center" valign="top" class='tablerow1'><?PHP echo smiley("MainBody"); ?></td>
    <td align="center" valign="top" class='tablerow1' colspan="3">	<textarea name="MainBody" id="MainBody" rows="15" wrap="virtual" style="width:450px; height: 220px; overflow:auto;" tabindex="3" class="form_table" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"><?=$r['message']?></textarea></td>
  </tr>
  
<tr><td align='center' class='tablesubheader' colspan='4' ><input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td></tr>
</table>
</form>



<?php
}

} else {

$query = mysql_query("SELECT * FROM `guestbook` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (!$r) {
die("This post does not exisit or has been removed by the admin");
}

$date = explode("-", $r['date']);
$date = date("d.M.Y", mktime(0,0,0, $date['1'], $date['2'], $date['0']));

?>

<div class='tableborder'>
 <div class='tableheaderalt'>Edit Guestbook Entry</div>


<form method="post" name="post" action="index.php?manager=guestbook&action=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return checkForm(this)">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='25%'  valign='middle'><b>ID</b></td>
<td width="35%" class='tablerow2'><?php echo str_pad($r['id'], 5, "0", STR_PAD_LEFT);  ?></td>
<td width="19%" valign="top" class='tablerow1'><strong>IP</strong></td>
<td width="21%" class='tablerow2'><?php echo $r['ip']; ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'><strong>Name</strong></td>
<td class='tablerow2' colspan="3"><input name="author" type="text" value="<?php echo $r['author']; ?>" size="64" maxlength="64" /></td>
</tr>

<tr>
<td valign="top" class='tablerow1'><strong>Email</strong></td>
<td class='tablerow2' colspan="3"><input name="email" type="text" value="<?php echo $r['email']; ?>" size="64" maxlength="64"  /></td>
</tr>

<tr>
<td valign="top" class='tablerow1'><strong>Fav Band</strong></td>
<td class='tablerow2' colspan="3"><input name="favband" type="text" value="<?php echo $r['favband']; ?>" size="64" maxlength="64"  /></td>
</tr>


<tr>
<td valign="top" class='tablerow1'><strong>Date Submitted</strong></td>
<td valign='middle' colspan="3" class='tablerow2'><?php echo $date; ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'><strong>Location</strong></td>
<td valign='middle' colspan="3" class='tablerow2'>
<select name="location">
<?php
$q = mysql_query("SELECT * FROM `flags` ORDER BY name ASC");
while ($fl = mysql_fetch_array($q)) {

if ($fl['id'] == $r['location']){
$checked = "selected";
} else {
$checked = "";
}
?>
<option value="<?php echo $fl['id']; ?>" <?php echo $checked; ?> /><?php echo $fl['name']; ?></option><?php echo "\n"; ?>
<?php
}
?>
</select></td>
</tr>

<tr>
<td colspan="4" valign="top" class='tablerow1'>
<strong>Guestbook Message</strong> - This is the message from the User.</td>
</tr>


  <tr>
    <td colspan="4" align="center" valign="top" class='tablerow1'>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 250;
$oFCKeditor->Value = $r['message'] ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
  
<tr><td align='center' class='tablesubheader' colspan='4' ><input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td></tr>
</table>
</form>

<?php
}

} else {
?>
We could not find the post you were looking for because the ID is not numeric. This has been logged and forwarded to a admin.
<?php
}

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>