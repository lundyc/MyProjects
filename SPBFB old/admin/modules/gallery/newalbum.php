<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_POST['action']) && $_POST['action'] == "addnewalbum") {

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
$added = date("Y-m-d");

mysql_query("INSERT INTO `gallery_categories` (`title`, `desc`, `added`) VALUES ('$title', '$mainbody', '$added')") or die("ERROR: " . mysql_error());

?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your new album has been added to the database.
 </p>
</div>
<br>

<?php
unset($_SESSION['error']);
redirect("index.php?manager=gallery", 5);
} else {
/* ///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//////////    ERROR ERROR ERROR ERROR //////////////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////
//////////////////////////////////////
*/
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
 <div class='tableheaderalt'>Add Album</div>

<form method="post" name="post" action="./?manager=gallery&action=newalbum" onsubmit="return checkForm(this)">
<input type="hidden" name="action" value="addnewalbum">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><strong>Title</strong></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" value="" size="64" maxlength="64"/></td>
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
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////// end of error ////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
}

} else {
?>

<div class='tableborder'>
 <div class='tableheaderalt'>Add Album</div>

<form method="post" name="post" action="./?manager=gallery&action=newalbum" onsubmit="return checkForm(this)">
<input type="hidden" name="action" value="addnewalbum">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='40%'  valign='middle'><strong>Title</strong></td>
<td class='tablerow2'  width='60%'  valign='middle'><input name="title" type="text" value="" size="64" maxlength="64"/></td>
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
$oFCKeditor->Value = '';
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
?>
