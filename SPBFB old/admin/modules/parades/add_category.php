<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

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

mysql_query("INSERT INTO `events_cat` (`title`) VALUES ('".$title."');") or die(mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your information has been added to the database. </p>
</div>
<br>

<?php
unset($_SESSION['error']);
redirect("index.php?manager=parades&action=categories", 5);

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

?>

<div class='tableborder'>
 <div class='tableheaderalt'>Category Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=parades&action=add_category">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Item Title:</b></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" class="textinput" value="" size="60" /></td>
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
<div class='tableborder'>
 <div class='tableheaderalt'>Category Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=parades&action=add_category">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>Item Title:</b></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" class="textinput" value="" size="60" /></td>
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
?>