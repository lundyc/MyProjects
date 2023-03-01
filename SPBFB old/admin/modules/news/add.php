<?php
if (level($_SESSION['uid']) >= 2) {

if (isset($_POST['action']) && $_POST['action'] == "doeditnews") {

$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['title'])) {
$_SESSION['error'] .= "<li>Please enter a title</li>\n";
$error = 1;
}

if (empty($_POST['FCKeditor1'])) {
$_SESSION['error'] .= "<li>Please enter some News</li>\n";
$error = 1;
}

if ($error == 0) {

$title = checkquotes($_POST['title']);
$mainbody = checkquotes($_POST['FCKeditor1']);

/*
if (!get_magic_quotes_gpc()) {
$title = trim(addslashes(htmlentities($_POST['title'], ENT_QUOTES)));
$mainbody = trim(addslashes($_POST['MainBody']));
} else {
$title = $_POST['title'];
$mainbody = $_POST['MainBody'];
}
*/

mysql_query("INSERT INTO `news` (`title`, `date`, `MainBody`, `poster`) VALUES ('".$title."', NOW( ), '".$mainbody."', '".$_SESSION['uid']."');") or die(mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your news post has been added to the database.
 </p>
</div>
<br>

<?php
unset($_SESSION['error']);
redirect("index.php?manager=news", 5);

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
$date 	= date("D, jS F Y"); 

?>
<div class='tableborder'>
 <div class='tableheaderalt'>News Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=news&action=add">
<input type="hidden" name="action" value="doeditnews">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td  width='19%'  valign='middle' class='tablerow1'><b>News Subject:</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><input name="title" type="text" class="textinput" value="<?php echo $_POST['title']; ?>" size="60" /></td>
</tr>

<tr>
<td class='tablerow1'  valign='middle'><strong>D</strong><b>ate Submitted</b></td>
<td class='tablerow2'  valign='middle'><?php echo $date; ?></td>
</tr>

<tr>
<td class='tablerow1'  valign='middle'><b>Author</b></td>
<td class='tablerow2'  valign='middle'><?php echo idtoname($_SESSION['uid']); ?></td>
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
$oFCKeditor->Value = $_POST['FCKeditor1'];
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

<div class='tableborder'>
 <div class='tableheaderalt'>News Overview</div>
<form method="post" name="post" action="index.php?view=admin&manager=news&action=add">
<input type="hidden" name="action" value="doeditnews">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='19%'  valign='middle'><b>News Subject:</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><input name="title" type="text" class="textinput" value="" size="60" /></td>
</tr>

<tr>
<td class='tablerow1'  width='19%'  valign='middle'><strong>D</strong><b>ate Submitted</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><?php echo date("D, jS F Y"); ?></td>
</tr>

<tr>
<td class='tablerow1'  width='19%'  valign='middle'><b>Author</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><?php echo idtoname($_SESSION['uid']); ?></td>
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
$oFCKeditor->Value = '' ;
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
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>