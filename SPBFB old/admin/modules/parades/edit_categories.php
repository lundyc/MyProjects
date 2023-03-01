<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_GET['id'])) {

if (isset($_POST['action']) && $_POST['action'] == "doedit") {

$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['title'])) {
$_SESSION['error'] .= "<li>Please enter a title</li>\n";
$error = 1;
}

if ($error == 0) {

if (!get_magic_quotes_gpc()) {
$title = trim(addslashes(htmlentities($_POST['title'], ENT_QUOTES)));
} else {
$title = $_POST['title'];
}


mysql_query("UPDATE `events_cat` SET `title` = '$title' WHERE `id` =".(int)$_GET['id']." LIMIT 1") or die(mysql_error());
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
redirect("index.php?manager=parades&action=categories", 5);

} else {
?>
<div class='information-box'>
 <img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/global-infoicon.gif' alt='information' />
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
$query = mysql_query("SELECT * FROM `events_cat` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (count($r) < 1) {
die("This item does not exisit or has been removed by the admin");
}

?>

<div class='tableborder'>
 <div class='tableheaderalt'>Category Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=parades&action=edit_categories&id=<?php echo $_GET['id']; ?>">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Item Title:</b></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" class="textinput" value="<?php echo $r['title']; ?>" size="60" /></td>
</tr>
  
<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'>
</td>
</tr>
</table>
</form>

</div>


<?php
}

} else {

$query = mysql_query("SELECT * FROM `events_cat` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (count($r) < 1) {
die("This item post does not exisit or has been removed by the admin");
}
?>

<div class='tableborder'>
 <div class='tableheaderalt'>Category Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=parades&action=edit_categories&id=<?php echo $_GET['id']; ?>">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Item Title:</b></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" class="textinput" value="<?php echo $r['title']; ?>" size="60" /></td>
</tr>
  
<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'>
</td>
</tr>
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