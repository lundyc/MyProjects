<?php
if (level($_SESSION['uid']) < 4) {
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

if (empty($_POST['FCKeditor1'])) {
$_SESSION['error'] .= "<li>Please enter some Information</li>\n";
$error = 1;
}

if ($error == 0) {
$title = checkquotes($_POST['title']);
$mainbody = checkquotes($_POST['FCKeditor1']);

mysql_query("UPDATE `info` SET `title` = '$title', `content` = '$mainbody' WHERE `id` =".(int)$_GET['id']." LIMIT 1") or die(mysql_error());
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
redirect("index.php?manager=info", 5);

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
$query = mysql_query("SELECT * FROM `info` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (count($r) < 1) {
die("This item does not exisit or has been removed by the admin");
}

?>

<div class='tableborder'>
 <div class='tableheaderalt'>Information Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=info&action=edit&id=<?php echo $_GET['id']; ?>"             >
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='19%'  valign='middle'><b>Item Title:</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><input name="title" type="text" class="textinput" value="<?php echo $_POST['title']; ?>" size="60" /></td>
</tr>
  
<tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Full News Article</strong> - This will be displayed when the viewer clicks on View Full Article which is displayed under the summary.</td>
</tr>
  
  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 500;
$oFCKeditor->Value = $_POST['FCKeditor1'] ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
  
<tr><td align='center' class='tablesubheader' colspan='2' ><input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td></tr>
</table>
</form>

</div>


<?php
}

} else {

$query = mysql_query("SELECT * FROM `info` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (count($r) < 1) {
die("This item post does not exisit or has been removed by the admin");
}
?>

<div class='tableborder'>
 <div class='tableheaderalt'>Information Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=info&action=edit&id=<?php echo $_GET['id']; ?>"             >
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='19%'  valign='middle'><b>Item Title:</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><input name="title" type="text" class="textinput" value="<?php echo $r['title']; ?>" size="60" /></td>
</tr>

<tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Full News Article</strong> - This will be displayed when the viewer clicks on View Full Article which is displayed under the summary.</td>
</tr>
  
  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 500;
$oFCKeditor->Value = $r['content'] ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
  
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