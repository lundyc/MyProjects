<?php
if (is_numeric($_GET['id'])) {
$query = mysql_query("SELECT * FROM `video` WHERE id = '".(int)$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (!$r) {
die("This post does not exisit or has been removed by the admin");
}

if ($_POST['action'] == "doedit") {
$error = 0;

if (strlen($_POST['title']) < 5) {
$titleerror = 1;
$error = 1;

$titleerrortxt = "Field cannot be below 5 characters.";
}


if (strlen($_POST['location']) < 5) {
$locationerror = 1;
$error = 1;

$locationerrortxt = "Field cannot be below 5 characters.";
}

if (strlen($_POST['content']) < 5) {
$contenterror = 1;
$error = 1;

$contenterrortxt = "Field cannot be below 5 characters.";
}

if ($error == 0) {
$title = trim(addslashes(htmlentities($_POST['title'], ENT_QUOTES)));
$location = trim(addslashes(htmlentities($_POST['location'], ENT_QUOTES)));
$content = trim(addslashes($_POST['content']));
$host = trim(addslashes($_POST['host']));

mysql_query("UPDATE `video` SET `title` = '".$title."', `description` = '$content', `location` = '$location', `host` = '".$host."' WHERE `id` =".$_GET['id']." LIMIT 1 ;") or die("Error: " . mysql_error());
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
<tr>
  <td colspan="2" class="form_heading">Success</td>
  </tr>

<tr>
<td class="form_fieldinput1" align="center">
<img src="images/layout/admin/tick.gif" class="icon" />
</td>
  <td valign="top" class="form_fieldinput1">
The changes were successfully saved
<br />
<a href="index.php?view=admin&manager=videos" >go back</a> 
</td>
</tr>
</table> 
<?php
} else {
?>

<script language="javascript">
function storeCaret2 () { 
if (document.post.suite.createTextRange) document.post.suite.caretPos = document.selection.createRange().duplicate(); 
} 
	
function insertAtCaret2 (icon1, icon2) { 
if (document.post.suite.createTextRange && document.post.suite.caretPos) { 
var caretPos = document.post.suite.caretPos; 
selectedtext = caretPos.text; 
caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == '' ? icon1 + '' : icon1; 
caretPos.text = caretPos.text + selectedtext + icon2; 
} else document.post.suite.value = document.post.suite.value + icon1 + ' ' + icon2 
document.post.suite.focus(); 
}
</script>
<?PHP
include_once('includes/function.php');
include_once('includes/inc.bbcode.php');
?>

<form method="post" name="post" action="index.php?view=admin&manager=videos&action=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return checkForm(this)">
<input type="hidden" name="action" value="doedit">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
<tr>
<td colspan="4" class="form_heading">Edit Video</td>
</tr>

<tr>
<td valign="top" class="form_fieldtitle2">Title:
<?php
if ($titleerror == 1) {
echo "<div class=\"form_error\">* ".$titleerrortxt."</div>";
}
?>
</td>
<td class="form_fieldinput2" colspan="3">
<?php
if ($titleerror == 1) {
echo "<div class=\"form_error_input\">";
}
?>
<input name="title" type="text" value="<?php echo $_POST['title']; ?>" size="64" maxlength="64" />
<?php
if ($titleerror == 1) {
echo "</div>";
}
?>
</td>
</tr>

<tr>
<td valign="top" class="form_fieldtitle2">Location:
<?php
if ($locationerror == 1) {
echo "<div class=\"form_error\">* ".$locationerrortxt."</div>";
}
?>
</td>
<td class="form_fieldinput2" colspan="3">
<?php
if ($locationerror == 1) {
echo "<div class=\"form_error_input\">";
}
?>
<input name="location" type="text" value="<?php echo $_POST['location']; ?>" size="64" maxlength="64" />
<?php
if ($titleerror == 1) {
echo "</div>";
}
?>
</td>
</tr>

<tr>
<td valign="top" class="form_fieldtitle2">Host Band:</td>
<td class="form_fieldinput2" colspan="3"><input name="host" type="text" value="<?php echo $_POST['host']; ?>" size="64" maxlength="64" /></td>
</tr>

  <tr>
    <td colspan="4" align="center" valign="top" class="form_fieldinput2"><?PHP echo bbtype(text); ?><br/>
	</td>
  </tr>
  
    <tr>
    <td align="center" valign="top" class="form_fieldinput1"><?PHP echo bbtype(smilies); ?></td>
    <td align="center" valign="top" colspan="3" class="form_fieldinput1">    <?php
if ($contenterror == 1) {
echo "<div class=\"form_error\">* ".$contenterrortxt."</div>";
echo "<div class=\"form_error_input\">";
}
?>
<textarea name="content" rows="15" wrap="virtual" style="width:450px; height: 220px; overflow:auto;" tabindex="3" class="form_table" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"><?php echo $_POST['content']; ?></textarea>
<?php
if ($contenterror == 1) {
echo "</div>";
}
?></td>
  </tr>
<tr><td align='center' class="form_fieldinput2" colspan='4' >
<button class="button" onclick="document.post.submit();" style="margin-bottom: 5px">
<img src="../../images/misc/disk.png"/> Save Changes</button>
</td></tr>
</table>
</form>

<?php
}

} else {
?>
<script language="javascript">
function storeCaret2 () { 
if (document.post.suite.createTextRange) document.post.suite.caretPos = document.selection.createRange().duplicate(); 
} 
	
function insertAtCaret2 (icon1, icon2) { 
if (document.post.suite.createTextRange && document.post.suite.caretPos) { 
var caretPos = document.post.suite.caretPos; 
selectedtext = caretPos.text; 
caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == '' ? icon1 + '' : icon1; 
caretPos.text = caretPos.text + selectedtext + icon2; 
} else document.post.suite.value = document.post.suite.value + icon1 + ' ' + icon2 
document.post.suite.focus(); 
}
</script>
<?PHP
include_once('includes/function.php');
include_once('includes/inc.bbcode.php');
?>

<form method="post" name="post" action="index.php?view=admin&manager=videos&action=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return checkForm(this)">
<input type="hidden" name="action" value="doedit">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
<tr>
<td colspan="4" class="form_heading">Edit Video</td>
</tr>

<tr>
<td valign="top" class="form_fieldtitle2">Title:</td>
<td class="form_fieldinput2" colspan="3"><input name="title" type="text" value="<?php echo $r['title']; ?>" size="64" maxlength="64" /></td>
</tr>

<tr>
<td valign="top" class="form_fieldtitle2">Location:</td>
<td class="form_fieldinput2" colspan="3"><input name="location" type="text" value="<?php echo $r['location']; ?>" size="64" maxlength="64" /></td>
</tr>

<tr>
<td valign="top" class="form_fieldtitle2">Host Band:</td>
<td class="form_fieldinput2" colspan="3"><input name="host" type="text" value="<?php echo $r['host']; ?>" size="64" maxlength="64" /></td>
</tr>

  <tr>
    <td colspan="4" align="center" valign="top" class="form_fieldinput2"><?PHP echo bbtype(text); ?><br/>
	</td>
  </tr>
  
    <tr>
    <td align="center" valign="top" class="form_fieldinput1"><?PHP echo bbtype(smilies); ?></td>
    <td align="center" valign="top" colspan="3" class="form_fieldinput1"><textarea name="content" rows="15" wrap="virtual" style="width:95%; height: 220px; overflow: auto;" tabindex="3" class="form_table" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"><?=$r['description']?></textarea></td>
  </tr>
<tr><td align='center' class="form_fieldinput2" colspan='4' >
<button class="button" onclick="document.post.submit();" style="margin-bottom: 5px">
<img src="../../images/misc/disk.png"/> Save Changes</button>
</td></tr>
</table>
</form>

<?php
}
}
?>