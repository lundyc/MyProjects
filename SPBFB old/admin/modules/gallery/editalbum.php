<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (is_numeric($_GET['name'])) {

$query = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".$_GET['name']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (!$r) {
die("This news post does not exisit or has been removed by the admin");
}

if (isset($_POST['action']) && $_POST['action'] == "doeditalbum") {

$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['title'])) {
$_SESSION['error'] .= "<li>Please enter a title</li>\n";
$error = 1;
}


if (empty($_POST['FCKeditor1'])) {
$_SESSION['error'] .= "<li>Please enter a description.</li>\n";
$error = 1;
}

if ($error == 0) {
$title = trim(addslashes(htmlentities($_POST['title'], ENT_QUOTES)));
$mainbody = trim(addslashes($_POST['FCKeditor1']));

$title = str_replace("/", "_", $title);

mysql_query("UPDATE `gallery_categories` SET `title` = '".$title."', `desc` = '".$mainbody."' WHERE `cid` =".$_GET['name']." LIMIT 1 ;") or die("Error: " . mysql_error());

?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your album has been edited.
 </p>
</div>
<br>

<?php
unset($_SESSION['error']);
redirect("index.php?manager=gallery", 5);
} else {
?>
<div class='tableborder'>
 <div class='tableheaderalt'>Edit Album</div>
<form method="post" name="post">
<input type="hidden" name="action" value="doeditalbum">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><strong>Title</strong></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" value="<?php echo $_POST['title']; ?>" size="64" maxlength="64"/></td>
</tr>

<tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Full Description</strong> - This will be displayed when the viewer clicks on Photo which is displayed under the information.</td>
</tr>

  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 200;
$oFCKeditor->Value = $_POST['FCKeditor1'] ;
$oFCKeditor->Create() ;
?>
</td>
</tr>
  
<tr><td align='center' class='tablesubheader' colspan='2' ><input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td></tr>
</table>
</form>

</div>
</form>

<?php
}

} else {
$query = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".$_GET['name']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (!$r) {
die("This news post does not exisit or has been removed by the admin");
}

$date = explode("-", $r['added']);
$date = date("l, jS F Y", mktime(0,0,0, $date['1'], $date['2'], $date['0']));

?>

<div class='tableborder'>
 <div class='tableheaderalt'>Edit Album</div>
<form method="post" name="post">
<input type="hidden" name="action" value="doeditalbum">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><strong>Title</strong></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" value="<?php echo $r['title']; ?>" size="64" maxlength="64"/></td>
</tr>

<tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Full Description</strong> - This will be displayed when the viewer clicks on Photo which is displayed under the information.</td>
</tr>

  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 200;
$oFCKeditor->Value = $r['desc'] ;
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

}
?>